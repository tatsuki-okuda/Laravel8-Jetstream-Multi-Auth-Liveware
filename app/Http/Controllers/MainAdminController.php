<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainAdminController extends Controller
{
    

    public function AdminProfile()
    {
        $admin = Admin::find(1);
        return view('admin.profile.view_prodile', compact('admin'));
    }


    public function AdminProfileEdit()
    {
        // $id = Auth::user()->id;
        $user = Admin::find(1);

        return view('admin.profile.view_profile_edit', compact('user'));
    }


    public function AdminProfileUpdate(Request $request)
    {
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            // 古い画像を削除する。
            unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move( public_path('upload/admin_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }

        $data->save();

        return redirect()->route('admin.profile');
    }
}
