<?php

namespace App\Http\Controllers;

use App\Models\BusinessPage;
use App\Models\VerificationCode;
use App\Notifications\SuccessfulRegistration;
use AWS\CRT\Log;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;
use Validator;
use App\Models\User;


class JwtAuthController extends Controller
{

    public function __construct() {
        $this->middleware('api', ['except' => ['login', 'isms', 'register','updateUser', 'generateOTP']]);
    }
    public function isms(){
    }

    /**
     * Get a JWT via given credentials.
     */
    public function login(Request $request){
        $req = Validator::make($request->all(), [
            'phoneNumber' => 'required|exists:users|min:11',
            'password' => 'required|string|min:6',
        ]);
        try {
            if ($req->fails()) {
                return response()->json($req->errors(), 422);
            }

            if (! $token = auth('api')->attempt($req->validated())) {
                return response()->json(['Auth error' => 'Incorrect Password!'], 401);
            }
            return response()->json([
                'success' => true,
                'message' => 'Login Successful',
                'data' => $this->generateToken($token),
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed!',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Sign up.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateOTP(Request $request)
    {
        $req = Validator::make($request->all(), [
            'phoneNumber' => 'required|max:17|unique:users',
        ]);
        if($req->fails()){
            return response()->json($req->errors()->toJson(), 400);
        }else{
            $code = VerificationCode::create([
                'phoneNumber' => $request->phoneNumber,
                'otp' => rand(1111, 9999),
                'expire_at' => Carbon::now()->addMinutes(10)
            ]);

            $user = VerificationCode::where('phoneNumber', $request->phoneNumber)->latest()->first();
//        Notification::send($user, new SuccessfulRegistration());
            try {
                $sms = send_sms($user);
                return response()->json([
                    'success' => true,
                    'message' => 'OTP Sent Successfully',
                    'data' => $code,
                    'smsInfo' => $sms,
                ]);
            }catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Otp Send failed!',
                    'error' => $e->getMessage(),
                ]);
            }
        }

    }
    public function passResetOTP(Request $request)
    {
        $req = Validator::make($request->all(), [
            'phoneNumber' => 'required|max:17|exists:users,phoneNumber',
        ]);
        if($req->fails()){
            return response()->json($req->errors()->toJson(), 400);
        }else{
            $code = VerificationCode::create([
                'phoneNumber' => $request->phoneNumber,
                'otp' => rand(1111, 9999),
                'expire_at' => Carbon::now()->addMinutes(10)
            ]);

            $user = VerificationCode::where('phoneNumber', $request->phoneNumber)->latest()->first();
//        Notification::send($user, new SuccessfulRegistration());
            try {
                send_sms($user);
                return response()->json([
                    'success' => true,
                    'message' => 'OTP Sent Successfully',
                    'data' => $code,
                ]);
            }catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Otp Send failed!',
                    'error' => $e->getMessage(),
                ]);
            }
        }

    }
    public function verifyOTP(Request $request)
    {
        $user = VerificationCode::where('otp', $request->otpCode)->first();
        $now = Carbon::now();
        if ($user){
            if ($now->isAfter($user->expire_at)){
                $user->delete();
                return \response('Expired OTP!'); //cannot proceed to next page
            }else{
                $user->is_verified = 1;
                $user->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Otp Verified!',
                ]); //You can redirect to next page for registration
            }
        }else{
            return response()->json([
                'message' => 'send OTP again!!',
            ]); //You can redirect to next page for registration
        }
    }
    public function register(Request $request) {
        $req = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'phoneNumber' => 'required|max:17|unique:users',
            'email' => 'email|unique:users',
            'profession' => 'string',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($req->fails()){
            return response()->json($req->errors()->toJson(), 400);
        }

        $verified = VerificationCode::where('phoneNumber', $request->phoneNumber)->where('is_verified', 1)->latest()->first();
        if ($verified){
            if ($req->validated()){
                $user = new User;
                $user->name = $request->name;
                $user->password = bcrypt($request->password);
                $user->profession = $request->profession;
                $user->email = $request->email;
                $user->phoneNumber = $request->phoneNumber;
                $saved=$user->save();
                if ($saved){
                    $page = new BusinessPage();
                    $page->userId = $user->id;
                    $page->save();
                    if (! $token = auth('api')->attempt($req->validated())) {
                        return response()->json(['Auth error' => 'Incorrect Password!'], 401);
                    }
                    return response()->json([
                        'message' => 'User Signed Up & Logged In',
                        'token' => $this->generateToken($token),
                        'data'=>$req->validated(),
                        'user' => $user
                    ], 201);
                }
            };
        }else{
            return \response('not Verified!');
        }
    }
    public function setNewPass(Request $request) {
        $req = Validator::make($request->all(), [
            'phoneNumber' => 'required|max:17|exists:users,phoneNumber',
            'password' => 'required|string|min:6',
        ]);

        if($req->fails()){
            return response()->json($req->errors()->toJson(), 400);
        }

        $verified = VerificationCode::where('phoneNumber', $request->phoneNumber)->where('is_verified', 1)->latest()->first();
        if ($verified){
            $verified->delete();
            if ($req->validated()){
                $user = User::where('phoneNumber', $request->phoneNumber)->first();
                $user->password = bcrypt($request->password);
                $user->phoneNumber = $request->phoneNumber;
                $saved=$user->update();
                if ($saved){

                    return response()->json([
                        'message' => 'User Password Changed!',
                        'user' => $user
                    ], 201);
                }
            };
        }else{
            return \response('not Verified!');
        }
    }
    public function updateUser(Request $request) {
        $user = User::where('id',$request->id)->first();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        if ($request->email !== $user->email){
            $user->email = $request->email;
        }
        $user->fbUrl = $request->fbUrl;
        $user->ytUrl = $request->ytUrl;
        $user->linkedUrl = $request->linkedUrl;
        $user->image = $request->image;
        if (password_verify($request->old_password, $user->password)){
            $user->password = bcrypt($request->password);
            $user->phoneNumber = $request->phoneNumber;
        }
        $user->update();
        return response()->json([
            'message' => 'successful',
            'user' => $user
        ]);
    }

    public function pdsms()
    {
        send_sms();
//        $to = "01784033051";
//        $token = "8548121550166555535067bce2951b3801de3323494020e93527";
//        $message = "Test SMS using API";
//
//        $url = "http://api.greenweb.com.bd/api.php?json";
//
//
//        $data= array(
//            'to'=>"$to",
//            'message'=>"$message",
//            'token'=>"$token"
//        ); // Add parameters in key value
//        $ch = curl_init(); // Initialize cURL
//        curl_setopt($ch, CURLOPT_URL,$url);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//        curl_setopt($ch, CURLOPT_ENCODING, '');
//        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $smsresult = curl_exec($ch);
//
////Result
//        echo $smsresult;
//
////Error Display
//        echo curl_error($ch);

    }

    /**
     * Sign out
     */
    public function signout() {
        auth('api')->logout();
        return response()->json(['message' => 'User loged out']);
    }

    /**
     * Token refresh
     */
    public function refresh() {
        return $this->generateToken(auth('api')->refresh());
    }

    /**
     * User
     */
    public function user() {
        return response()->json(auth('api')->user());
    }

    /**
     * Generate token
     */
    protected function generateToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 43200,
            'user' => auth('api')->user()
        ]);
    }
}
