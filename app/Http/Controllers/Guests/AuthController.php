<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guests\RegisterGuestRequest;
use App\Models\Guest;
use App\Traits\GetResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    use GetResponse;
    
    public function register(RegisterGuestRequest $request){
        $data = $request->except('password','password_confirmation');
        $data['password'] = Hash::make($request->password);
        
        $guest=Guest::create($data);
        $token= "Bearer " . $guest->createToken($guest->name,['guest'])->plainTextToken;
        $guest->token = $token;
        
        return $this->dataResponse($guest,'Authenticated');

    }


    public function login(Request $request){
        $request->validate([
        'email'=>'required|email|exists:guests',
        'password'=>'required|min:8',
       ]);

       $guest = Guest::where('email',$request->email)->first();
        if(!$guest && !Hash::check($request->password, $guest->password)){
            return $this->errorResponse('Password not valid','errors');
        }
        
        $token= "Bearer " . $guest->createToken($guest->name,['guest'])->plainTextToken;
        $guest->token = $token;

        return $this->successResponse('Authenticated',$guest);

    }
}
