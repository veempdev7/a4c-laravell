<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class LoginApp extends Authenticatable
{
     protected $table = 'loginapp';
    protected $primaryKey = 'login_id';
    public $timestamps = false;

    protected $fillable = [
        'login_username',
        'login_password',
        'login_name',
        'login_region',
        'login_ipad',
        'login_emailad',
        'siteuser',
    ];

    protected $hidden = [
        'login_password', // hide password in JSON responses
    ];

}
