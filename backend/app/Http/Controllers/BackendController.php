<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Recipe;

class BackendController extends Controller
{
    public function login (Request $request) {
        //return response()->json($request);
        return response()->json(['id' => $request['id'], 'username' => $request['username'],
        'email' =>$request['email'],'password'=>$request['password'],'role'=>$request['role']]);
        
        /*echo "<pre>";
        print_r($request->all());*/
    
    }

    public function getPost(){
        $posts = Post :: all();
        return response()->json($posts);
    }

    public function getRecipe(){
        $recipes = Recipe :: all();
        return response()->json($recipes);
    }
}
