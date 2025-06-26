<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Useraja extends Model
{
    protected $table ='useraja' ;
    protected $fillable = [
        'name', 'email', 'password',
    ];


}
