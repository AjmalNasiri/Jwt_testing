<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {


        // $request->validate([
        //     'firstname'=>'required',
        //     'email'=>'required',
        //     'password'=>'required|min:6|max:24|confirmed'

        // ]);
        $user =new User();
        $user->name =$request->firstname;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        // echo "sdfsdf";
    }
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['success' =>false,
              'message'=>'incorrect'],Response::HTTP_UNAUTHORIZED);
        }

        $user=auth::User();
        $tokens = $user->createToken('Token')->plainTextToken;
        $cookie=cookie('jwt',$tokens,60*24);
        return response([
         'message'=>$tokens,
        ])->withCookie($cookie);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return Auth::User();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $cookie=Cookie::forget('jwt');


        return response([
           'message'=>'success'
        ])->withCookie($cookie);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->factory()->getTTL() * 60
    //     ]);
    // }

    public function ajmaltesting()
    {
        return 'nasiri abdul latif and ajmal ajmal ajmal';
    }
}
