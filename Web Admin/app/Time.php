<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = 'time';
    protected $fillable = ['id','time'];

    // public function account(){
    //     return $this->belongsToMany(Account::class)->withPivot(['date']);
    // }

    // public function room(){
    //     return $this->belongsToMany(Room::class)->withPivot(['date']);
    // }
}
