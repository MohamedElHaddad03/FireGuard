<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\chats;
use App\Models\comments;
use App\Models\location;
use App\Models\media;
use App\Models\reports;
use App\Models\statistics;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login(Request $request){
        $fields = $request->validate([
            'username' =>'string|required',
            'password' =>'string|required'
        ]);
        //check email
            $user = User::where('username',$fields['username'])->first();
        //check password
        if(!$user || !($fields['password']==$user->password)){
            return response([
                'message' => 'Username or Password are incorrect'
            ],401);
        }
        $token = $user->createToken('MyAppToken')->plainTextToken;
        $response= [
            'user'=>$user,
            'token'=>$token,
        ];
                return response($response,202);
    }

    public function indexchat()
    {
       /*$adm = administrateur::with('etablissement')->get();
        return $adm;*/
        $adm = chats::with('user')
                              ->get();

        return $adm;
    }

    public function chat($id)
    {
        $adm = chats::with('user')
                            ->with('comments')
                            ->find($id);

        return response()->json($adm,200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'CIN' => 'required|string|unique:users',
            'password' => 'required|string',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->CIN = $request->input('CIN');
        $user->password = $request->input('password');
        $user->save();

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function commenting(Request $request)
    {
        
        $request->validate([
            'content' => 'required|string',
            'id_chat' => 'required',
        ]);
 

        $comm = new comments();
        $comm->content = $request->input('content');
        $comm->id_user = Auth::user()->id_user;
        $comm->id_chat = $request->input('id_chat');
        $comm->save();

        return response()->json(['message' => 'comment added successfully', 'comm' => $comm], 201);
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
    
        if ($user) {
            $user->tokens()->delete();
            return [
                'message' => 'Logged out'
            ];
        }
    
    
    }


}
