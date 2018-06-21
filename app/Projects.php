<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    //
    protected $fillable= ['projectTitle','description','level','dueDate','status'];

    protected $ngo;

    protected $developers; 
}
