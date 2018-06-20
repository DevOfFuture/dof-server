<?php

namespace App;

use User; 
use App\Developers; 

use Illuminate\Database\Eloquent\Model;

class Developers extends Model
{
    // @todo add "Description " column to the developers table 
    protected $fillable = ['githubLink','fullName','description'];

}
