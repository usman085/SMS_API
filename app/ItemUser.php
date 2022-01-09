<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemUser extends Model
{
    protected $fillable = [
        'item_id', 'user_id'
    ];

     public function Items()
    {
        return $this->hasOne('App\Items','id','item_id');
    }
 public function User()
    {
        return $this->hasOne('App\User','id','user_id');
    }
    
}
