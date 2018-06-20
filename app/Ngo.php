<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ngo extends Model
{
    protected $fillable= ['ngoName','ngoCountry','description','website'];
}
