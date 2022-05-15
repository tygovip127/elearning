<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $data= $request->data;
        $idToken = $data['idToken'];
        $res= Http::get('https://oauth2.googleapis.com/tokeninfo?id_token='.$idToken);
        $email= $res->json()['email'];
        $user= User::where('email',$email)->first();
        if(!$user){ //user does not exist, regiser user
            error_log("0 exist");
            $user= AuthController::register($request,$idToken, $res);
        } else {
            error_log("exist");
        }
        Auth::logout();
        Auth::login($user);
        return response()->json([
            'id'=> $user->id,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'avatar' => $user->image_feature_path,
        ]);
    }
    
    public function register(Request $request,$idToken, $res){
        return User::create([
            'name' => $res->json()['name'],
            'email' => $res->json()['email'],
            'first_name'=> $res->json()['family_name'],
            'last_name'=> $res->json()['given_name'],
            'image_feature_path' => $res->json()['picture'],
            'google_id'=> $idToken,
        ]);
    }
}
