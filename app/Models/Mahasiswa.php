<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    protected $fillable = ['nama', 'nim', 'email', 'password', 'jurusan'];
    protected $table = 'mahasiswa';
}
