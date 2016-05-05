<?php 

namespace SocialNetworkApp\Http\Controllers;

use Auth;
use SocialNetworkApp\Models\User;
use SocialNetworkApp\Models\Status;
use Illuminate\Http\Request;


class StatusController extends Controller {
    
   
    public function postStatus(Request $request) {
        
        $this->validate($request,[
            
            'status'=> 'required|max:128',
        ]);
        
//        dd('all ok');
        
        Auth::user()->statuses()->create([
            'body'=>$request->input('status'),
            
        ]);
        return redirect()
                ->route('home')
                ->with('info','Status posted.');
    }
    
    public function postReply(Request $request, $statusId ) {
        
//            dd($statusId);
        //validate
        
        $this->validate($request, [
            
            "reply-{$statusId}" => 'required|max:888',
            
        ],[
            'required'=>'The reply is required',
            
        ]);
//        dd('all ok');
        $status = Status::notReply()->find($statusId);
        
        //check
        
        if(!$status) {
            
            return redirect()->route('home');
        }
        
        //check
        
        if(!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id) {
            
            return redirect()->route('home')->with('info','You are your best friend.');
        }
        
        $reply = Status::create([
            
            'body'=>$request->input("reply-{$statusId}"),
        ])->user()->associate(Auth::user());
        
        $status->replies()->save($reply);
        
        return redirect()->back();
    }
    
    
}

?>