<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{
   protected $table="persons";
   public $timestamps=false;
    protected $fillable = [
        'address', 'streetName', 'state','phoneNumber'
    ];

}
