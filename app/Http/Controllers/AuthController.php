<?php 

namespace SocialNetworkApp\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller {
    
    public function getSignup() {
        
        return view ('auth.signup');
    }
    public function postSignUp(Request $request) {
            
        
        //kill
        dd('sign up');
        
    }
}

?>