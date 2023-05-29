<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
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

        return response()->json([
            'success'=>true,
            'token'=>$token,
            'user'=>Auth::user(),
        ],Response::HTTP_OK);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
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
        return 'ajmal';
    }
}
