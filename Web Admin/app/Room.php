<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'room';
    protected $fillable = ['code','name','capacity','image','image_2','image_3','type'];

    
    public function getImage(){
        if(!$this->image){
            return asset('room_image/default.png');
        }

        return asset('room_image/'.$this->image);
    }


}

