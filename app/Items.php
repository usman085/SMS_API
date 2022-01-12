<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
  protected $fillable = [
        'name', 'capacity','phone_num','group','iccid','source_address'
    ];
}
