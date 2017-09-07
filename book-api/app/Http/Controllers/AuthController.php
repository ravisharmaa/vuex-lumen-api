<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    /**
     * AuthController constructor.
     * @param JWTAuth $auth
     */
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth= $auth;
    }

    public function registerUser(Request $request)
    {
        $user  = User::create([
           'email'=>$request->get('email'),
           'password'=> Hash::make($request->get('password'))
        ]);

        $token = $this->auth->attempt($request->only(['email','password']));


        return response()->json([
           'data'=> $user,
           'meta'=>[
               'token'=>$token
           ]
        ],200);
    }


    public function handleLogin(Request $request)
    {

        try {
            if(!$token = $this->auth->attempt($request->only(['email','password']))){
                return response()->json([
                   'error'=>[
                       'details'=>'Could not Sign In with the provided Credentials'
                   ]
                ],401);
            }
        } catch (JWTException $e){
            return response()->json([
               'error'=>[
                   'details'=>'failed'
               ]
            ], $e->getCode());
        }

        dd('worked');
    }


}
