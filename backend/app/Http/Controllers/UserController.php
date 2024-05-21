<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
class UserController extends Controller
{
    public function signup(Request $request){

        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        /*if ($validator->fails()) {
           return response()->json(['message' => 'Error!'], 404);
        }*/

        $findusename = User :: where('email',$request['email'])->first();
        if($findusename){
            return response()->json(['message' => 'This user already exists!'], 500);
        }

        $user = new User;
        $user->name = $request['username'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password'], ['rounds' => 12]);
        $user->save();


        return response()->json([ 'message' => "User Created Succesfully!"], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $finduser = User :: where('email',$request["email"])->first();
        $hashedPassword = $finduser->password;
        if(!$finduser){
            return response()->json(['message' => "This user doesn't exists!"], 500);
        }if (!Hash::check($request["password"], $hashedPassword)) {
            return response()->json(['message' => "Password doesn't match!"], 500);
        }
        //session()->put('id', $finduser->id);
        Session::set('id', $finduser->id);
        return response()->json([ 'message' => "SignIn Successfull!",'id' => $finduser->id], 200);
    }
}
