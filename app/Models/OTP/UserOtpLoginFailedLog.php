<?php

namespace App\Models\OTP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOtpLoginFailedLog extends Model
{
    use HasFactory;

    protected $table = 'tbl_user_otp_login_failed_logs';  // Table name

    // Fillable columns
    protected $fillable = ['id','login_username','login_password','login_otp','site','date_time', 'ip_address'];

    // Disable the timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = false;

    // You can add custom methods if needed
}
