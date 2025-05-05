<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\StoreAdminRequest;
use App\Models\Admin;
use App\Traits\GetResponse;
use App\Traits\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use Media,GetResponse;



    public function add_admin(StoreAdminRequest $request){
       
        $data=$request->except('password','password_confirmation');
        $data['password'] = Hash::make($request->password);
        Admin::create($data);
        return $this->successResponse('Profile Updated Successfully',$data);
    }



    public function update_profile_image(Request $request){
        $request->validate([
            'avatar'=>'required|mimes:png,jpg,jpeg',
        ]);

        $avatarName = $this->UploadPhoto($request->avatar,'images/profiles');
        $user=Auth::guard('sanctum')->user();
        // Delete Old Avatar
        if($user->avatar){
            $this->deletePhoto($user->avatar);
        }

        $user->avatar=$avatarName;
        $user->save();

        return $this->successResponse('Profile Updated Successfully',$user);
    }

   

    public function update_password(Request $request){
       
        $request->validate([
            'password'=>'required|min:8'
        ]);

        $admin = Auth::guard('sanctum')->user();
        $new_password=Hash::make($request->password);
        $admin->update([
            'password'=>$new_password
        ]);

        return $this->successResponse('Password Updated Successfully',$admin);
    }
}
