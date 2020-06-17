<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';
    protected $fillable = ['nim_npp','name_account','gender','dob','phone','email_account','status','image_account','password'];


    public function getProfile(){
        if(!$this->image_account){
            return asset('account_image/defaultprofile.jpg');
        }

        return asset('account_image/'.$this->image_account);
    }

}
