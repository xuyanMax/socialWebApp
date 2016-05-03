<?php

namespace SocialNetworkApp\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract {
    
    use Authenticatable;
  
    protected $table = 'users';
    
    
    protected $fillable = [
                'username',
                'first_name',
                'last_name',
                'location',
                'email',
                'password'
    ]; 
    
    protected $hidden = [
            'password',
            'remember_token'
    ];
    
    public function getName() {
        
        if($this->first_name && $this->last_name) {
            
            return "{$this->first_name} {$this->last_name}";
        }
        if($this->first_name) {
            
            return $this->first_name;
        }
        
        return null;
    }
    public function getNameOrUsername() {
        
        return $this->getName() ?: $this->username;
        
    }
    
    public function getFirstNameOrUsername() {
        
        return $this->first_name ?: $this->username;
    }
    
    //can has $size parameter 
    public function getAvatarUrl() {
        
        return "http://www.gravatar.com/avatar/{{ md5($this->email) }}?s=40&d=mm";
    }
    //A pivot table is a database table that only serves a many-to-many relationship .
    // define the pivot table in Laravel
   
    public function friendsOfMine() {
        //first argument: name of class User
        //second argument: name of pivot table
        //third & forth arguments: 
        //self-related seen from argument 1
        return $this->belongsToMany('SocialNetworkApp\Models\User','friends','user_id','friend_id');
    }
    
    public function friendOf() {
        
        return $this->belongsToMany('SocialNetworkApp\Models\User','friends','friend_id','user_id');
    }
    
    public function friends() {
        //get():Execute the query as a "select" statement. Return as a collection
        
        return $this->friendsOfMine()->wherePivot('accepted',true)->get()->merge($this->friendOf()
                ->wherePivot('accepted',true)->get());
        
    }
    
}


?>