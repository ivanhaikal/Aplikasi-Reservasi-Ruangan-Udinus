<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'aula';
    protected $fillable = ['code','name','capacity','image','type'];

}
