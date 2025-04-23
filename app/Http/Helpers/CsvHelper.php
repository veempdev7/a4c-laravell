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
        $csvData[] = ['','Month', 'Year to Date', 'Rolling 12 Month'];
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
}

