<?php 

namespace SocialNetworkApp\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use SocialNetworkApp\Models\User;
class SearchController extends Controller {
    
    // $request->user() returns an instance of the authenticated user...
    
    public function getResults(Request $request){
        
        $query = $request->input('query');
        //dd($query);
        if(!$query) {
            
            return redirect()->route('home');
        }
        
        $users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE',"%{$query}%")
            ->get();
        
//        dd($users);
        return view('search.results')
                ->with('users',$users);
    }
}




?>