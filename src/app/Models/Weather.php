<?php

namespace Prrwebcreate\Weather\app\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{

    protected $table = 'weather';
    protected $fillable = ['sunrise', 'sunset','weather','icon','temp','temp_min','temp_max','temp_feel','pressure','humidity','clouds','name','created_at','updated_at'];
 
   
}
