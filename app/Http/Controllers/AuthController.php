<?php 

namespace SocialNetworkApp\Http\Controllers;
use Auth;
use SocialNetworkApp\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller {
    
    public function getSignup() {
        
        return view ('auth.signup');
    }
    public function postSignup(Request $request) {
            
        
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
        User::create([
        
            'email' =>$request->input('email'),
            'username' =>$request->input('username'),
            'password' =>bcrypt($request->input('password')),
        ]);
        
        return redirect()->route('home')-> with('info','Your account has been created.');
       
        
    }
    public function getSignin () {
        
        return view('auth.signin');
        
    }
    
    public function postSignin(Request $request) {
        

        $this->validate($request, [
            
            'email'=>'required',
            'password'=>'required',
        ]);
        
        //autenticate
        
               
        if(!Auth::attempt($request->only(['email','password']), $request->has('remember'))) {
            
            return redirect()
                ->back()
                ->with('info','Could not sign you in with those details.');
        }
        //redirect does not work here
        return redirect()
            ->route('home')
            ->with('info','You are now signed in.');
    }
    public function getSignout() {
        
        Auth::logout();
        
        return redirect()->route('home');
    }
    
    
}

?>