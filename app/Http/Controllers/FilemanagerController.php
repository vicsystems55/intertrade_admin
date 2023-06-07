<?php

namespace App\Http\Controllers;

use Image;
use App\Models\User;
use App\Models\Project;
use App\Models\MediaBank;
use Illuminate\Http\Request;
use App\Models\MediaCategory;
use App\Mail\ProjectUpdateMail;
use App\Models\MediaBankCategory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class FilemanagerController extends Controller
{
    //

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
        # code...

        $media_category = MediaCategory::where('id', $id)->with('mediaCategory.mediaFiles.uploadedBy')->first();

        // return $media_category;


        return view('filemanager.category', compact(['media_category']));


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

        try {
            //code...

            $data=[
                'project_title' => Project::find($request->project_id)->title??'Project 1',
                'uploadedBy' => User::where('email',$request->email)->first()->name
            ];

            Mail::to('victor@intertradeltd.biz')->send(new ProjectUpdateMail($data));

            Mail::to('tejiri@intertradeltd.biz')->send(new ProjectUpdateMail($data));

        } catch (\Throwable $th) {
            //throw $th;
        }



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
