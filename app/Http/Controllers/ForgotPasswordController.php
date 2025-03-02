<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgot()
    {
        $credentials = request()->validate(['email'=> 'required|email']);

        Password::sendResetLink($credentials);

        return response()->json('reset link sent');
    }
    public function reset(ResetPasswordRequest $request)
    {
        $email_password_status = Password::reset($request->validated(), function ($user, $password){
            $user->password = bcrypt($password);
            $user->save();
        });
        if ($email_password_status == Password::INVALID_TOKEN){
            return response()->json('Invalid Token!');
        }

        return response()->json('Password Successfully Changed');
    }
}
