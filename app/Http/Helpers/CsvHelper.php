<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CsvHelper
{
    // Method to generate CSV for airport actuals
    public static function generateAirportActualsCSVData(string $airport)
    {
        // Get session variables (replace with actual session data if available)
        $airport = session('sess_aport', 'AAL');  // Example session data, replace as needed
        $rstPgdload = DB::connection('db_con_latest')->table('latest_liveinput')
            ->join('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
            ->join('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->where('latest_liveinput.jracode', $airport)
            ->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt', 'latest_liveinput.paxchange', 'latest_liveinput.pax', 'latest_liveinput.dlup')
            ->get();

        $rstYtd = DB::connection('db_con_latest')->table('latest_ytd')
            ->where('jracode', $airport)
            ->select('pax_chytd', 'roll_ch', 'pax_ytd', 'roll_thisyr')
            ->first();

        // Check if data is available
        if ($rstPgdload->isEmpty() || !$rstYtd) {
            return response()->json(['error' => 'No data available for download.'], 404);
        }

        // Prepare CSV headers and content
        $csvData = [];
        $csvData[] = [];

        // Latest Total Passenger Actuals Section
        $csvData[] = ['Latest Total Passenger Actuals'];
        $csvData[] = ['', 'Month', 'Year to Date', 'Rolling 12 Month'];
        $csvData[] = [
            'Change %',
            number_format($rstPgdload->first()->paxchange, 2, '.', ',') . '%',
            number_format($rstYtd->pax_chytd, 2, '.', ',') . '%',
            number_format($rstYtd->roll_ch, 2, '.', ',') . '%'
        ];
        $csvData[] = [
            'Pax 000',
            number_format($rstPgdload->first()->pax, 0, '.', ','),
            number_format($rstYtd->pax_ytd, 0, '.', ','),
            number_format($rstYtd->roll_thisyr, 0, '.', ',')
        ];

        // Last 12 Months Pax Changes Section
        $csvData[] = ['Last 12 Months Pax Changes'];
        $csvData[] = ['Year', 'Month', '% Change'];

        // Fetch last 12 months data
        $latest12Data = DB::connection('db_con_latest')->table('latest_liveupdate')
            ->join('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')
            ->where('latest_liveupdate.jracode', $airport)
            ->orderBy('latest_liveupdate.dlup', 'asc')
            ->limit(12)
            ->get();

        foreach ($latest12Data as $data) {
            $csvData[] = [
                $data->dlup_year,
                $data->dlup_monthtxt,
                number_format($data->fc_change, 2, '.', ',')
            ];
        }

        // Last 12 Months Pax Numbers Section
        $csvData[] = ['Last 12 Months Pax Numbers'];
        $csvData[] = ['Year', 'Month', 'Pax Number (000)'];

        // Fetch last 12 months pax numbers
        $latest12PaxNumbers = DB::connection('db_con_latest')->table('latest_liveupdate')
            ->join('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')
            ->where('latest_liveupdate.jracode', $airport)
            ->orderBy('latest_liveupdate.dlup', 'asc')
            ->limit(12)
            ->get();

        foreach ($latest12PaxNumbers as $data) {
            $csvData[] = [
                $data->dlup_year,
                $data->dlup_monthtxt,
                number_format($data->fc, 2, '.', ',')
            ];
        }

        // Actual Data for the Last Two Years Section
        $csvData[] = ['Actual Data for the Last Two Years'];
        $csvData[] = ['Month', 'Pax (000)'];

        // Fetch actual data for the last two years
        $actualData = DB::connection('db_con_latest')->table('latest_liveupdate')
            ->join('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')
            ->where('latest_liveupdate.jracode', $airport)
            ->orderBy('latest_liveupdate.dlup', 'asc')
            ->get();

        foreach ($actualData as $data) {
            $csvData[] = [
                $data->dlup_monthtxt . ' ' . $data->dlup_year,
                number_format($data->fc, 2, '.', ',')
            ];
        }

        // Prepare CSV headers for download
        $csvFilename = 'ActualDownload.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFilename . '"',
        ];

        // Return the response
        return response()->stream(function () use ($csvData) {
            $handle = fopen('php://output', 'w');
            foreach ($csvData as $line) {
                fputcsv($handle, $line);
            }
        }, 200, $headers);
    }

    public static function generateCsvContent($airportNames, $datasetArray, $output, $output1)
    {
        fputcsv($output, ['Airport Forecasts Download']);
        fputcsv($output1, ['Airport Forecasts Download']);

        $curdate = now()->format('m/d/y');
        fputcsv($output, [$curdate]);
        fputcsv($output1, [$curdate]);

        fputcsv($output, [implode(',', $airportNames)]);
        fputcsv($output1, [implode(',', $airportNames)]);

        fputcsv($output, [implode(',', $datasetArray)]);
        fputcsv($output1, [implode(',', $datasetArray)]);

        fputcsv($output, ["PAX 000"]);
        fputcsv($output1, ["PAX 000"]);

        foreach ($airportNames as $airportName) {
            $airportId = DB::connection('db_con_409')->table('lupap')->where('apname', $airportName)->value('id_ap');

            if (!$airportId) {
                continue; // Skip invalid airport
            }

            $forecastData = DB::connection('db_con_409')->table('dlup')
                ->join('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
                ->whereIn('dlup.dlup_year', $datasetArray)
                ->where('dlup.id_dlup', '>=', 301)
                ->where('xa_mon.fc_ident', 1)
                ->where('xa_mon.ap_id', $airportId)
                ->select(
                    'dlup.dlup_year AS Year',
                    'dlup.dlup_monthtxt AS Month',
                    'xa_mon.fc3 AS International',
                    'xa_mon.fc4 AS Domestic',
                    'xa_mon.fc5 AS Total',
                    'xa_mon.fc3_change AS Int_change',
                    'xa_mon.fc4_change AS Dom_change',
                    'xa_mon.fc5_change AS Total_change'
                )
                ->orderBy('xa_mon.dlup')
                ->get();

            fputcsv($output, ["\n"]);
            fputcsv($output1, ["\n"]);

            fputcsv($output, [$airportName]);
            fputcsv($output1, [$airportName]);

            $headers = ['Year', 'Month', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change'];
            fputcsv($output, $headers);
            fputcsv($output1, $headers);

            foreach ($forecastData as $row) {
                $row = (array) $row; // Convert to array
                fputcsv($output, $row);
                fputcsv($output1, $row);
            }
        }
    }

    public static function downloadLatestCsvInt(string $aportCode)
    {
        // Get session variables (replace with actual session data if available)
        $aportCode = session('sess_aport', 'AAL');  // Example session data, replace as needed
        $lastDlup = session()->has('sess_lastdate') ? session('sess_lastdate') : 397;

        $monthName = DB::connection('db_con_latest')->table('latest_liveinput3')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput3.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput3.dlup')
            ->where('latest_liveinput3.jracode', $aportCode)
            ->value('dlup.dlup_fullmontxt');

        $filename = 'db_export__' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            "Content-Disposition" => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($aportCode, $lastDlup, $monthName) {
            $handle = fopen('php://output', 'w');

            // Section 1: YTD Percentage Change
            fputcsv($handle, ['Latest International Passenger Actuals']);
            fputcsv($handle, [' ', $monthName, 'Year to Date', 'Rolling 12 Month']);
            $ytdData1 = DB::connection('db_con_latest')->table('latest_liveinput3 as ll')
                ->join('latest_ytd_int as lyi', 'lyi.jracode', '=', 'll.jracode')
                ->selectRaw("1 as text, ROUND(ll.paxchange, 1) as paxchange, ROUND(lyi.pax_chytd, 1) as pax_chytd, ROUND(lyi.roll_ch, 1) as roll_ch")
                ->where('lyi.jracode', $aportCode)
                ->get();

            foreach ($ytdData1 as $row) {
                fputcsv($handle, ['Change %', $row->paxchange, $row->pax_chytd, $row->roll_ch]);
            }

            // Section 2: YTD Pax Values
            $ytdData2 = DB::connection('db_con_latest')->table('latest_liveinput3 as ll')
                ->join('latest_ytd_int as lyi', 'lyi.jracode', '=', 'll.jracode')
                ->selectRaw("1 as text2, ROUND(ll.pax) as pax, ROUND(lyi.pax_ytd) as pax_ytd, ROUND(lyi.roll_thisyr) as roll_thisyr")
                ->where('lyi.jracode', $aportCode)
                ->get();

            foreach ($ytdData2 as $row) {
                fputcsv($handle, ['Pax 000', $row->pax, $row->pax_ytd, $row->roll_thisyr]);
            }

            // Section 3: Last 12 Months Change %
            fputcsv($handle, ['Last 12 Months Pax Changes']);
            fputcsv($handle, ['Year', 'Month', '% Changes']);

            $latest12change = DB::connection('db_con_latest')->table('latest_liveupdate3')
                ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate3.dlup')
                ->where('latest_liveupdate3.jracode', $aportCode)
                ->whereBetween('latest_liveupdate3.dlup', [$lastDlup - 11, $lastDlup])
                ->orderBy('latest_liveupdate3.dlup')
                ->select('dlup.dlup_year', 'dlup.dlup_monthtxt', DB::raw('ROUND(latest_liveupdate3.fc_change, 1) as fc_change'))
                ->get();

            foreach ($latest12change as $row) {
                fputcsv($handle, [$row->dlup_year, $row->dlup_monthtxt, $row->fc_change]);
            }

            // Section 4: Last 12 Months Pax Numbers
            fputcsv($handle, ['Last 12 Months Pax Number']);
            fputcsv($handle, ['Year', 'Month', 'Pax Number']);

            $latest12pax = DB::connection('db_con_latest')->table('latest_liveupdate3')
                ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate3.dlup')
                ->where('latest_liveupdate3.jracode', $aportCode)
                ->whereBetween('latest_liveupdate3.dlup', [$lastDlup - 11, $lastDlup])
                ->orderBy('latest_liveupdate3.dlup')
                ->select('dlup.dlup_year', 'dlup.dlup_monthtxt', DB::raw('CEIL(latest_liveupdate3.fc) as pax_number'))
                ->get();

            foreach ($latest12pax as $row) {
                fputcsv($handle, [$row->dlup_year, $row->dlup_monthtxt, $row->pax_number]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }
}
