<?php

namespace SocialNetworkApp;

use Illuminate\Auth\Autenticatable;
use Illuminate\Auth\Eloquent\Model;
use Illuminat\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implement AuthenticatableContract {
    
    use Autenticatable;
    /**
    * The database table usedby the model.
    *
    * @var string
    */
    protected $table = 'users';
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    
    protected $fillable = ['name','email','password']; 
    
    /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
    
    protected $hidden = ['password','remember_token'];
    
}


?>