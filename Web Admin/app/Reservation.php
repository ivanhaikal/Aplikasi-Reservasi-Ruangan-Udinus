<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Reservation extends Model
{
    protected $table = 'reservation';
    protected $fillable = ['id','roomId','accountId','date','timeId'];


}
