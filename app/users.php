<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    //
    protected $fillable = ['email','password','name','last_name'];

    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }
}

