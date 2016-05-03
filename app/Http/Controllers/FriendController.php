<?php 

namespace SocialNetworkApp\Http\Controllers;

use Illuminate\Http\Request;
use SocialNetworkApp\Models\User;
use Auth;

class FriendController extends Controller {
    
    
    public function getIndex() {
        
        //Once a user is authenticated, you may access the User model / record
        $friends = Auth::user()->friends();
        
        $requests = Auth::user()->friendRequests();
        
        return view('friends.index')
            ->with('friends',$friends)
            ->with('requests',$requests);
    }
    
    
}




?>