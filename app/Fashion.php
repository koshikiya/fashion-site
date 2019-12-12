<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fashion extends Model
{
    protected $fillable = ['photo', 'user_id','tops','bottoms','shoes','accessory','fashion_comment'];

    public function user(){
        
        return $this->belongsTo(User::class);
    }
    
}

