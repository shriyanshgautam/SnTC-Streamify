<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Secrets;
//require_once 'vendor/autoload.php';
use Google_Client; 

class LoginController extends Controller
{
    public function login(Request $request){
        if($request->has('google_token')){
            // if($request->google_token=='gensec.sntc@itbhu.ac.in'){
            //     session(['login_id' => 'gensec.sntc@itbhu.ac.in']);
            // }
            return $this->googleAuthentication($request->google_token);
             //return response($request->google_token);
        }
        //return response($request->google_token);
        //return redirect('/');
    }

    protected function googleAuthentication($id_token){
        $this->secrets = new Secrets();
        $googleOAuthClientId = $this->secrets->getGoogleOAuthClientId();
        $client = new Google_Client(['client_id' => $googleOAuthClientId]);
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
          $userid = $payload['sub'];
          // If request specified a G Suite domain:
          return response($payload);
        } else {
          return redirect('/');
        }
    }
}
