<?php 

namespace SocialNetworkApp\Http\Controllers;


use Illuminate\Http\Request;
use SocialNetworkApp\Models\User;
class ProfileController extends Controller {
    
    
    public function getProfile($username){
        
//        dd($username);
        
        $user = User::where('username', $username)->first();
        if(!$user) {
            
            abort(404);
        }
        return view ('profile.index')
            ->with('user',$user);
    }
}




?>