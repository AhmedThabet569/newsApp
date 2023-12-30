<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notifaction =  array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notifaction);
    }
    // get profile page 
    public function Profile()
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        // dd($data);
        return view('admin.admin_view_profile',compact('data'));
    }
    // edit profile page
    public function EditProfile(){
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('admin.admin_edit_view',compact('data'));
    }
    // store save edit fprofile action 
    public function StoreProfile(Request $request){
    
    //    dd($request);
    $id = Auth::user()->id;
    $data = User::find($id);

    $data->name = $request->name;
    $data->email = $request->email;
    

    // check if request have file 
    if($request->file('profile_image'))
    {
    $file = $request->file('profile_image');
    $filename = date('YmdHi').$file->getClientOriginalName();
    $file->move(public_path('ubload/admin_images'), $filename);
    $data['profile_image'] = $filename;
    }

    // dd($data);
    $data->save();
    $notifaction =  array(
        'message' => 'Admin Profile Updated Successfully',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.profile')->with($notifaction);
    }
    // change password 
    public function ChangePassword(){
      
        return view('admin.admin_change_password');
    }
    public function UpdatePassword(Request $request){
          $validate = $request->validate([

            'old_password'=>'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
          ]);

          $hashedPassword = Auth::user()->password;
    // check if old password is password in databse
          if(Hash::check($request->old_password, $hashedPassword)){
                $user = User::find(Auth::id());
                $user->password = bcrypt($request->new_password);
                $user->save();
               
                // $request->session()->flash('success', 'user update password successfully');
                return redirect()
                ->with('success', 'your account has been created');
          }else{
            session()->flash('danger','old password not correct');
            return redirect()->back();
          }
     }
}
