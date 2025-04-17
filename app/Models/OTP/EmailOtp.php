<?php

namespace App\Models\OTP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailOtp extends Model
{
    use HasFactory;

    protected $table = 'tbl_email_otp';  // Table name

    // Fillable columns (allow mass-assignment)
    protected $fillable = ['id ','login_email','email_otp', 'expire_time', 'added_at'];

    // Disable the timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = false;

    // You can add any custom methods related to this model here.
}
