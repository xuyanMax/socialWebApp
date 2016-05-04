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
    
    public function getAdd($username) {
    
//       dd($username);
        //'username' in DB
        $user = User::where('username',$username)->first();
//        dd($user);
        if(!$user) {
            
            return redirect()->route('home')
                ->with('info','That user could not be found.');
        }
        // check if the currently authenticated user has friendRequestPending passing in $user 
        //that are requesting us friend
        // or if other user has depending request from us(authenticated user )
        
        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending (Auth::user()) ) {
            return redirect()->route('profile.index', ['username' => $user->username] )
                ->with('info','Friend request already pending.');
        }
        
        if (Auth::user()->isFriendsWith($user) ) {
            
            return redirect()->route('profile.index',['username' => $user->username])
                ->with('info', 'You are already friends.');
        }
        
        Auth::user()->addFriend($user);
        
        return redirect()
                ->route('profile.index',['username'=>$user->username])
                ->with('info','Friend request sent.');
        
    }
    
    public function getAccept($username) {
        
        dd($username);
    }
    
    
}




?>