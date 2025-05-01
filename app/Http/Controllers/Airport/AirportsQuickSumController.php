<?php

namespace App\Http\Controllers\Airport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AirportsQuickSumController extends Controller
{
    //
    public function quicksumAm1()
    {
        // Get latest month values
        $monRow = DB::connection('db_con_latest')->table('latest_track3')->selectRaw('MAX(dlup) as max_dlup')->first();
        $mondlup = $monRow->max_dlup ?? null;

        $monthText = DB::connection('db_con_latest')
            ->table('dlup')
            ->select('dlup_fullmontxt')
            ->where('id_dlup', $mondlup)
            ->first();

        $title = ($monthText->dlup_fullmontxt ?? '') . ' International Passengers';

        // Get monthly chart data
        $trackData = DB::connection('db_con_latest')
            ->table('latest_track3')
            ->orderBy('dlup', 'asc')
            ->get(['montxt', 'datach']);

        $color = array_fill(0, count($trackData), '#E4B87B');

        $eur_bar_array = [];
        foreach ($trackData as $i => $row) {
            $eur_bar_array[] = [
                'country' => $row->montxt,
                'visits' => $row->datach,
                'color' => $color[$i],
            ];
        }

        return view('quicksumgraphs.quicksumam1', compact('eur_bar_array', 'title'));
    }

    public function quicksumAm2()
    {
        // Fetch data from the database
        $rst_monthno = DB::connection('db_con_latest')
                        ->table('latestnewmon')
                        ->first();

        $mon1 = $rst_monthno->newmon;

        $rst_mon1 = DB::connection('db_con_latest')
                        ->table('dlup')
                        ->where('id_dlup', $mon1)
                        ->first();

        $rst_track5 = DB::connection('db_con_latest')
                        ->table('latest_track3_afr')
                        ->select('id', 'dlup', 'montxt', 'datach', 'year')
                        ->get();

        $title = $rst_mon1->dlup_fullmontxt . " International Africa Passengers";

        $datay = [];
        $labelx = [];

        foreach ($rst_track5 as $row) {
            $datay[] = $row->datach;
            $labelx[] = $row->montxt;
        }

        // Colors
        $color = array_fill(0, count($datay), '#93684F');

        $eur_bar_array = [];
        foreach ($datay as $index => $visit) {
            $eur_bar_array[] = [
                'country' => $labelx[$index],
                'visits' => $visit,
                'color' => $color[$index],
            ];
        }

        // Pass data to the view
        return view('quicksumgraphs.quicksumam2', compact('eur_bar_array', 'title'));
    }

    public function quicksumAm3()
    {
        // 1. Get latest month IDs
        $monthNo = DB::connection('db_con_latest')
                     ->table('latestnewmon')
                     ->first();

        $mon1 = $monthNo->newmon;

        // 2. Get full month name
        $dlup = DB::connection('db_con_latest')
                  ->table('dlup')
                  ->where('id_dlup', $mon1)
                  ->first();

        // 3. Pull the Asia/Pacific track data
        $rows = DB::connection('db_con_latest')
                  ->table('latest_track3_asp')
                  ->select('montxt','datach')
                  ->orderBy('dlup','asc')
                  ->get();

        // 4. Build the chart data array
        $chartData = [];
        $color     = array_fill(0, $rows->count(), '#978D7E');

        foreach ($rows as $i => $row) {
            $chartData[] = [
                'country' => $row->montxt,
                'visits'  => $row->datach,
                'color'   => $color[$i],
            ];
        }
        
        // 5. Title (optional, you can also pass $dlup->dlup_fullmontxt to Blade)
        $title = "{$dlup->dlup_fullmontxt} International Asia/Pacific Passengers";

        return view('quicksumgraphs.quicksumam3', compact('chartData', 'title'));
    }

    public function quicksumAm4()
{
    // Fetch the current month identifiers
    $latestMonth = DB::connection('db_con_latest')->table('latestnewmon')->first();
    $mon1 = $latestMonth->newmon;
    $mon2 = $latestMonth->ixmon;

    // Get full month text
    $monInfo = DB::connection('db_con_latest')->table('dlup')->where('id_dlup', $mon1)->first();

    // Get chart data
    $trackData = DB::connection('db_con_latest')->table('latest_track3_eur')->select('montxt', 'datach')->get();

    $color = '#2D4160';
    $eurBarArray = $trackData->map(function ($row) use ($color) {
        return [
            'country' => $row->montxt,
            'visits' => $row->datach,
            'color' => $color
        ];
    });

    $title = $monInfo->dlup_fullmontxt . " International Asia/Pacific Passengers";

    return view('quicksumgraphs.quicksumam4', [
        'chartData' => $eurBarArray,
        'title' => $title
    ]);
}
     
public function quicksumAm5()
{
    // Fetch latest month info
    $latestMonth = DB::connection('db_con_latest')
        ->table('latestnewmon')
        ->first();

    $mon1 = $latestMonth->newmon;

    // Fetch full month name
    $monthData = DB::connection('db_con_latest')
        ->table('dlup')
        ->where('id_dlup', $mon1)
        ->first();

    // Fetch graph data
    $trackData = DB::connection('db_con_latest')
        ->table('latest_track3_latam')
        ->select('id', 'dlup', 'montxt', 'datach', 'year')
        ->get();

    $datay = [];
    $labelx = [];
    foreach ($trackData as $row) {
        $datay[] = $row->datach;
        $labelx[] = $row->montxt;
    }

    // Build chart data
    $color = array_fill(0, count($datay), '#EEDBB0');
    $chartData = [];
    foreach ($datay as $i => $val) {
        $chartData[] = [
            'country' => $labelx[$i],
            'visits' => $val,
            'color' => $color[$i] ?? '#EEDBB0',
        ];
    }

    $title = $monthData->dlup_fullmontxt . " International Asia/Pacific Passengers";

    return view('quicksumgraphs.quicksumam5', compact('chartData', 'title'));
}

public function quicksumAm6()
{
    $monInfo = DB::connection('db_con_latest')->table('latestnewmon')->first();
    $mon1 = $monInfo->newmon;

    $monData = DB::connection('db_con_latest')->table('dlup')->where('id_dlup', $mon1)->first();
    $title = $monData->dlup_fullmontxt . " International Asia/Pacific Passengers";

    $trackData = DB::connection('db_con_latest')->table('latest_track3_nam')
        ->select('montxt', 'datach')
        ->get();

    $color = array_fill(0, 12, '#365263');

    $chartData = [];
    foreach ($trackData as $index => $row) {
        $chartData[] = [
            'country' => $row->montxt,
            'visits' => $row->datach,
            'color' => $color[$index] ?? '#365263',
        ];
    }

    return view('quicksumgraphs.quicksumam6', compact('chartData', 'title'));
}

public function quicksumAm7()
{
    $monInfo = DB::connection('db_con_latest')->table('latestnewmon')->first();
    $mon1 = $monInfo->newmon;

    $monData = DB::connection('db_con_latest')->table('dlup')->where('id_dlup', $mon1)->first();
    $title = $monData->dlup_fullmontxt . " International MEA Passengers";

    $trackData = DB::connection('db_con_latest')
        ->table('latest_track3_mea')
        ->select('montxt', 'datach')
        ->get();

    $defaultColor = '#1A1627';
    $chartData = $trackData->map(function ($item) use ($defaultColor) {
        return [
            'country' => $item->montxt,
            'visits' => $item->datach,
            'color' => $defaultColor,
        ];
    });

    return view('quicksumgraphs.quicksumam7', [
        'chartData' => $chartData,
        'title' => $title,
    ]);
}


}
