<?php

namespace App\Http\Controllers\Auth;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
  
        protected $redirectTo = '/dashboard';
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*public function login(Request $request)
    {

        
       
    // DB::table('admin_user_logs')->insert(
    //['user_id' => Auth::user()]
    // );

    }*/
    public function showAdminLoginForm()
    {
        return view('auth.login');
    }

     protected function authenticated(Request $request, $user)
     {
        if($user->hasRole('User'))
        {
          \Auth::logout();
         return redirect('/admin') ->withErrors(
             'Login Failed ');
        }

         DB::table('admin_user_logs')->insert(
                    ['user_id' => $user->id,
                      'platform'=> '',
                      'ip'=>$request->ip(),
                      'login'=>date('Y-m-d H:i:s'),
                      'current_login_status'=>'1'
                      //'logout'=>
                      ]);

      // }
      // else if($user->hasRole('User'))
      // {
           /*DB::table('user_logs')->insert(
                            ['user_id' => $user->id,
                              'platform'=> '',
                              'ip'=>$request->ip(),
                              'login'=>date('Y-m-d H:i:s'),
                              'current_login_status'=>'1'
                              //'logout'=>
                              ]);*/

      // }

     }


}
