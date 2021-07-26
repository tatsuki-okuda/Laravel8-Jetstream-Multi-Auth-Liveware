<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainUserController extends Controller
{
    

    /**
     * User Loguoutfr
     *
     * @return void
     */
    public function Logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    /**
     * Return USer Profile Page
     *
     * @return void
     */
    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        
        return view('user.profile.view_profile', compact('user'));
    }


    /**
     * Return User Profile Edit Page
     *
     * @return void
     */
    public function UserProfileEdit()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('user.profile.view_profile_edit', compact('user'));
    }


    /**
     * Update User Profile
     *
     * @param Request $request
     * @return void
     */
    public function UserProfileUpdate(Request $request)
    {
        $data = User::findOrFail(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            // 古い画像を削除する。
            unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move( public_path('upload/user_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }

        $data->save();

        return redirect()->route('user.profile');
    }



    /**
     * Return Password Change Edit View
     *
     * @return void
     */
    public function UserPasswordView()
    {
        return view('user.password.edit_password');
    }


    /**
     * User Change Passwrod
     *
     * @param Request $request
     * @return void
     */
    public function UserPasswordUpdate(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if( Hash::check($request->oldpassword, $hashedPassword) ){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        } else {
            return redirect()->back();
         }
    }
}
