<?php 
namespace App\Http\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;


class DownloadHelper
{
    public static function checkDownloadLimit()
    {
        $request = request(); // You can use request() helper
        
        $user = Auth::guard('loginapp')->user();
        $userId = $user?->login_id;
        $username = $user?->login_username;
        $company = $user?->login_company;

        $viewId = $request->input('dataview');
        $dataviewId = $request->input('dataview_id');

        $viewArr = DB::table('loginapp')->where('login_id', $userId)->value('restrictview');
        $viewArr = explode(',', $viewArr ?? '');

        $currentDate = date('Y-m-d');
        $checkMail = DB::table('downloadhistory')
            ->where('userid', $userId)
            ->where('selector', $viewId)
            ->whereDate('datet', $currentDate)
            ->where('count_download', 1)
            ->whereNull('countfile')
            ->count();

        $checkMailAll = DB::table('downloadhistory')
            ->where('userid', $userId)
            ->where('selector', $viewId)
            ->whereDate('datet', $currentDate)
            ->count();
        
        $countLimit = in_array($dataviewId, ['8', '9', '10']) ? 10 : 5;

        $blockedMessage = $checkMailAll / $countLimit;

        if ($checkMailAll >= $countLimit || in_array($dataviewId, $viewArr)) {
          //  Mail::to('testve0519@gmail.com')->send(new AlertMail($username, $company, $viewId, $blockedMessage));
            return "5"; // blocked
        }

        return "1"; // allowed
    }
}
