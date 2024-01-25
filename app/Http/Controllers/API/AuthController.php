<?php

namespace App\Http\Controllers\API;

use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ResponseAPI;
    public function loginUser(Request $request)
    {
        // $user = User::where('email',$request->email)->first();
        // if ($user){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp', ['server:update'])->plainTextToken; 
            $success['name'] =  $user->name;
   
            return $this->success( "Login Success",
                $success,200 );
        } 
        else{ 
            return $this->error('Unauthorised.', 401);
            // return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
    public function logout(Request $request)
    {
        if (Auth::check()){
            auth()->user()->tokens()->delete();
            return $this->success( "Logout Success",
            auth()->user(),200 );
        }else{
            return $this->error('Unauthorised.', 401);
        }
       
    }
}