<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function register(Request $request){
        $request->validate(
            [
                'nickname' => ['nullable', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string' ]
            ]
        );
        $user = User::create(
            [
                'nickname' => $request->nickname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );
        $token=$user->createToken('auth_token')->accessToken;

        return response([
            'token'=> $token
        ]);
    }
    public function login(Request $request){
        $request->validate(
            [
                'email' => ['required'],
                'password' => ['required']
            ]
        );
        $user=User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message'=>'Los datos introducidos no son correctos'
            ]);
        }
        
        $token=$user->createToken('auth_token')->accessToken;

        return response([
            'token'=> $token,
            'message'=>'Estás en sesión'
        ]);
    }
    public function logout(Request $request){
        $request->user()->token()->revoke();

        return response([
            'message'=>'La salido de la sesión con exito'
        ]);
    }
    public function DisplayAllPlayers(Request $request)
    {
        
        if ($request->user()->hasRole('admin')) {
            $users = User::all();
            return response()->json($users);
        } else {
            return response()->json([
                'message' => 'No tienes permiso para acceder a esta información.'
            ], 403);
        }
    }

}
