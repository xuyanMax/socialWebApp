<?php

namespace SocialNetworkApp\Models;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Status extends Model {
    
    protected $table = 'statuses';
    
    protected $fillable = [
        'body',
    ];
    // define inverse one to one relation
    //foreign key 'user_id'
    public function user() {
        
        return $this->belongsTo('SocialNetworkApp\Models\User','user_id');
    }
    
}