<?php 

namespace SocialNetworkApp\Http\Controllers;

use Auth;
use SocialNetworkApp\Models\User;
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
    
    
}

?>