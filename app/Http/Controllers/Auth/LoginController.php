<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use App\User;

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
    protected $redirectTo = '/admin/inicio';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
       
        $this->middleware('guest')->except('logout');
        //$this->middleware('Suspendido')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }

    public function username(){
        return 'usuario';
    }
/*
    protected function primerLogeo(){
        $usuarios = User::findorfail($id);

        return $usuarios;
  
    }*/
    protected function sendLoginResponse(Request $request){
    $request->session()->regenerate();
    $previous_session = Auth::User()->session_id;
    if ($previous_session) {
        Session::getHandler()->destroy($previous_session);
    }

    Auth::user()->session_id = Session::getId();
    Auth::user()->save();
    $this->clearLoginAttempts($request);

    return $this->authenticated($request, $this->guard()->user())
        ?: redirect()->intended($this->redirectPath());
    }
}
