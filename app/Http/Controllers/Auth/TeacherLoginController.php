<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


class TeacherLoginController extends Controller
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

    protected $guard = 'teacher';

    // protected $username = 'username';


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/filelist/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:teacher')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return Auth::guard('guard-name');
    }

    public function showLoginForm()
    {
        return view('teacher.teacherLogin');
    }

    public function login(Request $request){

        $this->validate($request, [
            // 'username '   => 'required|min:3',
            'password' => 'required|min:6'
        ]);

        $username = $request['username'];
        $password = $request['password'];


        if (Auth::guard('teacher')->attempt(['username'=> $username,'password'=> $password]))
        {
            return redirect('/teacher/ds');
        } 
        else
        {
            return redirect()->back()->with('thongbao', 'Email hoặc Password không chính xác');
        }
    }

    public function getLogout()
    {
        Auth::guard('teacher')::logout();
        return redirect()->url('/teacher/login');
    }
}
