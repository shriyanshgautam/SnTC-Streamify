<?php

namespace App\Http\Middleware;

use Closure;

class CheckGoogleAuth
{
    protected $allowedLogin;
    public function __construct(){
        $this->allowedLogin = array("shriyanshgautam005@gmail.com","gensec.sntc@itbhu.ac.in","gensec.sntc@iitbhu.ac.in");
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $value = session('login_id', 'none');
        if(!in_array($value,$this->allowedLogin)){
            return redirect('/');
        }
        return $next($request);
    }
}
