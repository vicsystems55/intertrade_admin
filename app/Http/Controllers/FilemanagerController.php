<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MediaBank;
use Illuminate\Http\Request;
use App\Models\MediaCategory;
use App\Models\MediaBankCategory;
use Illuminate\Support\Facades\Validator;


class FilemanagerController extends Controller
{
    //

    public function media()
    {
        $media_category = MediaCategory::with('mediaCategory')->get();

        // return $media_category;

        $users = User::get();

        return view('filemanager.home', compact(['media_category', 'users']));
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

        $filesize = ($request->file('media')->getSize());

        $request->validate([
            'email' => 'required|exists:users,email',
            // 'amount' => 'required|numeric|min:99700|between:0,99.99',
            // 'number_of_accounts' => 'required|numeric|min:1|max:15',
            // 'featured_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:50000',

        ]);

        $doc = $request->file('media');

        $new_name = rand().".".$doc->getClientOriginalExtension();

        $file1 = $doc->move(public_path('media_bank'), $new_name);

        $mediaFile = MediaBank::create([
            'url' => asset('media_bank').'/'.$new_name,
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'active',
            'type' => $request->file('media')->getClientMimeType(),
            'size' => $filesize,
            'uploaded_by' => User::where('email',$request->email)->first()->id,
        ]);

        MediaBankCategory::create([
            'media_bank_id' => $mediaFile->id,
            'media_category_id' => $request->media_category,
        ]);






        return $request->all();
    }
}
