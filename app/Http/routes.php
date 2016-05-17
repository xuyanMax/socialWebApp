<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|

*/

/*
Home
*/
Route::get('/', [
    'uses' =>'\SocialNetworkApp\Http\Controllers\HomeController@index',
    'as' =>'home',
    
]);

Route::get('/alert', function() {
    return redirect()->route('home')->with('info','You\'ve signed up!');
});





/**
*   Authentication
*/


Route::get('/signup',[

    'uses' =>'\SocialNetworkApp\Http\Controllers\AuthController@getSignup',
    'as' =>'auth.signup',
    'middleware'=>['guest'],
]);


Route::post('/signup',[

    'uses' =>'\SocialNetworkApp\Http\Controllers\AuthController@postSignup',
    'as' =>'auth.signup',
    'middleware'=>['guest'],
]);
Route::get('/signin',[
    
    'uses' => '\SocialNetworkApp\Http\Controllers\AuthController@getSignin',
    'as' => 'auth.signin',
    'middleware'=>['guest'],
]);

Route::post('/signin',[
    
    'uses' => '\SocialNetworkApp\Http\Controllers\AuthController@postSignin',
    'as' => 'auth.signin',
    
    'middleware'=>['guest'],
]);

Route::get('/signout',[
    
    'uses' => '\SocialNetworkApp\Http\Controllers\AuthController@getSignout',
    'as' => 'auth.signout',
    
]);


/*
**
*Search
*/
Route::get('/search',[
    'uses' => '\SocialNetworkApp\Http\Controllers\SearchController@getResults',
    'as' => 'search.results',
]);


/*
**
*User profile
*/

Route::get('/user/{username}', [
    'uses' => '\SocialNetworkApp\Http\Controllers\ProfileController@getProfile',
    'as' => 'profile.index',
        
]);

Route::get('/profile/edit',[
    'uses' => '\SocialNetworkApp\Http\Controllers\ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware'=>['auth'],
]);

Route::post('/profile/edit',[
    'uses' => '\SocialNetworkApp\Http\Controllers\ProfileController@postEdit',  
    // a user can only update his or her profile. Thus middleware auth.
    'middleware'=>['auth'],
]);


/*
**
*Friends page
*/

Route::get('/friends',[
    
    'uses'=>'\SocialNetworkApp\Http\Controllers\FriendController@getIndex',
    'as'=>'friends.index',
    'middleware'=>['auth'],
]);

Route::get('/friends/add/{username}',[
    
    'uses'=>'\SocialNetworkApp\Http\Controllers\FriendController@getAdd',
    'as'=>'friends.add',
    'middleware'=>['auth'],
]);

Route::get('/friends/accept/{username}',[
    
    'uses'=>'\SocialNetworkApp\Http\Controllers\FriendController@getAccept',
    'as'=>'friends.accept',
    'middleware'=>['auth'],
]);

Route::post('/friends/delete/{username}',[
    
    'uses'=>'\SocialNetworkApp\Http\Controllers\FriendController@postDelete',
    'as'=>'friends.delete',
    'middleware'=>['auth'],
]);
/**
*
* Status
*/
/**
* MethodNotAllowedHttpException in RouteCollection.php line 219:
* if you use get 
*/
Route::post('/status',[
    
    'uses'=>'\SocialNetworkApp\Http\Controllers\StatusController@postStatus',
    'as'=>'status.post',
    'middleware'=>['auth'],
]);

Route::post('/status/{statusId}/reply',[
    
    'uses'=>'\SocialNetworkApp\Http\Controllers\StatusController@postReply',
    'as'=>'status.reply',
    'middleware'=>['auth'],
]);


Route::GET('/status/{statusId}/like',[
    
    'uses'=>'\SocialNetworkApp\Http\Controllers\StatusController@getLike',
    'as'=>'status.like',
    'middleware'=>['auth'],
]);

Route::GET('/status/{statusId}/unlike',[
    
    'uses'=>'\SocialNetworkApp\Http\Controllers\StatusController@getUnLike',
    'as'=>'status.unlike',
    'middleware'=>['auth'],
]);

Route::GET('/status/{statusId}/image/{fileName}',[
    
    'uses'=>'\SocialNetworkApp\Http\Controllers\StatusController@getImage',
    'as'=>'status.image',
    'middleware'=>['auth'],
]);


