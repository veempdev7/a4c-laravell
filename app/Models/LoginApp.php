<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class LoginApp extends Authenticatable
{
    // Set the table name explicitly
    protected $table = 'loginapp';

        // If needed, specify the primary key (e.g., if it's not the default 'id')
    // protected $primaryKey = 'your_primary_key';
    protected $primaryKey = 'login_id';
    // Optional: Set timestamps if you don't have created_at and updated_at columns in your table
    // public $timestamps = false;
    public $timestamps = false;
    protected $fillable = ['login_username', 'login_password'];


   
}
