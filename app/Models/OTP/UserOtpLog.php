<?php

namespace App\Models\OTP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOtpLog extends Model
{
    use HasFactory;

    protected $table = 'tbl_user_otp_logs';  // Table name

    // Fillable columns
    protected $fillable = ['id', 'login_email', 'email_otp', 'expire_time', 'added_at', 'ip_address'];

    // Disable the timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = false;

    // You can add custom methods if needed
}
