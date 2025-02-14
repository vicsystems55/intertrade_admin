<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationMail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ApiAuthController extends Controller
{

  /**
   * Create a new account
   *
   * @bodyParam name string required
   * @bodyParam email string required
   * @bodyParam password string required

   * @return \Illuminate\Http\Response
   */



   public function updatePassword(Request $request){

    // return $request->all();

    $request->validate([
      'password' => 'required|confirmed'
    ]);

    $user = User::find($request->user()->id);


      return $user->update([
        'password' => Hash::make($request->password)
      ]);


   }



  public function register(Request $request)
  {




    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8',
    ]);


    $regCode = "ITL-MOB" . rand(11100, 999999);

    $user = User::create([
      'name' => $validatedData['name'],
      'email' => $validatedData['email'],
      'user_code' => $regCode,
      'role' => 'mobile-user',
      'avatar' => 'avatar.png',
      'password' => Hash::make($validatedData['password']),
    ]);


    // $user->update([
    //   'otp' => rand(111111, 999999)
    // ]);


    $datax = [
      'name' => $user->name,
      'email' => $user->email,
    //   'otp' => $user->otp ?? ''
    ];

    // return $datax;



    try {


    Mail::to($user->email)
    ->send(new WelcomeMail($datax));

     // Mail::to($user->email)
    // ->send(new EmailVerificationMail($datax));



    } catch (\Throwable $th) {
    //     // throw $th;
    }


    $token = $user->createToken('auth_token')->plainTextToken;

    // return $token;


    // $user = User::where($user->id);

    return response()->json([
      'access_token' => $token,
      'user_data' => $user,
      'token_type' => 'Bearer',
    ]);
  }

  /**
   * Sign in to an existing account
   *
   * @bodyParam email string required
   * @bodyParam password string required

   * @return \Illuminate\Http\Response
   */

  public function login(Request $request)
  {
    # code...

    if (!Auth::attempt($request->only('email', 'password'))) {

      return response()->json([
        'message' => 'Invalid login details'
      ], 401);
    } else {

      $user = User::with('roles')->where('email', $request['email'])->firstOrFail();

      $token = $user->createToken('auth_token')->plainTextToken;

      return response()->json([
        'access_token' => $token,
        'role' => $user->roles[0]->name??'user',
        'user_data' => $user,
        'token_type' => 'Bearer',
      ]);
    }
  }

  /**
   * Validate the OTP sent
   * @header Authorization Bearer
   *
   * @bodyParam otp string required


   * @return \Illuminate\Http\Response
   */

  public function verify_otp(Request $request)
  {
    # code...


    $user = User::where('id', $request->user()->id)->where('otp', $request->otp)->first();

    if ($user) {


      return response()->json([
        // 'access_token' => $token,
        'user_data' => $user,
        'token_type' => 'Bearer',
      ]);
    }
  }

  /**
   * Reset OTP sent
   * @header Authorization Bearer

   * @return \Illuminate\Http\Response
   */

  public function resend_otp(Request $request)
  {
    # code...

    try {
      //code...

      $user = User::where('id', $request->user()->id)->first();

      if ($user) {

        $user->update([
          'otp' => rand(111111, 999999)
        ]);

        $datax = [
          'name' => $user->name,
          'email' => $user->email,
          'otp' => $user->otp
        ];
        //     Mail::to($user->email)
        //     ->send(new EmailVerification($datax));


        return response()->json([
          // 'access_token' => $token,
          'user_data' => $user,
          'token_type' => 'Bearer',
        ]);
      }
    } catch (\Throwable $th) {
      //throw $th;

      return $th;
    }
  }
}
