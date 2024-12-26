<?php

namespace App\Http\Controllers;

use Image;
use App\Models\User;
use App\Models\Project;
use App\Models\MediaBank;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MediaCategory;
use App\Mail\ProjectUpdateMail;
use App\Models\MediaBankCategory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class FilemanagerController extends Controller
{
    //

    public function index(Request $request)
    {
        $path = $request->get('path', '/');
        $disk = Storage::disk('user_files');

        // Get subfolders
        $folders = collect($disk->directories($path))->map(function ($folder) use ($disk) {
            return [
                'name' => basename($folder),
                'path' => $folder,
                'size' => $this->getFolderSize($folder, $disk), // Get folder size
            ];
        });

        // Get files
        $files = collect($disk->files($path))->map(function ($file) use ($disk) {
            return [
                'name' => basename($file),
                'path' => $file,
                'size' => $disk->size($file), // Get file size
            ];
        });

        // Breadcrumbs for navigation
        $breadcrumbs = $this->getBreadcrumbs($path);

        // return $folders;

        return view('filemanager.home', compact('folders', 'files', 'path', 'breadcrumbs'));
    }

    /**
     * Calculate the total size of a folder recursively.
     *
     * @param string $folder
     * @param \Illuminate\Contracts\Filesystem\Filesystem $disk
     * @return int
     */
    protected function getFolderSize($folder, $disk)
    {
        $files = $disk->allFiles($folder); // Get all files within the folder
        $totalSize = 0;

        foreach ($files as $file) {
            $totalSize += $disk->size($file); // Add file size
        }

        return $totalSize;
    }


    public function searchFilesAndFolders(Request $request)
{
    $searchTerm = $request->input('query');
    $disk = Storage::disk('user_files');

    // Get all files and directories
    $allFiles = $disk->allFiles(); // Get all files
    $allDirectories = $disk->allDirectories(); // Get all directories

    // Filter files and directories based on search term
    $matchingFiles = array_filter($allFiles, function ($file) use ($searchTerm) {
        return stripos($file, $searchTerm) !== false; // Case-insensitive search
    });

    $matchingDirectories = array_filter($allDirectories, function ($directory) use ($searchTerm) {
        return stripos($directory, $searchTerm) !== false; // Case-insensitive search
    });

    // return $matchingDirectories;

    // return view('superadmin_dashboard.file_manager', compact('folders', 'files', 'path', 'breadcrumbs'));


    return view('superadmin_dashboard.search_results', [
        'files' => $matchingFiles,
        'directories' => $matchingDirectories,
        'searchTerm' => $searchTerm,
    ]);
}

    public function renameFolder(Request $request)
    {

        // return $request->all();
        $request->validate([
            'oldPath' => 'required|string',
            'newName' => 'required|string',
        ]);

        $disk = Storage::disk('user_files');

        // Extract parent path from oldPath
        $parentPath = dirname($request->input('oldPath'));
        $oldName = basename($request->input('oldPath')); // Current folder name
        $newName = $request->input('newName');          // New folder name

        // Construct full paths
        $oldPath = $parentPath !== '.' ? $parentPath . '/' . $oldName : $oldName;
        $newPath = $parentPath !== '.' ? $parentPath . '/' . $newName : $newName;


        // return $oldPath;

        // Check if the folder exists
        if (!$disk->exists($oldPath)) {
            return response()->json(['error' => 'Folder does not exist.'], 404);
        }

        // Check if a folder with the new name already exists
        if ($disk->exists($newPath)) {
            return response()->json(['error' => 'A folder with the new name already exists.'], 400);
        }

        // Rename the folder
        $disk->move($oldPath, $newPath);

        return response()->json(['success' => true, 'message' => 'Folder renamed successfully.']);
    }

    // Upload a file
    public function uploadFile(Request $request)
    {
        $path = $request->get('path', '/');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file->storeAs($path, $file->getClientOriginalName(), 'user_files');
        }

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }

    public function createFolder(Request $request)
    {
        $path = $request->get('path', '/');
        $folderName = $request->get('name');

        Storage::disk('user_files')->makeDirectory("$path/$folderName");

        return redirect()->back()->with('success', 'Folder created successfully!');
    }

    public function media()
    {
        $media_category = MediaCategory::with('mediaCategory')->get();

        $projects = Project::get();


        // return $media_category;

        $users = User::get();

        return view('filemanager.home', compact(['media_category', 'users', 'projects']));
    }

    public function mediaCategory($id)
    {


        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }

        $media_category =  MediaCategory::find($id);

        $mediaIds = MediaBankCategory::latest()->where('media_category_id', $id)->get()->pluck('media_bank_id');

        // return $mediaIds;

        $media = MediaBank::whereIn('id', $mediaIds)->latest()->paginate(20);

        // return $media;
        # code...

        // $media_category = MediaCategory::where('id', $id)->with('mediaCategory.mediaFiles.uploadedBy')->first();



        // return $media_category;


        return view('filemanager.category', compact(['media', 'media_category']));


    }

    public function uploadMedia(Request $request)
    {
        # code...


        $request->validate([
            'email' => 'required|exists:users,email',
            'description' => 'required',

            // 'amount' => 'required|numeric|min:99700|between:0,99.99',
            // 'number_of_accounts' => 'required|numeric|min:1|max:15',
            // 'featured_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:50000',

        ]);

        foreach ($request->media as $doc) {

            if(substr($doc->getMimeType(), 0, 5) == 'image') {
                // this is an image

                $filesize = ($doc->getSize());


                $new_name = rand().".".$doc->getClientOriginalExtension();

                $destinationPath = public_path('uploads/thumbnails');

                $imgFile = Image::make($doc->getRealPath());

                $imgFile->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$new_name);
                // $destinationPath = public_path('/uploads/thumbnails');

                $file1 = $doc->move(public_path('media_bank'), $new_name);

                $mediaFile = MediaBank::create([
                    'url' => asset('/uploads/thumbnails').'/'.$new_name,
                    'download_url' => asset('media_bank').'/'.$new_name,
                    'location' => $request->location,
                    'project_id' => $request->project_id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => 'active',
                    'type' => $doc->getClientMimeType(),
                    'size' => $filesize,
                    'uploaded_by' => User::where('email',$request->email)->first()->id,
                ]);

                MediaBankCategory::create([
                    'media_bank_id' => $mediaFile->id,
                    'media_category_id' => $request->media_category,
                ]);


            }else{

                $filesize = ($doc->getSize());


                $new_name = rand().".".$doc->getClientOriginalExtension();

                $file1 = $doc->move(public_path('media_bank'), $new_name);

                $mediaFile = MediaBank::create([
                    'url' => asset('/uploads/thumbnails').'/'.$new_name,
                    'download_url' => asset('media_bank').'/'.$new_name,
                    'location' => $request->location,
                    'project_id' => $request->project_id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => 'active',
                    'type' => $doc->getClientMimeType(),
                    'size' => $filesize,
                    'uploaded_by' => User::where('email',$request->email)->first()->id,
                ]);

                MediaBankCategory::create([
                    'media_bank_id' => $mediaFile->id,
                    'media_category_id' => $request->media_category,
                ]);


            }



            # code...
            // $doc = $request->file('media');

        }


        if ($request->project_id) {
            # code...

        // try {
            //code...



            $data=[
                'project_title' => Project::find($request->project_id)->title??'Project 1',
                'uploadedBy' => User::where('email',$request->email)->first()->name
            ];

            Mail::to('victor@intertradeltd.biz')->send(new ProjectUpdateMail($data));

            Mail::to('tejiri@intertradeltd.biz')->send(new ProjectUpdateMail($data));

        // } catch (\Throwable $th) {
            //throw $th;
        // }



        }






        return redirect('/media/category/'.$request->media_category);
    }

    public function removeMedia(Request $request)
    {
        # code...

        // return $request->all();

        MediaBankCategory::where('media_bank_id', $request->mediaId)->first()->delete();

        MediaBank::find($request->mediaId)->delete();



        return redirect('/media/category/'.$request->categoryID)->with('msg', 'File Removed!!');
    }
}
