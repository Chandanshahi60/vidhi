<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin;
use App\Models\Society;
use Hash;
use Auth;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('admin.guest:admin', ['except' => 'logout']);

    }

    public function showLoginForm(){
        $society = Society::get();
        $role = DB::table('roles')->get();
        return view("auth.login",compact('society','role'));
    }

    public function login(\Illuminate\Http\Request $request){

        $email = $request->email;
        $password = $request->password;

        $admin = Admin::where('email',$email)->first();
        if($admin){

            if(Hash::check($password, $admin->password)){

                Auth::guard("admin")->login($admin);

                if (!session()->has('society_id')) {

                    $society = $request->society_id; //DB::table('society')->latest()->first();
                    session()->put('society_id', $society);

                }

                return redirect()->route("admin.dashboard");

            }
            else{

                return redirect()->back();

            }

        }
        else{
            return redirect()->back();
        }
    }


    protected function redirectTo()
    {
        $user = Auth::guard('admin')->user();
        return '/admin/dashboard';
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function logout(\Illuminate\Http\Request $request) {
        Auth::guard('admin')->logout();

        session()->forget('society_id');

        return redirect()->route('admin.login');
    }



}
