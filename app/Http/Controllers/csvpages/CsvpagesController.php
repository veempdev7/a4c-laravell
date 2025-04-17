<?php

namespace App\Http\Controllers\csvpages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CsvpagesController extends Controller
{
    public function airportactuals_lot_csv(Request $request)
    {
        // Get the session variables
        $sessAport = session('sess_aport');
        $sessLastdate = session('sess_lastdate');
        dd($sessAport,$sessLastdate);
        // Define the CSV filename
        $csvFilename = 'ActualDownload.csv';

        // Create a new CSV file
        $output = fopen('php://output', 'a');

        // Write the CSV header
        fputcsv($output, array('Latest Total Passenger Actuals'));

        // Query the database
        $rstPgdload = DB::connection('db446161800')->table('latest_liveinput')
            ->join('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
            ->join('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->where('latest_liveinput.jracode', $sessAport)
            ->get();

        // Write the CSV data
        foreach ($rstPgdload as $row) {
            fputcsv($output, array(
                '',
                $row->dlup_fullmontxt,
                'Year to Date',
                'Rolling 12 Month'
            ));

            fputcsv($output, array(
                'Change %',
                number_format($row->paxchange, 1, '.', ',') . '%',
                number_format($row->pax_chytd, 1, '.', ',') . '%',
                number_format($row->roll_ch, 1, '.', ',') . '%'
            ));

            fputcsv($output, array(
                'Pax 000',
                number_format($row->pax, 0, '.', ','),
                number_format($row->pax_ytd, 0, '.', ','),
                number_format($row->roll_thisyr, 0, '.', ',')
            ));
        }

        // Close the CSV file
        fclose($output);

        // Return the CSV file as a response
        return response()->stream(function () use ($output) {
            echo $output;
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFilename . '"'
        ]);
    }
}
