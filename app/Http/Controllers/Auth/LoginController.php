<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    //protected $redirectTo = 'user-dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct()
{
    if(Auth::check() && User::role('Admin')){
        dd('admin');
        $this->$redirectTo = route('admin-dashboard');
    }
    elseif(Auth::check()){
        dd('ahay');
        $this->$redirectTo = route('user-dashboard');

    }
    $this->middleware('guest')->except('logout');
}

protected function authenticated($request, $user){
    if($user->hasRole('Admin')){
        return redirect('admin-dashboard');
    } else {
        return redirect('user-dashboard');
    }
}


}
