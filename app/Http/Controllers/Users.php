<?php 
namespace App\Http\Controllers;

use Cartalyst\Sentinel\Users\EloquentUser as SentinelUser;


class Users extends SentinelUser
{

    protected $fillable = [
        'email',
        'password',
        'username'
    ];

    protected $loginName = ['email', 'username'];
}