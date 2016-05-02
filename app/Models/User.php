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
    
    public function getFirstNameOrLastName() {
        
        return $this->first_name ?: $this->username;
    }
    
    //can has $size parameter 
    public function getAvatarUrl() {
        
        return "http://www.gravatar.com/avatar/{{ md5($this->email) }}?s=40&d=mm";
    }
    
}


?>