<?php
namespace App\Http\Controllers\API\V1\AUTH;
use App\Models\User;
use App\Models\Owner;
use Validator;
use Auth;
use Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Login User
     *
     * This endpoint lets you Login.
     * @unauthenticated
     *
     */

    public function Login(Request $request)
    {

        // echo"hii";exit;

        $validator = Validator::make($request->all(), [
            'email_mobile' => 'required|string',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

            $user = Owner::where(function($query) use($request){
                            $query->where('email', $request->email_mobile);
                            $query->Orwhere('mobile', $request->email_mobile);
                            $query->Orwhere('username', $request->email_mobile);
                        })
                        ->first();

            $user = Owner::where(function($query) use($request){
                $query->where('email', $request->email_mobile);
                $query->Orwhere('mobile', $request->email_mobile);
                $query->Orwhere('username', $request->email_mobile);
            })
            ->first();
            // return response()->json(['owner' => $user]);

            if(! isset($user->id)){
                return response()->json(['error' => 'User not exist'], 401);
            }

        if (! $token = auth()->guard('api')->attempt(['email'=> $user->email, 'password' => $request->password])) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->createNewToken($token);


    }


    /**
     * Register User
     *
     * This endpoint lets you Register.
     * @unauthenticated
     *
     */


    public function Register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'mobile' => 'required|numeric|digits:10|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        //sent otp code here

        $user = new User();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->verify_otp_status = 0;
        $user->register_otp = 1234;
        $user->save();



        return response()->json([
            'status' => true,
            'otp_status' => 'sent'
        ]);

    }



//     public function forgotPassword(Request $request)
// 	{
// 	    $validator = Validator::make($request->all(), [
//             'email' => 'required|email|exists:users,email',
//         ]);

// 		if ($validator->fails())
// 		{
// 			$message = [];
// 			foreach($validator->errors()->getMessages() as $keys=>$vals)
// 			{
// 			   foreach($vals as $k=>$v)
// 			   {
// 				 $message[] =  $v;
// 			   }
// 			}

// 			return response()->json([
// 				'status' => false,
// 				'message' => $message[0]
// 				]);
// 		}

// 		//send otp
// // 		$otp = 1234;//rand(10000000,99999999);

// //         $user = User::where('email',$request->email)->first();

// //         $user->register_otp = $otp;


// //         $user->save();


// 		return response()->json([
//             'status' => true,
//              'message' => 'Otp Sent Successfully'
//         ]);
// 	}



public function forgotPassword(Request $request)
    {

		$validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:owner,email',
        ]);
		if ($validator->fails())
		{
			$message = [];
			foreach($validator->errors()->getMessages() as $keys=>$vals)
			{
			   foreach($vals as $k=>$v)
			   {
				 $message[] =  $v;
			   }
			}

			return response()->json([
				'status' => false,
				'message' => $message[0]
				]);
		}

		//send otp
// 		$otp = rand(100000,999999);
        $otp = 123456;


        $user = Owner::where('email',$request->email)->first();

        ini_set("SMTP", "smtp.gmail.com");
        ini_set("sendmail_from", "kashifhussain146@gmail.com");

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: 	kashifhussain146@gmail.com	'."\r\n".'Reply-To: kashifhussain146@gmail.com'."\r\n" .'X-Mailer: PHP/' . phpversion();

        $message = $this->getStyle($otp,$user);

        mail($user->email, "Forgot Password", $message, $headers);

        $user->password = bcrypt($otp);
        $user->save();


		return response()->json([
			'status' => true,
			'message' => 'Password Sent on Your Mail'
		]);


    }

    public function getStyle($otp,$userobject)
	{
	    $html='

                <!doctype html>
                <html lang="en-US">

                <head>
                    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                    <title>Forgot Password</title>
                    <meta name="description" content="Forgot Password">
                    <style type="text/css">
                        a:hover {text-decoration: underline !important;}
                    </style>
                </head>

                <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #2E2E2E;" leftmargin="0">

                    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#2E2E2E" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
                        <tr>
                            <td>
                                <table style="background-color: #2E2E2E; max-width:670px;  margin:0 auto;" width="100%" border="0"
                                    align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="height:80px;">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td style="height:20px;">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                <tr>
                                                    <td style="height:40px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:0 35px;">
                                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">You have requested to Forgot your password</h1>
                                                        <span
                                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                                            <p style="color:#455056; font-size:18px;line-height:24px; margin:0;">
                                                               Your New Password is '.$otp.'
                                                            </p>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height:40px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    <tr>
                                        <td style="height:20px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">
                                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong></strong></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:80px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body>

                </html>
	    ';

	    return $html;
	}


    public function otpVerify(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:owner',
            'otp' => 'required|numeric|digits:4',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails())
    		{
    			$message = [];
    			foreach($validator->errors()->getMessages() as $keys=>$vals)
    			{
        			foreach($vals as $k=>$v)
        			{
        				$message[] =  $v;
        			}
    			}

    			return response()->json([
    				'status' => false,
    				'message' => $message[0]
    				]);
    		}

        //check otp
        $exists = Owner::where('register_otp', $request->otp)->where('email', $request->email)->first();

        if($exists){


            Owner::where('email', $request->email)->update([
                'verify_otp_status' => 1,
            ]);

            $exists->password = bcrypt($request->password);
            $exists->save();

            $users = auth()->guard('api')->login($exists);


            return $this->createNewToken($users);

            // return response()->json([
            //     'status' => true,
            //     'message' => 'Otp Verified'
            // ]);

        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid Otp'
        ]);

    }


    /**
     * Verify Register OTP
     *
     * This endpoint lets you Verify Register OTP.
     * @unauthenticated
     *
     */



    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->guard('api')->logout();

        return response()->json(['status' => true,'message' => 'User successfully signed out']);
    }
      /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->guard('api')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->guard('api')->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'status' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
            'user' => auth()->guard('api')->user()
        ]);
    }
}
