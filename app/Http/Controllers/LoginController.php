<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Secrets;
//require_once 'vendor/autoload.php';
use Google_Client;

class LoginController extends Controller
{
    protected $allowedLogin;
    public function __construct(){
        $this->middleware('google_auth',['except' => ['login','login_form']]);
        $this->allowedLogin = array("shriyanshgautam005@gmail.com","gensec.sntc@itbhu.ac.in","gensec.sntc@iitbhu.ac.in");
    }

    public function login_form(Request $request){
        return view('login');
    }

    public function login(Request $request){
        if(!$request->has('google_token')){
            return redirect('/')->with(['status'=>'error','status_string'=>'Error in logging in (01)!']);
        }

        if(!$request->has('user_email')){
            return redirect('/')->with(['status'=>'error','status_string'=>'Error in logging in (02)!']);
        }


        if(in_array($request->user_email,$this->allowedLogin)){
            session(['login_id'=>$request->user_email]);
            return redirect('notifications');
        }
        return redirect('/')->with(['status'=>'error','status_string'=>'Error in logging in (03)!']);;
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
}
