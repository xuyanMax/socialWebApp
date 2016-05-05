<?php

namespace SocialNetworkApp\Models;
use Illuminate\Database\Eloquent\Model;
class Like extends Model {
    
    protected $table = 'likeable';
    
    public function Likeable() {
        
        return $this->morphTo();
        
    }
    // who like 
    public function user() {
        
        return $this->belongsTo('SocialNetworkApp\Models\User','user_id');
    }
}



?>