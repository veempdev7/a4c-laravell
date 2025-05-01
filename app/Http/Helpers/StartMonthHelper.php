<?php 

namespace App\Http\Helpers;

use Carbon\Carbon;

class StartMonthHelper
{
    public static function getReferences(): array
    {
        $year = now()->year;
        $month = now()->month;
        $year_count = 10; // default forecast span

        $yearData = [
            2007 => ['cM' => 194, 'cQ' => 65],
            2008 => ['cM' => 206, 'cQ' => 69],
            2009 => ['cM' => 218, 'cQ' => 73],
            2010 => ['cM' => 230, 'cQ' => 77],
            2011 => ['cM' => 242, 'cQ' => 81],
            2012 => ['cM' => 254, 'cQ' => 85],
            2013 => ['cM' => 266, 'cQ' => 89],
            2014 => ['cM' => 278, 'cQ' => 93],
            2015 => ['cM' => 290, 'cQ' => 97],
            2016 => ['cM' => 302, 'cQ' => 101],
            2017 => ['cM' => 314, 'cQ' => 105],
            2018 => ['cM' => 326, 'cQ' => 109],
            2019 => ['cM' => 338, 'cQ' => 113],
            2020 => ['cM' => 350, 'cQ' => 117],
            2021 => ['cM' => 362, 'cQ' => 121],
            2022 => ['cM' => 374, 'cQ' => 125],
            2023 => ['cM' => 386, 'cQ' => 129],
            2024 => ['cM' => 398, 'cQ' => 133],
            2025 => ['cM' => 410, 'cQ' => 137],
        ];

        $cM = $yearData[$year]['cM'] ?? null;
        $cQ = $yearData[$year]['cQ'] ?? null;

        if (is_null($cM) || is_null($cQ)) {
            return []; // or throw an exception
        }

        // Monthly reference calculations
        $stmon = $cM + ($month - 1);
        $nextMon = $stmon + 1;
        $graphmon = $stmon + 11;

        // Quarterly reference calculation
        switch ($month) {
            case 1: case 2: case 3:
                $stQuart = $cQ;
                break;
            case 4: case 5: case 6:
                $stQuart = $cQ + 1;
                break;
            case 7: case 8: case 9:
                $stQuart = $cQ + 2;
                break;
            default:
                $stQuart = $cQ + 3;
                break;
        }

        $nextQ = $stQuart + 1;

        // Annual references
        $styear = $year;
        $nextYr = $year + 1;

        return [
            'cY' => $year,
            'cM' => $cM,
            'cQ' => $cQ,
            'stmon' => $stmon,
            'nextMon' => $nextMon,
            'graphmon' => $graphmon,
            'stQuart' => $stQuart,
            'nextQ' => $nextQ,
            'styear' => $styear,
            'nextYr' => $nextYr,
            'year_count' => $year_count,
        ];
    }
}
