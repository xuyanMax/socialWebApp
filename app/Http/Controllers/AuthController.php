<?php 

namespace SocialNetworkApp\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller {
    
    public function getSignup() {
        
        return view ('auth.signup');
    }
    public function postSignUp(Request $request) {
            
        
//        //kill
//        dd('sign up...');
//        validate
        $this->validate($request, [
            
                'email' => 'required|unique:users|email|max:255',
                'username' => 'required|unique:users|alpha_dash|max:20',
                'password' => 'required|min:6',
            
        ]);
        //Dump and Die
//        dd('All ok');
        
        
    }
}

?>