<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\GetResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use GetResponse;
    
    public function login(Request $request){
      
        $request->validate([
            'email'=>'email|required|exists:admins',
            'password'=>'required|min:6'
        ]);

        $admin = Admin::where('email',$request->email)->first();

        if(!$admin || !Hash::check($request->password, $admin->password)){
            return $this->errorResponse('Credentials not valid','errors');
        }
        $token= "Bearer " . $admin->createToken($admin->name,['admin'])->plainTextToken;
        $admin->token = $token;

        return $this->dataResponse($admin,'admin is Authenticated');
    }


    public function checkAuth(Request $request){

        $token = $request->header('Authorization');
        $admin = Auth::guard('sanctum')->user();
        $admin->token = $token;
        return $this->successResponse("Authenticated",$admin);


    }

    public function logout(){

        $admin = Auth::guard('sanctum')->user();
        $admin->tokens()->delete();
        return $this->successResponse("Unauthenticated");

        
    }
}
