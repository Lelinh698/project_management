<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:teacher')->except('logout');
        $this->middleware('guest:student')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request){

        $messages = [
            "username.required" => "Hãy nhập username",
            "password.required" => "Hãy nhập password",
        ];

        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required'
        ]);

        $username = $request['username'];
        $password = $request['password'];


        if (Auth::guard('admin')->attempt(['username'=> $username,'password'=> $password]))
        {
            return redirect('/admin/project');
        } 
        elseif (Auth::guard('teacher')->attempt(['username'=> $username,'password'=> $password])) 
        {
            return redirect('/teacher');
        } 
        elseif (Auth::guard('student')->attempt(['username'=> $username,'password'=> $password])) 
        {
            return redirect('/student');
        }
        else
        {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function getLogout()
    {
        if (Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
        } 
        elseif (Auth::guard('teacher')->check()) 
        {
            Auth::guard('teacher')->logout();
        } 
        elseif (Auth::guard('student')->check()) 
        {
            Auth::guard('student')->logout();
        }
        return redirect('/');
    }
}
