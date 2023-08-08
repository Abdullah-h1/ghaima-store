<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Str;

class UserController extends Controller
{
     /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            Customers::create([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => '/profile/icon_name.png',
            ]);
            
            $customer = Customers::where('id', $user->id)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $customer
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            $customer = Customers::where('id', $user->id)->first();
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                // 'token' => $user->createToken("API TOKEN")->accessToken->token,
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $customer
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    // Logout Api Method
    public function logout(Request $request)
    {
        try {
            // Auth::logout();
            // Get user who requested the logout
            // $user = $request->user(); //or Auth::user()

            // // Revoke current user token
            // $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
            // $user->currentAccessToken()->delete();
            if (auth()->user()){
            //     $token = $request->user()->token();
            // //return $token;
            //     $token->revoke();
                $user = $request->user();
                $user->currentAccessToken()->delete();
            }

            return response()->json([
                'status' => true,
                'message' => 'User Logged Out Successfully'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    // Update Profile Api Method
    public function upload(Request $request){
        try {
            
            $dir="profile/";
            $image = $request->file('image');
            $id = intval($request->id);
            $userDetails = [];

            if ($request->name != null){
                $userDetails['name'] = $request->name;
            }
            if ($request->phone !=null){
                $userDetails['phone'] = $request->phone;
            }
    
            $customer = Customers::where('id', $id)->first();
            if($customer){
                if ($request->has('image')) {
                        $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . "." . "png";
                        if (!Storage::disk('admin')->exists($dir)) {
                            Storage::disk('admin')->makeDirectory($dir);
                        }
                        Storage::disk('admin')->put($dir.$imageName, file_get_contents($image));
    
                        // $userDetails = [
                        //      'name' => $request->name,
                        //      'phone' => $request->phone,
                        //     'avatar' => trans('/'.$dir.$imageName),
                         
                        // ];
                        $userDetails['avatar'] = trans('/'.$dir.$imageName);
                        
                        Customers::where('id', $id)->update($userDetails);
                        
                        if($request->name != null){
                            $user = User::where('id', $id)->first();
                            $user->name = $request->name;
                            $user->save();
                        }

                        Storage::disk('admin')->delete('.'.$customer->avatar);
                }else{
                    //  return response()->json(['message' => trans('/uploads/'.$dir.'icon_name.png')], 200);
                //     $userDetails = [
                //         'name' => $request->name,
                //         'phone' => $request->phone,
                    
                //    ];
                   
                    Customers::where('id', $id)->update($userDetails);

                    if($request->name != null){
                        $user = User::where('id', $id)->first();
                        $user->name = $request->name;
                        $user->save();
                    }
                } 
    
            }
         
           
    
            $user = Customers::where('id', $id)->first();
        //   Customers::where('id', $request->id)->update($userDetails);
    
           return response()->json([
            'status' => true,
            'message' => 'Profile Saved Successfully',
            'user' => $user,
                                    ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
   }

    //    Forget Password Api Method
   public function forgetPassword(Request $request)
   {
        try {
            $user = User::where('email', $request->email)->get();

            if(count($user) > 0){

                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain.'/reset-password?token='.$token;

                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] = 'Reset Password';
                $data['body'] = 'Please click on below link to reset your password';

                Mail::send('forgetPasswordMail', ['data'=>$data], function ($message) use ($data) {
                    
                    $message->to($data['email'])->subject($data['title']);
                });

                $datetime = Carbon::now()->format('Y-m-d H:i:s');
                PasswordReset::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $datetime
                    ]
                );

                return response()->json([
                    'status' => false,
                    'message' => 'Please check your mail to reset your password'
                ]);

            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ]);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
   }
}
