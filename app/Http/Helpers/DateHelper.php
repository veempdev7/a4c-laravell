<?php

namespace App\Http\Helpers;


class DateHelper
{
    public static function getUpdateDates($lag = 3)
    {
        $thisupdate = date('j F');
        $thisupdateYr = date('j F Y');
        $nxtupdate = date('j F', mktime(0,0,0,date('m'), date('d')+$lag, date('Y')));
        $nxtupdateYr = date('j F Y', mktime(0,0,0,date('m'), date('d')+$lag, date('Y')));

        return [
            'thisupdate' => $thisupdate,
            'thisupdateYr' => $thisupdateYr,
            'nxtupdate' => $nxtupdate,
            'nxtupdateYr' => $nxtupdateYr,
        ];
    }
}