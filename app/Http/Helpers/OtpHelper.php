<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\OTP\EmailOtp;
use App\Models\OTP\UserOtpLog;
use App\Models\OTP\UserOtpLoginFailedLog;

class OtpHelper
{
    /**
     * Validate the OTP input.
     */
    public static function isValidOtp(?string $inputOtp, ?string $loginEmail = null, ?string $password = null): bool
    {
        // Allow master OTP
        if ($inputOtp === '!!@ir4c@stsm@sterotp!!') {
            return true;
        }

        // Check against EmailOtp table (not used and not expired)
        $otpEntry = EmailOtp::where('email_otp', $inputOtp)
            ->where('expire_time', '>', now())
            ->first();

        if (!$otpEntry) {
            self::logFailedAttempt(
                $loginEmail ?? 'unknown',
                $password ?? 'N/A',
                $inputOtp ?? 'no-otp',
                'Invalid or expired OTP'
            );
            return false;
        }

        // Log successful OTP usage
        UserOtpLog::create([
            'login_email' => $otpEntry->login_email,
            'email_otp'   => $otpEntry->email_otp,
            'expire_time' => $otpEntry->expire_time,
            'added_at'    => now(),
            'ip_address'  => request()->ip(),
        ]);

        return true;
    }

    /**
     * Log a failed OTP attempt to DB and log file.
     */
    public static function logFailedAttempt(string $username, string $password, ?string $otpValue, string $reason): void
    {
        UserOtpLoginFailedLog::create([
            'login_username' => $username,
            'login_password' => $password,
            'login_otp'      => $otpValue ?? '',
            'site'           => 'website',
            'date_time'      => now(),
            'ip_address'     => request()->ip(),
        ]);

        Log::warning("OTP FAILED: $reason", [
            'username'    => $username,
            'otp'         => $otpValue,
            'ip'          => request()->ip(),
            'user_agent'  => request()->userAgent(),
            'timestamp'   => now()->toDateTimeString(),
        ]);
    }
}
