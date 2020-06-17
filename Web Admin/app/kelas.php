<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['code','name','capacity','image','image_2','image_3','type'];

}