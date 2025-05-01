<?php

namespace App\Http\Controllers\Airport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\CSVHelper;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\AlertMail;
use App\Http\Helpers\StartMonthHelper;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;


class AirportController extends Controller
{
    public function airportshome()
    {
        return view('airports.airportshome');
    }

    public function actualsForecastMulti()
    {
        $userId = Auth::guard('loginapp')->user()?->login_id;

        $airports = DB::connection('db_con_409')->table('lupap')->orderBy('apname', 'asc')->get();
        return view('airports.actuals_forecasts_multi', compact('airports'));
    }

    public function airportActualCountryMultiCompareData()
    {
        return view('airports.airport_actual_country_multi_comparedata');
    }

    public function airportActualMultiCompareData()
    {
        return view('airports.airport_actual_multi_comparedata');
    }

    public function airportForecastCountryMultiCompareData()
    {
        return view('airports.airport_forecast_country_multi_comparedata');
    }

    public function airportForecastsCountryMulti()
    {
        return view('airports.airport_forecasts_country_multi');
    }

    public function airportForecastsMultiSelector()
    {
        return view('airports.airportforecasts_multiselector');
    }

    public function airportsActualAirports()
    {
        return view('airports.airportsactualairports');
    }

    public function airportsActualAirportsCountryMulti()
    {
        return view('airports.airportsactualairportscountrymulti');
    }

    public function airportsActualAirportsMulti()
    {
        return view('airports.airportsactualairportsmulti');
    }

    public function airportsActualLatMonth()
    {
        $curmonth = date("M");
        $curyear = date("Y");

        // Get current dlup ID
        $dlupMonth = DB::connection('db_con_latest')
            ->table('dlup')
            ->select('id_dlup', 'dlup_fullmontxt')
            ->where('dlup_monthtxt', $curmonth)
            ->where('dlup_year', $curyear)
            ->first();

        $dlup_id_val = $dlupMonth->id_dlup;
        $dlup_id = $dlup_id_val - 1;
        $dlup_id2 = $dlup_id_val - 2;
        $dlup_id3 = $dlup_id_val - 3;
        $dlup_id4 = $dlup_id_val - 4;
        $dlup_id5 = $dlup_id_val - 5;
        $dlup_id6 = $dlup_id_val - 6;

        // Get previous full month and year
        $prevMonth = DB::connection('db_con_latest')
            ->table('dlup')
            ->select('dlup_fullmontxt', 'dlup_year')
            ->where('id_dlup', $dlup_id)
            ->first();

        $full_month = $prevMonth->dlup_fullmontxt;
        $full_year = $prevMonth->dlup_year;

        // Last 3 months for international
        $dlupThreeMonths = DB::connection('db_con_latest')
            ->table('dlup')
            ->whereIn('id_dlup', [$dlup_id, $dlup_id2, $dlup_id3])
            ->get();

        // Last 3 months for domestic
        $dlupThreeMonthsDom = DB::connection('db_con_latest')
            ->table('dlup')
            ->whereIn('id_dlup', [$dlup_id, $dlup_id2, $dlup_id3])
            ->get();

        // Total international airports
        $total_aport_count = DB::connection('db_con_latest')
            ->table('latest_liveinput3')
            ->where('dlup', $dlup_id)
            ->count('jracode');

        // Last 6 months international data
        $sixMonthAirports = DB::connection('db_con_latest')
            ->table('latest_liveinput3')
            ->join('dlup', 'dlup.id_dlup', '=', 'latest_liveinput3.dlup')
            ->whereIn('dlup.id_dlup', [$dlup_id, $dlup_id2, $dlup_id3, $dlup_id4, $dlup_id5, $dlup_id6])
            ->whereIn('latest_liveinput3.dlup', [$dlup_id, $dlup_id2, $dlup_id3, $dlup_id4, $dlup_id5, $dlup_id6])
            ->orderBy('jracode')
            ->get();

        $totalnum_rows_sixaportname = $sixMonthAirports->count();

        // Total domestic airports
        $total_aport_count_dom = DB::connection('db_con_latest')
            ->table('latest_liveinput')
            ->where('dlup', $dlup_id)
            ->count('jracode');

        // Last 6 months domestic data
        $sixMonthAirportsDom = DB::connection('db_con_latest')
            ->table('latest_liveinput')
            ->join('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->whereIn('dlup.id_dlup', [$dlup_id, $dlup_id2, $dlup_id3, $dlup_id4, $dlup_id5, $dlup_id6])
            ->whereIn('latest_liveinput.dlup', [$dlup_id, $dlup_id2, $dlup_id3, $dlup_id4, $dlup_id5, $dlup_id6])
            ->orderBy('jracode')
            ->get();

        $totalnum_rows_sixaportname_dom = $sixMonthAirportsDom->count();

        return view('airports.airportsactuallatmonth', compact(
            'full_year',
            'full_month',
            'dlupThreeMonths',
            'dlupThreeMonthsDom',
            'total_aport_count',
            'total_aport_count_dom',
            'sixMonthAirports',
            'sixMonthAirportsDom',
            'totalnum_rows_sixaportname',
            'totalnum_rows_sixaportname_dom'
        ));
    }


    public function airportsActualsAirl()
    {
        return view('airports.airportsactualsairl');
    }

    public function airportsActualsAirlALPR()
    {
        return view('airports.airportsactualsairlALPR');
    }

    public function airportsActualsAirlALR()
    {
        return view('airports.airportsactualsairlALR');
    }

    public function airportsActualsAirlLP()
    {
        return view('airports.airportsactualsairlLP');
    }

    public function airportsActualsAirlLPR()
    {
        return view('airports.airportsactualsairlLPR');
    }

    public function airportsActualsAirlP()
    {
        return view('airports.airportsactualsairlP');
    }

    public function airportsActualsInt(Request $request)
    {

        if ($request->isMethod('post')) {
            $airport = $request->input('searchAPID');
            session()->put('sess_aport', $airport);
            session()->save();
        }
        if (session()->has('sess_aport')) {
            $airport = session('sess_aport');
        } else {
            $airport = 'AAL';
        }

        // Check if the 'csvdownload' query parameter is present and set to 'true'
        if ($request->has('csvdownload') && $request->input('csvdownload') == 'true') {
            $airport = $request->input('searchAPID', 'AAL');
            $csvData = CsvHelper::downloadLatestCsvInt($airport);
            return $csvData;
        }
        $stMonth = DB::connection('db_con_333')->table('latestnewmon')
            ->where('id', 1)
            ->value('newmon');
        $KTColParam1_rst_latest_aport = $airport;

        // dd(session('sess_aport'),$searchAPID);
        $rst_latest_aport = DB::connection('db_con_latest')->table('latest_liveinput3')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput3.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput3.dlup')
            ->select('latest_liveinput3.id', 'latest_apref.aport_apref', 'latest_liveinput3.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt', 'latest_liveinput3.paxchange', 'latest_liveinput3.pax', 'latest_liveinput3.dlup')
            ->where('latest_liveinput3.jracode', $KTColParam1_rst_latest_aport)
            ->first();

        // Query 1: $rst_latest_list
        $row_rst_latest_list = DB::connection('db_con_latest')->table('latest_liveinput3')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput3.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput3.dlup')
            ->select('latest_liveinput3.id', 'latest_apref.aport_apref', 'latest_liveinput3.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
            ->where('latest_liveinput3.dlup', $stMonth)
            ->orderBy('latest_apref.aport_apref', 'ASC')
            ->get();

        // Query 2: $rst_latest_list2
        $row_rst_latest_list2 =  DB::connection('db_con_latest')->table('latest_liveinput3')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput3.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput3.dlup')
            ->select('latest_liveinput3.id', 'latest_apref.aport_apref', 'latest_liveinput3.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
            ->where('latest_liveinput3.dlup', $stMonth - 1)
            ->orderBy('latest_apref.aport_apref', 'ASC')
            ->get();

        // Query 3: $rst_latest_list3
        $row_rst_latest_list3 = DB::connection('db_con_latest')->table('latest_liveinput3')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput3.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput3.dlup')
            ->select('latest_liveinput3.id', 'latest_apref.aport_apref', 'latest_liveinput3.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
            ->where('latest_liveinput3.dlup', '<=', $stMonth - 2)
            ->orderBy('latest_apref.aport_apref', 'ASC')
            ->get();

        // Query 4: $rst_latest_min
        $row_rst_latest_min = DB::connection('db_con_latest')->table('latest_liveinput3')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput3.dlup')
            ->select(DB::raw('MIN(latest_liveinput3.dlup) AS min_dlup_1'), 'dlup.dlup_fullmontxt', 'dlup.dlup_year')
            ->groupBy('dlup.dlup_fullmontxt', 'dlup.dlup_year')
            ->orderBy('min_dlup_1', 'ASC')
            ->get();

        // Query 5: $rst_latest_max
        $row_rst_latest_max = DB::connection('db_con_latest')->table('latest_liveinput3')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput3.dlup')
            ->select('dlup.dlup_fullmontxt', 'dlup.dlup_year', DB::raw('MAX(latest_liveinput3.dlup) AS max_dlup_1'))
            ->groupBy('dlup.dlup_fullmontxt', 'dlup.dlup_year')
            ->orderBy('max_dlup_1', 'DESC')
            ->get();

        // Query 6: $rst_monthdrop
        $row_rst_monthdrop = DB::connection('db_con_latest')->table('dlup')
            ->where('id_dlup', 397)
            ->get();

        // Query 7: $rst_aportdrop
        $rst_aportdrop = DB::connection('db_con_latest')->table('latest_liveinput3')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput3.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput3.dlup')
            ->select('latest_liveinput3.jracode', DB::raw("CONCAT(latest_apref.aport_apref, '; ', dlup.dlup_monthtxt) AS aportdate"))
            ->orderBy('latest_apref.aport_apref', 'ASC')
            ->get();

        // Query 8: $rst_latest_list_3head
        $row_rst_latest_list_3head = DB::connection('db_con_latest')->table('latest_liveinput')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
            ->where('latest_liveinput.dlup', $stMonth - 2)
            ->orderBy('latest_apref.aport_apref', 'ASC')
            ->get();

        // Get the values of KTColParam1_rst_latest12pax and KTColParam2_rst_latest12pax
        $jr_code = $airport;
        $last_date = 397;

        $rst_latest12pax = DB::connection('db_con_latest')
            ->table('latest_liveupdate')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')
            ->where('latest_liveupdate.jracode', $jr_code)
            ->where('latest_liveupdate.dlup', '<=', $last_date)
            ->where('latest_liveupdate.dlup', '>=', $last_date - 11)
            ->orderBy('latest_liveupdate.dlup', 'asc')
            ->select('dlup.dlup_year', 'dlup.dlup_monthtxt', 'latest_liveupdate.fc', 'latest_liveupdate.jracode', 'latest_liveupdate.dlup')
            ->get();

        $KTColParam1_rst_latest12 = $airport;
        $KTColParam2_rst_latest12 = 397;
        // Define the query
        $rst_latest12 = DB::connection('db_con_latest')
            ->table('latest_liveupdate')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')
            ->where('latest_liveupdate.jracode', $KTColParam1_rst_latest12)
            ->where('latest_liveupdate.dlup', '<=', $KTColParam2_rst_latest12)
            ->where('latest_liveupdate.dlup', '>=', $KTColParam2_rst_latest12 - 11)
            ->orderBy('latest_liveupdate.dlup', 'asc')
            ->select('dlup.dlup_year', 'dlup.dlup_monthtxt', 'latest_liveupdate.fc_change', 'latest_liveupdate.jracode', 'latest_liveupdate.dlup')
            ->get();
        // Execute the query

        $colname_rst_ytd = $airport;
        if (session()->has('sess_aport')) {
            $colname_rst_ytd = $airport;
        }

        $rst_ytd = DB::connection('db_con_latest')->table('latest_ytd')
            ->where('jracode', $colname_rst_ytd)
            ->first();

        $row_rst_ytd = $rst_ytd;

        $colname_rst_ytd = $airport;
        if (session()->has('sess_aport')) {
            $colname_rst_ytd = $airport;
        }

        $rst_ytd = DB::connection('db_con_latest')->table('latest_ytd')
            ->where('jracode', $colname_rst_ytd)
            ->first();

        $colname_rst_onsystem = $airport;

        // Query the database using the Query Builder
        $row_rst_onsystem  = DB::connection('db_con_latest')->table('latest_liveinput3')
            ->where('jracode', $colname_rst_onsystem)
            ->select('entdate')
            ->first();

        $colname_rst_websource = $airport;
        if (session()->has('sess_aport')) {
            $colname_rst_websource = $airport;
        }

        $row_rst_websource = DB::connection('db_con_latest')->table('liveupdate_websource')
            ->where('jracode', $colname_rst_websource)
            ->select('websource')
            ->first();
        $totalRows_rst_aportdrop = $rst_aportdrop->count();
        $latestIntPaxChange = $this->latestIntPaxChange($airport);
        $latestIntPaxNumber = $this->latestIntPaxNumber($airport);
        return view('airports.airportsactualsint', compact('rst_latest_aport', 'rst_aportdrop', 'row_rst_latest_list', 'row_rst_latest_list2', 'row_rst_latest_list3', 'totalRows_rst_aportdrop', 'row_rst_latest_list_3head', 'rst_latest12pax', 'rst_latest12', 'rst_ytd', 'row_rst_onsystem', 'row_rst_websource', 'latestIntPaxChange', 'latestIntPaxNumber'));
    }

    public function latestIntPaxChange($airport)
    {
        $jracode = session('sess_aport', 'AAL');
        $lastDate = session()->has('sess_lastdate') ? session('sess_lastdate') : 397;

        // Fetch data from the databases
        $results = DB::connection('db_con_latest')
            ->table('latest_liveupdate3')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate3.dlup')
            ->select(
                'dlup.dlup_year',
                'dlup.dlup_monthtxt',
                'latest_liveupdate3.fc_change',
                'latest_liveupdate3.jracode',
                'latest_liveupdate3.dlup'
            )
            ->where('latest_liveupdate3.jracode', $jracode)
            ->where('latest_liveupdate3.dlup', '<=', $lastDate)
            ->where('latest_liveupdate3.dlup', '>=', $lastDate - 11)
            ->orderBy('latest_liveupdate3.dlup', 'asc')
            ->get();

        // Prepare chart data
        $chartData = [];
        $color = '#deb780';

        foreach ($results as $row) {
            $chartData[] = [
                'country' => $row->dlup_monthtxt,
                'visits' => $row->fc_change,
                'color' => $color,
            ];
        }

        return $chartData;
    }

    public function latestIntPaxNumber($airport)
    {
        $jracode = session('sess_aport', 'AAL');
        $lastDlup = session()->has('sess_lastdate') ? session('sess_lastdate') : 397;
        // Fetch 12 months of data for the given airport and date
        $results = DB::connection('db_con_latest')
            ->table('latest_liveupdate3')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate3.dlup')
            ->select('dlup.dlup_year', 'dlup.dlup_monthtxt', 'latest_liveupdate3.fc', 'latest_liveupdate3.jracode', 'latest_liveupdate3.dlup')
            ->where('latest_liveupdate3.jracode', $jracode)
            ->whereBetween('latest_liveupdate3.dlup', [intval($lastDlup) - 11, intval($lastDlup)])
            ->orderBy('latest_liveupdate3.dlup', 'asc')
            ->get();

        $datay = [];
        $labelx = [];

        foreach ($results as $row) {
            $datay[] = round($row->fc);
            $labelx[] = $row->dlup_monthtxt;
        }

        $color = array_fill(0, 12, '#7c3d2c');
        $latest280am = [];

        foreach ($datay as $i => $value) {
            $latest280am[] = [
                'country' => $labelx[$i] ?? '',
                'visits' => $value,
                'color' => $color[$i] ?? '#7c3d2c',
            ];
        }

        return $latest280am;
    }

    public function airportsActualsIntLat()
    {
        return view('airports.airportsactualsint_lat');
    }

    public function getLatestData($airport)
    {
        // Get the necessary session variables
        $colname_rst_latest12 = $airport;
        $lastDate = session()->has('sess_lastdate') ? session('sess_lastdate') : 397;

        // Join the tables and run the query with conditions
        $results = DB::connection('db_con_latest')
            ->table('latest_liveupdate')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')  // LEFT JOIN between latest_liveupdate and dlup
            ->where('latest_liveupdate.jracode', $colname_rst_latest12)  // Filter by jracode from session
            ->where('latest_liveupdate.dlup', '<=', $lastDate)  // Filter by the latest date condition
            ->where('latest_liveupdate.dlup', '>=', $lastDate - 11)  // Filter for the previous 11 months
            ->select('dlup.dlup_monthtxt', 'latest_liveupdate.fc_change', 'latest_liveupdate.dlup')  // Select the relevant columns
            ->orderBy('latest_liveupdate.dlup', 'ASC')  // Order by dlup
            ->get();

        $datay = [];
        $labelx = [];
        $color = array_fill(0, 22, '#deb780');  // Default color for each data point

        // Loop through the query results and populate the arrays
        foreach ($results as $row) {
            $datay[] = $row->fc_change;  // Push 'fc_change' values
            $labelx[] = $row->dlup_monthtxt;  // Push 'dlup_monthtxt' values
        }

        // Now create the final array (latest_ap_array) with country, visits, and color
        $latest_ap_array = [];
        for ($i = 0; $i < count($datay); $i++) {
            $latest_ap_array[] = [
                'country' => $labelx[$i],
                'visits' => $datay[$i],
                'color' => $color[$i % count($color)]  // Use color cyclically if there are more than 22 data points
            ];
        }

        return $latest_ap_array;  // Return the processed array
    }

    public function getAirportDataForGraph($airport)
    {
        // Default to 0 if session values are not available
        $KTColParam1_rst_latest12 = $lastDate ?? 397;
        $KTColParam2_rst_latest12 = $airport;

        // Perform the database query using Laravel's query builder
        $results = DB::connection('db_con_latest')
            ->table('latest_liveupdate')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')
            ->where('latest_liveupdate.jracode', '=', $KTColParam2_rst_latest12)
            ->where('latest_liveupdate.dlup', '<=', $KTColParam1_rst_latest12)
            ->where('latest_liveupdate.dlup', '>=', $KTColParam1_rst_latest12 - 11)
            ->select('dlup.dlup_year', 'dlup.dlup_monthtxt', 'latest_liveupdate.fc', 'latest_liveupdate.dlup')
            ->orderBy('latest_liveupdate.dlup', 'asc')
            ->get();

        // Process the data for the graph
        $datay = [];
        $labelx = [];
        foreach ($results as $row) {
            $datay[] = $row->fc;  // Store fc value in datay array
            $labelx[] = $row->dlup_monthtxt;  // Store month text in labelx array
        }

        // Define color array (same color for all items)
        $color = array_fill(0, count($datay), '#7c3d2c');

        // Prepare the final data array for the graph
        $latest_apann280_arr = [];
        foreach ($datay as $index => $value) {
            $latest_apann280_arr[] = [
                'country' => $labelx[$index],
                'visits' => round($value),  // Round off the visits value
                'color' => $color[$index],  // Assign the color
            ];
        }

        return $latest_apann280_arr;  // Return the data for the graph
    }

    private function getLatestApGraphData($airport)
    {
        $lastdate = $lastDate ?? 397;
        $aport = $airport;
        return DB::connection('db_con_latest')
            ->table('latest_liveupdate')
            ->join('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')
            ->where('latest_liveupdate.jracode', $aport)
            ->where('latest_liveupdate.dlup', '<=', $lastdate)
            ->where('latest_liveupdate.dlup', '>=', $lastdate - 23)
            ->orderBy('latest_liveupdate.dlup', 'asc')
            ->select('dlup.dlup_year', 'dlup.dlup_monthtxt', 'latest_liveupdate.fc_change', 'latest_liveupdate.jracode', 'latest_liveupdate.dlup', 'latest_liveupdate.fc')
            ->get();
    }

    /**
     * Fetch the trend data.
     */
    private function getTrendData($airport)
    {
        $lastdate = $lastDate ?? 397;
        $aport = $airport;
        return DB::connection('db_con_409')
            ->table('xa_mon')
            ->join('dlup', 'dlup.id_dlup', '=', 'xa_mon.dlup')
            ->join('apref', 'apref.apid_apref', '=', 'xa_mon.ap_id')
            ->where('apref.code_apref', $aport)
            ->where('xa_mon.dlup', '<=', $lastdate)
            ->where('xa_mon.dlup', '>=', $lastdate - 23)
            ->orderBy('xa_mon.dlup', 'asc')
            ->select('dlup.dlup_monthtxt', 'xa_mon.fc5 as fctrend', 'xa_mon.fc5_change')
            ->get();
    }

    /**
     * Fetch the minimum and maximum values.
     */
    private function getMinMaxData($airport)
    {
        $aport = $airport;
        $minact = DB::connection('db_con_latest')
            ->table('latest_liveupdate')
            ->where('latest_liveupdate.jracode', $aport)
            ->min('latest_liveupdate.fc');

        $maxact = DB::connection('db_con_latest')
            ->table('latest_liveupdate')
            ->where('latest_liveupdate.jracode', $aport)
            ->max('latest_liveupdate.fc');

        return [
            'min' => $minact,
            'max' => $maxact
        ];
    }

    /**
     * Prepare chart data.
     */
    private function prepareChartData($latestApGraphData, $trendData)
    {
        // Extract data from the query results
        $datay = $latestApGraphData->pluck('fc')->toArray();
        $labelx = $latestApGraphData->pluck('dlup_monthtxt')->toArray();
        $Zdatay = $trendData->pluck('fctrend')->toArray();

        // Prepare a color array (same color for each bar)
        $color = array_fill(0, count($datay), '#4c6daa');

        // Prepare final data structure for chart
        $latest_apgraphline_arr = [];
        foreach ($datay as $index => $value) {
            $latest_apgraphline_arr[] = [
                'country' => $labelx[$index],
                'visits' => $value,
                'color' => $color[$index]
            ];
        }

        return $latest_apgraphline_arr;
    }


    public function airportsActualsTot(Request $request)
    {

        if ($request->isMethod('post')) {
            $airport = $request->input('searchAPID');
            session()->put('sess_aport', $airport);
            session()->save();
        }
        if (session()->has('sess_aport')) {
            $airport = session('sess_aport');
        } else {
            $airport = 'AAL';
        }

        // Check if the 'csvdownload' query parameter is present and set to 'true'
        if ($request->has('csvdownload') && $request->input('csvdownload') == 'true') {
            $airport = $request->input('searchAPID', 'AAL');
            $csvData = CsvHelper::generateAirportActualsCSVData($airport);
            return $csvData;
        }
        $stMonth = DB::connection('db_con_333')->table('latestnewmon')
            ->where('id', 1)
            ->value('newmon');
        $KTColParam1_rst_latest_aport = $airport;

        // dd(session('sess_aport'),$searchAPID);
        $rst_latest_aport = DB::connection('db_con_latest')->table('latest_liveinput')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt', 'latest_liveinput.paxchange', 'latest_liveinput.pax', 'latest_liveinput.dlup')
            ->where('latest_liveinput.jracode', $KTColParam1_rst_latest_aport)
            ->first();

        // Query 1: $rst_latest_list
        $row_rst_latest_list = DB::connection('db_con_latest')->table('latest_liveinput')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
            ->where('latest_liveinput.dlup', $stMonth)
            ->orderBy('latest_apref.aport_apref', 'ASC')
            ->get();

        // Query 2: $rst_latest_list2
        $row_rst_latest_list2 =  DB::connection('db_con_latest')->table('latest_liveinput')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
            ->where('latest_liveinput.dlup', $stMonth - 1)
            ->orderBy('latest_apref.aport_apref', 'ASC')
            ->get();

        // Query 3: $rst_latest_list3
        $row_rst_latest_list3 = DB::connection('db_con_latest')->table('latest_liveinput')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
            ->where('latest_liveinput.dlup', '<=', $stMonth - 2)
            ->orderBy('latest_apref.aport_apref', 'ASC')
            ->get();

        // Query 4: $rst_latest_min
        $row_rst_latest_min = DB::connection('db_con_latest')->table('latest_liveinput')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->select(DB::raw('MIN(latest_liveinput.dlup) AS min_dlup_1'), 'dlup.dlup_fullmontxt', 'dlup.dlup_year')
            ->groupBy('dlup.dlup_fullmontxt', 'dlup.dlup_year')
            ->orderBy('min_dlup_1', 'ASC')
            ->get();

        // Query 5: $rst_latest_max
        $row_rst_latest_max = DB::connection('db_con_latest')->table('latest_liveinput')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->select('dlup.dlup_fullmontxt', 'dlup.dlup_year', DB::raw('MAX(latest_liveinput.dlup) AS max_dlup_1'))
            ->groupBy('dlup.dlup_fullmontxt', 'dlup.dlup_year')
            ->orderBy('max_dlup_1', 'DESC')
            ->get();

        // Query 6: $rst_monthdrop
        $row_rst_monthdrop = DB::connection('db_con_latest')->table('dlup')
            ->where('id_dlup', 397)
            ->get();

        // Query 7: $rst_aportdrop
        $rst_aportdrop = DB::connection('db_con_latest')->table('latest_liveinput')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->select('latest_liveinput.jracode', DB::raw("CONCAT(latest_apref.aport_apref, '; ', dlup.dlup_monthtxt) AS aportdate"))
            ->orderBy('latest_apref.aport_apref', 'ASC')
            ->get();

        // Query 8: $rst_latest_list_3head
        $row_rst_latest_list_3head = DB::connection('db_con_latest')->table('latest_liveinput')
            ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
            ->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
            ->where('latest_liveinput.dlup', $stMonth - 2)
            ->orderBy('latest_apref.aport_apref', 'ASC')
            ->get();

        // Get the values of KTColParam1_rst_latest12pax and KTColParam2_rst_latest12pax
        $jr_code = $airport;
        $last_date = 397;

        $rst_latest12pax = DB::connection('db_con_latest')
            ->table('latest_liveupdate')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')
            ->where('latest_liveupdate.jracode', $jr_code)
            ->where('latest_liveupdate.dlup', '<=', $last_date)
            ->where('latest_liveupdate.dlup', '>=', $last_date - 11)
            ->orderBy('latest_liveupdate.dlup', 'asc')
            ->select('dlup.dlup_year', 'dlup.dlup_monthtxt', 'latest_liveupdate.fc', 'latest_liveupdate.jracode', 'latest_liveupdate.dlup')
            ->get();




        $KTColParam1_rst_latest12 = $airport;
        $KTColParam2_rst_latest12 = 397;
        // Define the query
        $rst_latest12 = DB::connection('db_con_latest')
            ->table('latest_liveupdate')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')
            ->where('latest_liveupdate.jracode', $KTColParam1_rst_latest12)
            ->where('latest_liveupdate.dlup', '<=', $KTColParam2_rst_latest12)
            ->where('latest_liveupdate.dlup', '>=', $KTColParam2_rst_latest12 - 11)
            ->orderBy('latest_liveupdate.dlup', 'asc')
            ->select('dlup.dlup_year', 'dlup.dlup_monthtxt', 'latest_liveupdate.fc_change', 'latest_liveupdate.jracode', 'latest_liveupdate.dlup')
            ->get();
        // Execute the query

        $colname_rst_ytd = $airport;
        if (session()->has('sess_aport')) {
            $colname_rst_ytd = $airport;
        }

        $rst_ytd = DB::connection('db_con_latest')->table('latest_ytd')
            ->where('jracode', $colname_rst_ytd)
            ->first();

        $row_rst_ytd = $rst_ytd;

        $colname_rst_ytd = $airport;
        if (session()->has('sess_aport')) {
            $colname_rst_ytd = $airport;
        }

        $rst_ytd = DB::connection('db_con_latest')->table('latest_ytd')
            ->where('jracode', $colname_rst_ytd)
            ->first();

        $colname_rst_onsystem = $airport;

        // Query the database using the Query Builder
        $row_rst_onsystem  = DB::connection('db_con_latest')->table('latest_liveinput')
            ->where('jracode', $colname_rst_onsystem)
            ->select('entdate')
            ->first();

        $colname_rst_websource = $airport;
        if (session()->has('sess_aport')) {
            $colname_rst_websource = $airport;
        }

        $row_rst_websource = DB::connection('db_con_latest')->table('liveupdate_websource')
            ->where('jracode', $colname_rst_websource)
            ->select('websource')
            ->first();
        $totalRows_rst_aportdrop = $rst_aportdrop->count();
        $latest_ap_array = $this->getLatestData($airport);
        $latest_apann280_arr = $this->getAirportDataForGraph($airport);
        $latestApGraphData = $this->getLatestApGraphData($airport);
        $trendData = $this->getTrendData($airport);
        $minMaxData = $this->getMinMaxData($airport);
        $latest_apgraphline_arr = $this->prepareChartData($latestApGraphData, $trendData);
        return view('airports.airportsActualsTot', compact('rst_latest_aport', 'rst_aportdrop', 'row_rst_latest_list', 'row_rst_latest_list2', 'row_rst_latest_list3', 'totalRows_rst_aportdrop', 'row_rst_latest_list_3head', 'rst_latest12pax', 'rst_latest12', 'rst_ytd', 'row_rst_onsystem', 'row_rst_websource', 'latest_ap_array', 'latest_apann280_arr', 'latestApGraphData', 'trendData', 'minMaxData', 'latest_apgraphline_arr'));
    }

    public function airportsActualsTotLat()
    {
        return view('airports.airportsactualstot_lat');
    }

    public function airportsForecasts()
    {
        $conn = DB::connection('db_con_409');
        $currentYear = date('Y');

        // Get base data from StartMonthHelper
        $refs = StartMonthHelper::getReferences();
        $cY = $currentYear; // Alias to match Blade

        // Years
        $years = $conn->select("SELECT DISTINCT year_fcm FROM xc_ann WHERE year_fcm >= ? LIMIT 15", [$cY]);
        $year_count = count($years);

        // Regions
        $regions = $conn->select("SELECT * FROM lupregion ORDER BY regionname ASC");

        // Countries
        $countries = $conn->select("SELECT * FROM lupcountry ORDER BY countryname ASC");

        // Cities
        $cities = $conn->select("SELECT * FROM lupcity ORDER BY cityname ASC");

        // Airports
        $airports = $conn->select("SELECT * FROM lupap");

        // IATA Codes and APRefs
        $iata_codes = $conn->select("SELECT * FROM apref ORDER BY code_apref ASC");
        $aprefs = $conn->select("SELECT * FROM apref ORDER BY aport_apref ASC");

        // Multi-city
        $multicities = $conn->select("SELECT * FROM m_city ORDER BY cityname ASC");

        // Merge and pass all to the Blade view
        return view('airports.airportsforecasts', array_merge($refs, [
            'cY' => $cY,
            'year_count' => $year_count,
            'years' => $years,
            'regions' => $regions,
            'countries' => $countries,
            'cities' => $cities,
            'airports' => $airports,
            'iata_codes' => $iata_codes,
            'aprefs' => $aprefs,
            'multicities' => $multicities,
        ]));
    }

    private function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
    {
        $theValue = addslashes($theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }

    public function airportsForecastsAirp(Request $request)
    {

        // Set session values first
        session([
            'yearselect' => $request->input('foo', "0"),
            'sess_idap' => $request->input('searchField_selap', "0"),
            'sess_monref' => $request->input('sess_monref', "0")
        ]);

        // Get session values or use request data if available
        $yearcolumn = session('yearselect', "0");
        $array = explode(",", $yearcolumn);
        $clength = count($array);

        if ($clength > 1) {
            $start1 = $array[0];
            $startmonthyear = $start1;
            $end = $array[$clength - 1];
            $endofyear = $end;
            $end = " - " . $end;
        } else {
            $start1 = $array[0];
            $startmonthyear = $start1;
            if ($start1 > 2020) {
                $startmonthyear = 2016;
            }
            $end = "";
            $endofyear = $start1;
        }

        if ($endofyear > 2020 || $start1 > 2020) {
            $startmonthyear = 2016;
            $monthlastyear = 2020;
        } else {
            $monthlastyear = $endofyear;
        }

        $selector = $request->input('sel', "Annual");

        $KTColParam1_rst_apmon = session('sess_monref', "0");
        $KTColParam2_rst_apmon = $request->input('searchField_selap', "0");

        $db = DB::connection('db_con_409');

        // Get forecast data
        $query = sprintf(
            "SELECT dlup.dlup_year AS Year, dlup.dlup_monthtxt AS Month, xa_mon.fc3 AS International, xa_mon.fc4 AS Domestic, xa_mon.fc5 AS Total 
            FROM (dlup LEFT JOIN xa_mon ON xa_mon.dlup=dlup.id_dlup) 
            WHERE dlup.dlup_year IN ($yearcolumn) 
            AND dlup.id_dlup >= %s 
            AND xa_mon.fc_ident = 1 
            AND xa_mon.ap_id = %s 
            ORDER BY xa_mon.dlup ASC",
            $this->GetSQLValueString(($KTColParam1_rst_apmon - 1), ""),
            $this->GetSQLValueString($KTColParam2_rst_apmon, "")
        );
        $rstApmon = $db->select($query);

        // Monthly change data
        $KTColParam1_rst_apmonchange = session('sess_monref', "0");
        $KTColParam2_rst_apmonchange = $request->input('searchField_selap', "0");

        $query = sprintf(
            "SELECT dlup.dlup_year AS Year, dlup.dlup_monthtxt AS Month, xa_mon.fc3_change AS International, xa_mon.fc4_change AS Domestic, xa_mon.fc5_change AS Total 
            FROM (dlup LEFT JOIN xa_mon ON xa_mon.dlup=dlup.id_dlup) 
            WHERE dlup.dlup_year IN ($yearcolumn) 
            AND dlup.id_dlup >= %s 
            AND xa_mon.fc_ident = 1 
            AND xa_mon.ap_id = %s 
            ORDER BY xa_mon.dlup ASC",
            $this->GetSQLValueString(($KTColParam1_rst_apmonchange - 1), "int"),
            $this->GetSQLValueString($KTColParam2_rst_apmonchange, "int")
        );
        $rstApmonchange = $db->select($query);

        $MMcolname_rst_apref = session('sess_idap', "0");

        $query = sprintf("SELECT * FROM apref WHERE apid_apref = %s", $MMcolname_rst_apref);
        $rstApref = $db->select($query);
        $rstApref = $rstApref[0] ?? null; // take the first record

        $query = "SELECT mhead_thisfc, mhead_lastfc, mhead_lateacts FROM mail_head WHERE mhead_id = 1";
        $rstMailHead = $db->select($query);
        $rstMailHead = $rstMailHead[0] ?? null;

        // Get the last date information
        $KTColParam1_rst_lastdate = session('sess_idap', "0");
        $query = sprintf(
            "SELECT dlup.dlup_fullmontxt, dlup.dlup_year 
            FROM (xf_lastdate LEFT JOIN dlup ON dlup.id_dlup=xf_lastdate.lastdate) 
            WHERE xf_lastdate.id_lastdate = %s",
            $KTColParam1_rst_lastdate
        );
        $rstLastDate = $db->select($query);

        // Annual summary data
        $KTColParam1_rst_annsum = session('sess_idap', "0");
        $query = sprintf(
            "SELECT xc_ann.year_fcm AS Year, xc_ann.fc3 AS International, xc_ann.fc4 AS Domestic, xc_ann.fc5 AS Total 
            FROM xc_ann 
            WHERE xc_ann.year_fcm IN ($yearcolumn) 
            AND xc_ann.ap_id = %s 
            ORDER BY xc_ann.year_fcm ASC",
            $this->GetSQLValueString($KTColParam1_rst_annsum, "int")
        );
        $rstAnnSum = $db->select($query);

        // Annual change data
        $KTColParam1_rst_annsumchange = session('sess_idap', "0");
        $query = sprintf(
            "SELECT xc_ann.year_fcm AS Year, xc_ann.fc3_change AS International, xc_ann.fc4_change AS Domestic, xc_ann.fc5_change AS Total 
            FROM xc_ann 
            WHERE xc_ann.year_fcm IN ($yearcolumn) 
            AND xc_ann.ap_id = %s 
            ORDER BY xc_ann.year_fcm ASC",
            $this->GetSQLValueString($KTColParam1_rst_annsumchange, "int")
        );
        $rstAnnSumChange = $db->select($query);

        // Fetch new AP reference data
        $query = "SELECT code_apref, apid_apref FROM apref ORDER BY code_apref ASC";
        $rstAprefNew = $db->select($query);

        // Fetch the AP tick data
        $colname_rst_aptick = session('sess_idap', "-1");
        $query = sprintf(
            "SELECT fc3_txt, fc4_txt, fc5_txt, fc3_tag, fc4_tag, fc5_tag 
            FROM aptick 
            WHERE id_ap = %s",
            $colname_rst_aptick
        );
        $rstApTick = $db->select($query);

        $latest_ap_int_arr = $this->getForecastData();

        $passengerchange_chart = $this->getForecastDataChange();
        $rollingchange_passenger = $this->getRollingChangeData();
        $rolling_passenger = $this->getPassengerRollingChange();


        // Return the view with the necessary data
        return view('airports.airportsforecastsairp', compact(
            'rstApmon',
            'rstApmonchange',
            'rstApref',
            'rstMailHead',
            'rstLastDate',
            'rstAnnSum',
            'rstAnnSumChange',
            'rstAprefNew',
            'rstApTick',
            'start1',
            'startmonthyear',
            'end',
            'endofyear',
            'monthlastyear',
            'selector',
            'latest_ap_int_arr',
            'passengerchange_chart',
            'rollingchange_passenger',
            'rolling_passenger'
        ));
    }

    private function getForecastData()
    {
        // Get the year and airport ID from session
        $yearcolumn = session('yearselect');
        $KTColParam1_rst_sumgraph = session('sess_idap', '0'); // Default to 0 if not set

        // Query to fetch forecast data
        $query = DB::connection('db_con_409')->table('xc_ann')
            ->select('xc_ann.year_fcm AS Year', 'xc_ann.fc3 AS International', 'xc_ann.fc4 AS Domestic', 'xc_ann.fc5 AS Total')
            ->whereIn('xc_ann.year_fcm', explode(',', $yearcolumn))
            ->where('xc_ann.ap_id', $KTColParam1_rst_sumgraph)
            ->orderBy('xc_ann.year_fcm', 'ASC')
            ->get();

        // Prepare the data for the chart
        $datay = [];
        $labelx = [];
        foreach ($query as $row) {
            $datay[] = $row->Total;
            $labelx[] = $row->Year;
        }

        // Prepare the array for AmCharts
        $latest_ap_int_arr = [];
        $color = array_fill(0, 12, '#858fae'); // Default color for each data point

        foreach ($datay as $index => $value) {
            $latest_ap_int_arr[] = [
                'country' => $labelx[$index],
                'visits' => $value,
                'color' => $color,
            ];
        }

        // Return the forecast data (to be used in the chart)
        return $latest_ap_int_arr;
    }

    private function getForecastDataChange()
    {
        $yearcolumn = session('yearselect'); // Or use request()->session()->get('yearselect')
        $ap_id = session('sess_idap'); // Or use request()->session()->get('sess_idap')

        // Prepare the SQL query
        $query = DB::connection('db_con_409')->table('xc_ann')
            ->select('year_fcm as Year', 'fc3_change as International', 'fc4_change as Domestic', 'fc5_change as Total')
            ->whereIn('year_fcm', explode(',', $yearcolumn))
            ->where('ap_id', $ap_id)
            ->orderBy('year_fcm')
            ->get();

        // Prepare the chart data
        $datay = [];
        $labelx = [];
        foreach ($query as $row) {
            $datay[] = $row->Total;
            $labelx[] = $row->Year;
        }

        // Prepare the color array (This can be dynamic, adjusted as needed)
        $color = array_fill(0, count($datay), '#858fae');

        $passengerchange_chart = [];
        foreach ($datay as $index => $value) {
            $passengerchange_chart[] = [
                'country' => $labelx[$index],
                'visits' => $value,
                'color' => $color[$index]
            ];
        }

        return $passengerchange_chart;
    }
    private function getRollingChangeData()
    {
        $yearcolumn = session('yearselect');
        $ap_id = session('sess_idap');
        $monref = session('sess_monref', 0); // Default to 0 if not set

        // Prepare the SQL query
        $query = DB::connection('db_con_409')->table('dlup')
            ->select('dlup.dlup_year as Year', 'dlup.dlup_monthtxt as Month', 'xa_mon.fc3_change as International', 'xa_mon.fc4_change as Domestic', 'xa_mon.fc5_change as Total')
            ->leftJoin('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
            ->whereIn('dlup.dlup_year', explode(',', $yearcolumn))
            ->where('xa_mon.fc_ident', 1)
            ->where('xa_mon.ap_id', $ap_id)
            ->where('dlup.id_dlup', '>=', $monref - 1)
            ->orderBy('xa_mon.dlup', 'asc')
            ->get();

        // Prepare the chart data
        $datay = [];
        $labelx = [];
        foreach ($query as $row) {
            $datay[] = $row->Total;
            $labelx[] = $row->Month;
        }

        // Color array (if needed, can be dynamic or random)
        $color = array_fill(0, count($datay), '#858fae');

        // Prepare the final chart data
        $rollingchange_passenger = [];
        foreach ($datay as $index => $value) {
            $rollingchange_passenger[] = [
                'country' => $labelx[$index],
                'visits' => $value,
                'color' => $color[$index],
            ];
        }

        return $rollingchange_passenger;
    }
    private function getPassengerRollingChange()
    {
        // Get the selected year from session (or use a default if not available)
        $yearcolumn = session('yearselect', 'default_year_value'); // Change this if the session key is different
        $gryear = session('dlup_year') + 1;

        $KTColParam1_rst_apmon = session('sess_monref', 0); // Default to 0 if not set
        $KTColParam2_rst_apmon = session('sess_idap', 0); // Default to 0 if not set

        // Perform the database query
        $data = DB::connection('db_con_409')->table('dlup')
            ->join('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
            ->where('dlup.dlup_year', '=', $yearcolumn)
            ->where('xa_mon.fc_ident', '=', 1)
            ->where('xa_mon.ap_id', '=', $KTColParam2_rst_apmon)
            ->select('dlup.dlup_year as Year', 'dlup.dlup_monthtxt as Month', 'xa_mon.fc3 as International', 'xa_mon.fc4 as Domestic', 'xa_mon.fc5 as Total')
            ->orderBy('xa_mon.dlup', 'asc')
            ->get();

        // Prepare the data for the chart
        $datay = [];
        $labelx = [];

        foreach ($data as $row) {
            $datay[] = $row->Total;
            $labelx[] = $row->Month;
        }

        // Prepare the chart data array
        $rolling_passenger = [];
        $color = ['#858fae']; // Set the default color for all columns

        foreach ($datay as $index => $total) {
            $rolling_passenger[] = [
                'country' => $labelx[$index],
                'visits' => $total,
                'color' => $color[0], // Set the color dynamically if needed
            ];
        }

        // Return the rolling_passenger array directly
        return $rolling_passenger;
    }

    public function airportsForecastsAirpdl()
    {
        return view('airports.airportsforecastsairpdl');
    }

    public function airportsForecastsCity(Request $request)
    { {
            // Validate incoming request
            // Validate the input
            $request->validate([
                'foo3' => 'required|string',
                'sel1' => 'nullable|string',
                'searchField_selap' => 'nullable|string',
            ]);

            // Store into session
            Session::put('foo3', $request->input('foo3'));
            Session::put('sel1', $request->input('sel1'));
            Session::put('searchField_selcity', $request->input('searchField_selcity'));
            Session::put('searchField_selap', $request->input('searchField_selap'));

            // Parse years
            $yearColumn = $request->input('foo3', '0');
            $yearArray = explode(",", $yearColumn);
            $array = explode(',', $request->input('foo3'));

            // Step 2: Initialize variables
            $clength = count($array);
            $start1 = '';
            $startmonthyear = ''; // Correct variable name here
            $end = ''; // Initialize as empty to avoid undefined variable error
            $endofyear = ''; // Initialize as empty to avoid undefined variable error
            $monthlastyear = '';

            // Step 3: Process the years
            if ($clength > 1) {
                $start1 = $array[0];
                $startmonthyear = $start1;
                $end = $array[$clength - 1];
                $endofyear = $end; // Set $endofyear if multiple years are present
            } else {
                $start1 = $array[0];
                $startmonthyear = $start1;
                if ($start1 > 2020) {
                    $startmonthyear = 2016;
                }
                $endofyear = $start1; // Set $endofyear to $start1 if only one year is present
            }

            // Step 4: Handle year range logic
            if (($endofyear && $endofyear > 2020) || $start1 > 2020) {
                $startmonthyear = 2016;
                $monthlastyear = 2020;
            } else {
                $monthlastyear = $endofyear;
            }

            // Save year selection in session
            Session::put('yearselect', $yearColumn);

            // Session values
            $sessMonref = Session::get('sess_monref', 0);
            $searchFieldSelap = $request->input('searchField_selap', 0);

            // Start Queries (using db_con_33 connection)
            // Using Query Builder to interact with the database
            $db = DB::connection('db_con_409');

            // Monthly Forecasts
            $monthlyForecasts = $db->table('dlup')
                ->join('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
                ->whereIn('dlup.dlup_year', $array)
                ->where('dlup.id_dlup', '>=', $sessMonref)
                ->where('xa_mon.fc_ident', 1)
                ->where('xa_mon.ap_id', $searchFieldSelap)
                ->orderBy('xa_mon.dlup')
                ->select(
                    'dlup.dlup_year as Year',
                    'dlup.dlup_monthtxt as Month',
                    'xa_mon.fc3 as International',
                    'xa_mon.fc4 as Domestic',
                    'xa_mon.fc5 as Total'
                )
                ->get();

            // Monthly Forecast Changes
            $monthlyForecastChanges = $db->table('dlup')
                ->join('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
                ->whereIn('dlup.dlup_year', $array)
                ->where('dlup.id_dlup', '>=', $sessMonref)
                ->where('xa_mon.fc_ident', 1)
                ->where('xa_mon.ap_id', $searchFieldSelap)
                ->orderBy('xa_mon.dlup')
                ->select(
                    'dlup.dlup_year as Year',
                    'dlup.dlup_monthtxt as Month',
                    'xa_mon.fc3_change as International',
                    'xa_mon.fc4_change as Domestic',
                    'xa_mon.fc5_change as Total'
                )
                ->get();

            // Mail Head
            $mailHead = $db->table('mail_head')->where('mhead_id', 1)->first();

            // Last Date Info
            $sessIdap = Session::get('sess_idap', 0);
            $lastDateInfo = $db->table('xf_lastdate')
                ->join('dlup', 'dlup.id_dlup', '=', 'xf_lastdate.lastdate')
                ->where('xf_lastdate.id_lastdate', $sessIdap)
                ->select('dlup.dlup_fullmontxt', 'dlup.dlup_year')
                ->first();

            // Annual Summary
            $annualSummary = $db->table('xc_ann')
                ->whereIn('year_fcm', $array)
                ->where('ap_id', $sessIdap)
                ->orderBy('year_fcm')
                ->select('year_fcm as Year', 'fc3 as International', 'fc4 as Domestic', 'fc5 as Total')
                ->get();

            // Annual Summary Changes
            $annualSummaryChanges = $db->table('xc_ann')
                ->whereIn('year_fcm', $array)
                ->where('ap_id', $sessIdap)
                ->orderBy('year_fcm')
                ->select('year_fcm as Year', 'fc3 as International', 'fc4 as Domestic', 'fc5 as Total')
                ->get();
            // Airport References
            $airportReferences = $db->table('apref')
                ->orderBy('code_apref', 'asc')
                ->get();

            // Outof Info
            $outof = $db->table('outof')
                ->where('ap_id', $sessIdap)
                ->first();

            // City Summary
            $sessCity = Session::get('searchField_selcity', 0);
            $citySummary = [];
            if ($sessCity) {
                $citySummary = $db->table('apref')
                    ->join('xc_ann', 'xc_ann.ap_id', '=', 'apref.apid_apref')
                    ->where('apref.cityid_apref', $sessCity)
                    ->whereIn('xc_ann.year_fcm', $array)
                    ->select('apref.aport_apref', 'apref.code_apref', 'xc_ann.fc5', 'apref.city_apref')
                    ->get();
            }

            $rollingmothly_chart = $this->airportcityrollingmothly_forcastgraph();
            $rollingchange_chart = $this->airportCityRollingChangeForecastGraph();
            $citychangepassenger_chart = $this->cityChangePassengerForecastGraph();
            $citypassenger_chart = $this->airportCityPassengerChart();



            return view('airports.airportsforecastscity', [
                'start1' => $start1,
                'end' => $end,
                'monthlyForecasts' => $monthlyForecasts,
                'monthlyForecastChanges' => $monthlyForecastChanges,
                'mailHead' => $mailHead,
                'lastDateInfo' => $lastDateInfo,
                'annualSummary' => $annualSummary,
                'annualSummaryChanges' => $annualSummaryChanges,
                'airportReferences' => $airportReferences,
                'outof' => $outof,
                'citySummary' => $citySummary,
                'yearArray' => $yearArray,
                'startmonthyear' => $startmonthyear,
                'monthlastyear' => $monthlastyear,
                'rollingmothly_chart' => $rollingmothly_chart,
                'rollingchange_chart' => $rollingchange_chart,
                'citychangepassenger_chart' => $citychangepassenger_chart,
                'citypassenger_chart' => $citypassenger_chart
            ]);
        }
    }

    private function airportCityPassengerChart()
    {
        $yearcolumn = session('yearselect');
        $sessCity = session('searchField_selcity');

        if (!$yearcolumn || !$sessCity) {
            abort(400, 'Missing session data');
        }

        $years = explode(',', $yearcolumn);

        $data = DB::connection('db_con_409')
            ->table('xc_ann')
            ->select('year_fcm', DB::raw('fc5 / 1000 as fc5'))
            ->where('city_id', $sessCity)
            ->whereIn('year_fcm', $years)
            ->orderBy('year_fcm')
            ->get();

        $chartData = [];
        foreach ($data as $row) {
            $chartData[] = [
                'country' => $row->year_fcm,
                'visits' => $row->fc5,
                'color' => '#858fae'
            ];
        }

        return $chartData;
    }

    private function cityChangePassengerForecastGraph()
    {
        $conn = DB::connection('db_con_409');

        $yearcolumn = session('yearselect');
        $cityId = session('searchField_selcity') ?? 0;

        $results = $conn->table('xc_ann')
            ->select('year_fcm', 'fc5_change as fc5')
            ->whereIn('year_fcm', explode(',', $yearcolumn))
            ->where('city_id', $cityId)
            ->orderBy('year_fcm', 'asc')
            ->get();

        $chartData = [];
        $color = '#858fae';

        foreach ($results as $row) {
            $chartData[] = [
                'country' => $row->year_fcm,
                'visits' => $row->fc5,
                'color' => $color
            ];
        }

        return $chartData;
    }

    private function airportCityRollingChangeForecastGraph()
    {
        $conn = DB::connection('db_con_409');

        $yearcolumn = session('yearselect');
        $graphmon = session('sess_monref');
        $cityId = session('searchField_selcity');

        // Fetch the year (from dlup table)
        $yearRow = $conn->table('dlup')->where('id_dlup', $graphmon)->first();

        // Fetch chart data
        $result = $conn->table('dlup')
            ->leftJoin('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
            ->select(
                'dlup.dlup_year as Year',
                'dlup.dlup_monthtxt as Month',
                'xa_mon.fc5_change as Total'
            )
            ->whereIn('dlup.dlup_year', explode(',', $yearcolumn))
            ->where('dlup.id_dlup', '>=', $graphmon - 1)
            ->where('xa_mon.city_id', $cityId)
            ->orderBy('dlup.dlup_year')
            ->orderBy('dlup.dlup_month')
            ->get();

        $data = [];
        $color = '#858fae';
        foreach ($result as $row) {
            $data[] = [
                'country' => $row->Month,
                'visits' => $row->Total,
                'color' => $color,
            ];
        }
        return $data;
    }
    private function airportcityrollingmothly_forcastgraph()
    {
        $yearcolumn = session('yearselect');
        $sess_monref = session('sess_monref', 0);
        $sess_city = session('searchField_selcity', 0);

        $query = "
        SELECT 
            dlup.dlup_year AS Year,
            dlup.dlup_monthtxt AS Month,
            xa_mon.fc3 AS International,
            xa_mon.fc4 AS Domestic,
            xa_mon.fc5 AS Total
        FROM dlup
        LEFT JOIN xa_mon ON xa_mon.dlup = dlup.id_dlup
        WHERE dlup.dlup_year IN ($yearcolumn)
          AND dlup.id_dlup >= ?
          AND xa_mon.city_id = ?
    ";

        $data = DB::connection('db_con_409')->select($query, [$sess_monref - 1, $sess_city]);

        $latest_ap_int_arr = [];
        $defaultColor = '#858fae';

        foreach ($data as $row) {
            $latest_ap_int_arr[] = [
                'country' => $row->Month,
                'visits' => $row->Total,
                'color' => $defaultColor,
            ];
        }

        return $latest_ap_int_arr;
    }

    public function airportsForecastsCountry(Request $request)
    {

        // Set 'sess_ctry' from request if available, else keep existing or default to 0
        if ($request->has('selected_ctry')) {
            session(['sess_ctry' => $request->input('selected_ctry')]);
        } elseif (!session()->has('sess_ctry')) {
            session(['sess_ctry' => 0]);
        }

        // Set 'sess_idap' (if applicable in other requests)
        if ($request->has('selected_ap')) {
            session(['sess_idap' => $request->input('selected_ap')]);
        } elseif (!session()->has('sess_idap')) {
            session(['sess_idap' => 0]);
        }

        // Set 'sess_city'
        if ($request->has('selected_city')) {
            session(['sess_city' => $request->input('selected_city')]);
        } elseif (!session()->has('sess_city')) {
            session(['sess_city' => 0]);
        }

        // Set 'sess_monref'
        if ($request->has('monref')) {
            session(['sess_monref' => $request->input('monref')]);
        } elseif (!session()->has('sess_monref')) {
            session(['sess_monref' => 0]);
        }

        $selector = $request->input('sel2');
        $yearColumn = 2025; //$request->input('foo5', '2025');
        $array = explode(',', $yearColumn);

        $clength = count($array);
        $start1 = $array[0];
        $startMonthYear = $start1;
        $endOfYear = $clength > 1 ? $array[$clength - 1] : null;

        if ($clength <= 1 && $start1 > 2020) {
            $startMonthYear = 2016;
        }

        if ($endOfYear > 2020 || $start1 > 2020) {
            $startMonthYear = 2016;
            $monthLastYear = 2020;
        } else {
            $monthLastYear = $endOfYear;
        }

        session(['yearselect' => $yearColumn]);
        $selector = $request->input('sel2');

        // Custom DB connection
        $db = DB::connection('db_con_409');

        // mail_head
        $mailHead = $db->table('mail_head')->where('mhead_id', 1)->first();

        $sessIdap = session('sess_idap', 0);

        // lastdate
        $lastdate = $db->table('xf_lastdate')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'xf_lastdate.lastdate')
            ->select('dlup.dlup_fullmontxt', 'dlup.dlup_year')
            ->where('xf_lastdate.id_lastdate', $sessIdap)
            ->first();

        // Annual Summary
        $annsum = $db->table('xc_ann')
            ->select('year_fcm AS Year', 'fc3 AS International', 'fc4 AS Domestic', 'fc5 AS Total')
            ->whereIn('year_fcm', $array)
            ->where('ap_id', $sessIdap)
            ->orderBy('year_fcm')
            ->get();

        // Annual Summary Change
        $annsumchange = $db->table('xc_ann')
            ->select('year_fcm AS Year', 'fc3_change AS International', 'fc4_change AS Domestic', 'fc5_change AS Total')
            ->whereIn('year_fcm', $array)
            ->where('ap_id', $sessIdap)
            ->orderBy('year_fcm')
            ->get();

        // Airport Ref List
        $apref = $db->table('apref')->select('code_apref', 'apid_apref')->orderBy('code_apref')->get();

        // outof
        $outof = $db->table('outof')->where('ap_id', $sessIdap)->first();

        // City monthly change
        $monref = session('sess_monref', 0);
        $cityId = session('sess_city', 0);
        $citymonchange = $db->table('dlup')
            ->leftJoin('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
            ->select('dlup.dlup_year AS Year', 'dlup.dlup_monthtxt AS Month', 'xa_mon.fc3_change AS International', 'xa_mon.fc4_change AS Domestic', 'xa_mon.fc5_change AS Total')
            ->whereIn('dlup.dlup_year', $array)
            ->where('dlup.id_dlup', '>=', $monref)
            ->where('dlup.id_dlup', '<=', $monref)
            ->where('xa_mon.city_id', $cityId)
            ->get();

        // Country summary
        $countryId = session('sess_ctry', 0);
        $KTColParam1_rst_ctrysumdata = session('sess_ctry', 0); // Default to 0 if not set
        $KTColParam2_rst_ctrysumdata = session('yearselect', '2025');
        $ctrysum = DB::connection('db_con_409')
            ->table('lupcountry')
            ->leftJoin('apref', 'apref.countryid_apref', '=', 'lupcountry.id_country')
            ->leftJoin('xc_ann', 'xc_ann.ap_id', '=', 'apref.apid_apref')
            ->where('lupcountry.id_country', $KTColParam1_rst_ctrysumdata)
            ->where('xc_ann.year_fcm', $KTColParam2_rst_ctrysumdata)
            ->orderBy('xc_ann.fc5', 'desc')
            ->get();

        // Country annual
        $ctryann = $db->table('xc_ann')
            ->select('year_fcm', 'fc3 AS International', 'fc4 AS Domestic', 'fc5 AS Total')
            ->whereIn('year_fcm', $array)
            ->where('country_id', $countryId)
            ->get();

        // Country annual change
        $ctryannchange = $db->table('xc_ann')
            ->select('year_fcm', 'fc3_change AS International', 'fc4_change AS Domestic', 'fc5_change AS Total')
            ->whereIn('year_fcm', $array)
            ->where('country_id', $countryId)
            ->get();

        // Country monthly
        $ctrymon = $db->table('dlup')
            ->leftJoin('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
            ->select('dlup.dlup_year AS Year', 'dlup.dlup_monthtxt AS Month', 'xa_mon.fc3 AS International', 'xa_mon.fc4 AS Domestic', 'xa_mon.fc5 AS Total')
            ->whereIn('dlup.dlup_year', $array)
            ->where('dlup.id_dlup', '>=', $monref - 1)
            ->where('xa_mon.country_id', $countryId)
            ->get();
        // Country monthly change
        $ctrymonchange = $db->table('dlup')
            ->leftJoin('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
            ->select('dlup.dlup_year AS Year', 'dlup.dlup_monthtxt AS Month', 'xa_mon.fc3_change AS International', 'xa_mon.fc4_change AS Domestic', 'xa_mon.fc5_change AS Total')
            ->whereIn('dlup.dlup_year', $array)
            ->where('dlup.id_dlup', '>=', $monref)
            ->where('xa_mon.country_id', $countryId)
            ->get();


        $ctryGraphData = $this->airportcountryannual_forcastgraph();
        $ctryChangeGraphArray = $this->airportcountrychange_forcastgraph();
        $rollingchangectry_chart = $this->airportcountryrollingchange_forcastgraph();
        $latestRollingArr = $this->airportcountryrollingmothly_forcastgraph();



        return view('airports.airportsforecastscountry', compact(
            'mailHead',
            'selector',
            'lastdate',
            'annsum',
            'annsumchange',
            'apref',
            'outof',
            'citymonchange',
            'ctrysum',
            'ctryann',
            'ctryannchange',
            'ctrymon',
            'ctrymonchange',
            'startMonthYear',
            'monthLastYear',
            'ctryGraphData',
            'ctryChangeGraphArray',
            'rollingchangectry_chart',
            'latestRollingArr'
        ));
    }

    private function airportcountryannual_forcastgraph()
    {
        $yearcolumn = session('yearselect');
        $countryId = session('sess_ctry');
        $years = collect(explode(',', $yearcolumn))
            ->map(fn($y) => (int) trim($y))
            ->filter()
            ->toArray();

        $results = DB::connection('db_con_409')
            ->table('xc_ann')
            ->select('year_fcm', DB::raw('fc5 AS Total'))
            ->whereIn('year_fcm', $years)
            ->where('country_id', $countryId)
            ->orderBy('year_fcm')
            ->get();

        $color = '#858fae';
        $ctryGraphData = $results->map(function ($row) use ($color) {
            return [
                'country' => $row->year_fcm,
                'visits' => $row->Total,
                'color' => $color
            ];
        });

        return $ctryGraphData;
    }

    private function airportcountrychange_forcastgraph()
    {
        $yearcolumn = session('yearselect');
        $countryId = session('sess_ctry');

        $years = collect(explode(',', $yearcolumn))
            ->map(fn($y) => (int) trim($y))
            ->filter()
            ->toArray();

        $results = DB::connection('db_con_409')
            ->table('xc_ann')
            ->select('year_fcm', DB::raw('fc5_change AS Total'))
            ->whereIn('year_fcm', $years)
            ->where('country_id', $countryId)
            ->orderBy('year_fcm')
            ->get();

        $ctryChangeGraphArray = $results->map(function ($row) {
            return [
                'country' => $row->year_fcm,
                'visits' => $row->Total,
                'color' => '#858fae'
            ];
        });

        return $ctryChangeGraphArray;
    }

    private function airportcountryrollingchange_forcastgraph()
    {
        $yearcolumn = session('yearselect'); // e.g., '2022,2023'
        $dlup_id = session('sess_monref') ?? 0;
        $countryId = session('sess_ctry') ?? 0;

        // Convert years into array if needed (optional safeguard)
        $years = collect(explode(',', $yearcolumn))
            ->map(fn($y) => (int) trim($y))
            ->filter()
            ->toArray();

        // Pull Year + Month info
        $results = DB::connection('db_con_409')->select("
        SELECT dlup.dlup_year AS Year, 
               dlup.dlup_monthtxt AS Month, 
               xa_mon.fc3_change AS International, 
               xa_mon.fc4_change AS Domestic, 
               xa_mon.fc5_change AS Total
        FROM dlup
        LEFT JOIN xa_mon ON xa_mon.dlup = dlup.id_dlup
        WHERE dlup.dlup_year IN (" . implode(',', $years) . ")
          AND dlup.id_dlup >= ?
          AND xa_mon.country_id = ?
        ORDER BY dlup.dlup_year, dlup.id_dlup
    ", [((int)$dlup_id - 1), $countryId]);

        $rollingchangectry_chart = collect($results)->map(function ($row) {
            return [
                'country' => $row->Month,
                'visits' => $row->Total,
                'color' => '#858fae'
            ];
        });

        return $rollingchangectry_chart;
    }

    public function airportcountryrollingmothly_forcastgraph()
    {
        $yearcolumn = session('yearselect');
        $monRef = session('sess_monref') ?? 0;
        $countryId = session('sess_ctry') ?? 0;

        $years = collect(explode(',', $yearcolumn))
            ->map(fn($y) => (int) trim($y))
            ->filter()
            ->toArray();

        $data = DB::connection('db_con_409')
            ->table('dlup')
            ->leftJoin('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
            ->select([
                'dlup.dlup_year as Year',
                'dlup.dlup_monthtxt as Month',
                'xa_mon.fc3 as International',
                'xa_mon.fc4 as Domestic',
                DB::raw('xa_mon.fc5 / 1000 AS Total')
            ])
            ->whereIn('dlup.dlup_year', $years)
            ->where('dlup.id_dlup', '>=', $monRef - 1)
            ->where('xa_mon.country_id', $countryId)
            ->orderBy('dlup.dlup_year')
            ->orderBy('dlup.dlup_month')
            ->get();

        $color = '#858fae';

        $latestRollingArr = $data->map(fn($row) => [
            'country' => $row->Month,
            'visits' => $row->Total,
            'color' => $color
        ]);

        return $latestRollingArr;
    }

    public function airportsForecastsCountryMulti()
    {
        return view('airports.airportsforecastscountrymulti');
    }

    public function airportsForecastsReg(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Session::put($key, $value);
        }

        // 🔹 Handle year column
        $yearColumn = $request->input('foo7', '0');
        $yearArray = explode(',', $yearColumn);
        $start1 = $yearArray[0] ?? null;
        $end = end($yearArray);
        $startMonthYear = $start1;
        $monthLastYear = $end;

        $startMonthYear = $start1 ?? 2016;
        $monthLastYear = $end ?? 2020;
        if (count($yearArray) === 1 && $start1 > 2020) {
            $startMonthYear = 2016;
        }

        if ($end > 2020 || $start1 > 2020) {
            $startMonthYear = 2016;
            $monthLastYear = 2020;
        }

        Session::put('yearselect', $yearColumn);
        $selector = $request->input('sel3');

        // 🔹 Use stored session values
        $regionId = Session::get('searchField_selreg', 0);
        $monRef = Session::get('sess_monref', 0);
        $annRef = Session::get('sess_annref', 0);
        $annRef = $annRef > 0 ? $annRef : 2024;
        // 🔹 Annual Forecast Data
        $regAnnual = DB::connection('db_con_409')->select("
    SELECT year_fcm AS Year, fc3/1000 AS International, fc4/1000 AS Domestic, fc5/1000 AS Total
    FROM xc_ann
    WHERE year_fcm IN ($yearColumn) AND region_id = ?
", [$regionId]);


        $regAnnChange = DB::connection('db_con_409')->select("
    SELECT year_fcm AS Year, fc3_change AS International, fc4_change AS Domestic, fc5_change AS Total
    FROM xc_ann
    WHERE year_fcm IN ($yearColumn) AND region_id = ?
", [$regionId]);

        // 🔹 Monthly Forecast Data
        $monthlyData = DB::connection('db_con_409')->select("
        SELECT dlup.dlup_year AS Year, dlup.dlup_monthtxt AS Month,
               xa_mon.fc3/1000 AS International, xa_mon.fc4/1000 AS Domestic, xa_mon.fc5/1000 AS Total
        FROM dlup
        LEFT JOIN xa_mon ON xa_mon.dlup = dlup.id_dlup
        WHERE dlup.dlup_year IN ($yearColumn)
          AND dlup.id_dlup >= ?
          AND xa_mon.region_id = ?
    ", [($monRef - 1), $regionId]);

        $monthlyChange = DB::connection('db_con_409')->select("
        SELECT dlup.dlup_year AS Year, dlup.dlup_monthtxt AS Month,
               xa_mon.fc3_change AS International, xa_mon.fc4_change AS Domestic, xa_mon.fc5_change AS Total
        FROM dlup
        LEFT JOIN xa_mon ON xa_mon.dlup = dlup.id_dlup
        WHERE dlup.dlup_year IN ($yearColumn)
          AND dlup.id_dlup >= ?
          AND xa_mon.region_id = ?
    ", [($monRef - 1), $regionId]);

        // 🔹 Region Name & Header
        $regionName = DB::connection('db_con_409')->selectOne("
        SELECT * FROM lupnewsregion WHERE id_region = ?
    ", [$regionId]);

        $mailHead = DB::connection('db_con_409')->selectOne("
        SELECT mhead_thisfc, mhead_lastfc, mhead_lateacts FROM mail_head WHERE mhead_id = 1
    ");

        // 🔹 Region-level Airport Forecasts
        $airportForecasts = DB::connection('db_con_409')->select("
        SELECT apref.aport_apref, apref.code_apref, xc_ann.fc5, lupregion.regionname
        FROM lupregion
        LEFT JOIN apref ON apref.regid_apref = lupregion.id_region
        LEFT JOIN xc_ann ON xc_ann.ap_id = apref.apid_apref
        WHERE xc_ann.year_fcm = ?
          AND apref.regid_apref = ?
        ORDER BY apref.aport_apref ASC, xc_ann.fc5 DESC
    ", [$annRef, $regionId]);
        $selector = $request->input('sel3');
        $fetchRegionForecasts = $this->fetchRegionForecasts();
        $fetchAnnualRegionForecasts = $this->fetchAnnualRegionForecasts();
        $regionrollinchange_chart = $this->regionrollinchange_chart();
        $airportRegionRollingMonthlyForecastGraph = $this->airportRegionRollingMonthlyForecastGraph();




        return view('airports.airportsforecastsreg', compact(
            'regAnnual',
            'regAnnChange',
            'monthlyData',
            'monthlyChange',
            'regionName',
            'mailHead',
            'airportForecasts',
            'startMonthYear',
            'monthLastYear',
            'selector',
            'fetchRegionForecasts',
            'fetchAnnualRegionForecasts',
            'regionrollinchange_chart',
            'airportRegionRollingMonthlyForecastGraph'
        ));
    }


    // region

    public function fetchAnnualRegionForecasts()
    {
        // Get session data for region and year
        $regionId = Session::get('sess_reg', 0);
        $yearColumn = Session::get('yearselect', '0');

        // Prepare the SQL query to fetch the data
        $query = "SELECT xc_ann.year_fcm, 
                     xc_ann.fc3 / 1000 AS International, 
                     xc_ann.fc4 / 1000 AS Domestic, 
                     xc_ann.fc5 / 1000 AS Total
              FROM xc_ann 
              WHERE xc_ann.year_fcm IN ($yearColumn) 
              AND xc_ann.region_id = :regionId";

        $forecastData = DB::connection('db_con_409')->select($query, ['regionId' => $regionId]);

        // Prepare the data for the graph
        $chartData = [];
        $labels = [];
        $dataValues = [];

        foreach ($forecastData as $data) {
            $labels[] = $data->year_fcm;
            $dataValues[] = $data->Total;
        }

        // Define chart color for each value
        $color = array_fill(0, count($dataValues), '#858fae');

        foreach ($dataValues as $key => $value) {
            $chartData[] = [
                'country' => $labels[$key],
                'visits' => $value,
                'color' => $color[$key],
            ];
        }


        return $chartData;
    }
    public function fetchRegionForecasts()
    {
        // Get session data for region and year
        $regionId = Session::get('sess_reg', 1);
        $yearColumn = Session::get('yearselect', '0');

        // Ensure $yearColumn is an array
        if (!is_array($yearColumn)) {
            $yearColumn = [$yearColumn];
        }

        // Query data
        $data = DB::connection('db_con_409')
            ->table('xc_ann')
            ->select('year_fcm as country', 'fc5_change as visits')
            ->whereIn('year_fcm', $yearColumn)
            ->where('region_id', $regionId)
            ->orderBy('year_fcm')
            ->get();

        // Add color attribute to each item
        $data = $data->map(function ($item) {
            $item->color = '#858fae';
            return $item;
        });

        return $data;
    }
    public function regionrollinchange_chart()
    {
        // Get session data for region and year
        $regionId = Session::get('sess_reg', 1);
        $yearColumn = Session::get('yearselect', '0');

        // Prepare the SQL query to fetch the data
        $query = "SELECT xc_ann.year_fcm, 
                         xc_ann.fc3 / 1000 AS International, 
                         xc_ann.fc4 / 1000 AS Domestic, 
                         xc_ann.fc5 / 1000 AS Total
                  FROM xc_ann 
                  WHERE xc_ann.year_fcm IN ($yearColumn) 
                  AND xc_ann.region_id = :regionId";

        $forecastData = DB::connection('db_con_409')->select($query, ['regionId' => $regionId]);

        // Prepare the data for the graph
        $chartData = [];
        $labels = [];
        $dataValues = [];

        foreach ($forecastData as $data) {
            $labels[] = $data->year_fcm;
            $dataValues[] = $data->Total;
        }

        // Define chart color for each value
        $color = array_fill(0, count($dataValues), '#858fae');

        foreach ($dataValues as $key => $value) {
            $regionrollinchange_chart[] = [
                'country' => $labels[$key],
                'visits' => $value,
                'color' => $color[$key],
            ];
        }

        // Pass the chart data to the view
        return $regionrollinchange_chart;
    }

    public function airportRegionRollingMonthlyForecastGraph()
    {
        $conn = DB::connection('db_con_409');

        $dlupStart = session('sess_monref', 0);
        $regionId = session('sess_reg', 1);
        $yearColumn = session('yearselect', '');

        $yearValues = explode(',', $yearColumn);
        $yearPlaceholders = implode(',', array_fill(0, count($yearValues), '?'));

        $query = "
        SELECT 
            dlup.dlup_year AS Year,
            dlup.dlup_monthtxt AS Month,
            xa_mon.fc3 / 1000 AS International,
            xa_mon.fc4 / 1000 AS Domestic,
            xa_mon.fc5 / 1000 AS Total
        FROM dlup
        LEFT JOIN xa_mon ON xa_mon.dlup = dlup.id_dlup
        WHERE dlup.dlup_year IN ($yearPlaceholders)
          AND dlup.id_dlup >= ?
          AND xa_mon.region_id = ?
    ";

        $params = array_merge($yearValues, [($dlupStart - 1), $regionId]);

        $results = $conn->select($query, $params);

        $forecastData = [];
        foreach ($results as $row) {
            $forecastData[] = [
                'country' => $row->Month,
                'visits' => $row->Total,
                'color' => '#858fae'
            ];
        }

        return $forecastData;
    }
    public function airportsForecastsWorld(Request $request)
    {
        // Session & Form Input
        $yearcolumn = $request->input('foo7', '0');
        $array = explode(',', $yearcolumn);
        sort($array);
        $clength = count($array);

        $start1 = $array[0] ?? 0;
        $endofyear = $array[$clength - 1] ?? 0;
        $startmonthyear = ($start1 > 2020) ? 2016 : $start1;

        if ($endofyear > 2020 || $start1 > 2020) {
            $startmonthyear = 2016;
            $monthlastyear = 2020;
        } else {
            $monthlastyear = $endofyear;
        }
        Session::put('yearselect', $yearcolumn);
        $selector = $request->input('sel3');

        $sess_reg = $request->input('searchField_selreg');
        $sess_annref = $request->input('foo7');
        $sess_monref = $request->input('foo7');
        $yearcolumn = $request->input('foo7', []);
        session([
            'selector' => $selector,
            'sess_reg' => $sess_reg,
            'sess_annref' => $sess_annref,
            'sess_monref' => $sess_monref,
            'yearselect' => $yearcolumn,
        ]);
        if (!is_array($yearcolumn)) {
            $yearcolumn = explode(',', $yearcolumn);  // Handle as comma-separated string
        }

        // // Debugging output
        // dd($yearcolumn, $sess_reg, $sess_monref, $sess_annref);

        // Query 1: Annual Forecast Data
        $regAnn = DB::connection('db_con_409')->table('xc_ann')
            ->selectRaw('year_fcm, fc3/1000 AS International, fc4/1000 AS Domestic, fc5/1000 AS Total')
            ->whereIn('year_fcm', $yearcolumn)
            ->where('region_id', $sess_reg)
            ->get();

        // Query 2: Annual Change
        $regAnnChange = DB::connection('db_con_409')->table('xc_ann')
            ->select('year_fcm', 'fc3_change AS International', 'fc4_change AS Domestic', 'fc5_change AS Total')
            ->whereIn('year_fcm', $yearcolumn)
            ->where('region_id', $sess_reg)
            ->get();

        // Query 3: Monthly Forecast Data
        $ctryMon = DB::connection('db_con_409')->table('dlup')
            ->leftJoin('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
            ->selectRaw('dlup.dlup_year AS Year, dlup.dlup_monthtxt AS Month,
                     xa_mon.fc3/1000 AS International, xa_mon.fc4/1000 AS Domestic, xa_mon.fc5/1000 AS Total')
            ->whereIn('dlup.dlup_year', $yearcolumn)
            ->where('dlup.id_dlup', '>=', $sess_monref)
            ->where('xa_mon.region_id', $sess_reg)
            ->get();

        // Query 4: Monthly Change
        $ctryMonChange = DB::connection('db_con_409')->table('dlup')
            ->leftJoin('xa_mon', 'xa_mon.dlup', '=', 'dlup.id_dlup')
            ->select(
                'dlup.dlup_year AS Year',
                'dlup.dlup_monthtxt AS Month',
                'xa_mon.fc3_change AS International',
                'xa_mon.fc4_change AS Domestic',
                'xa_mon.fc5_change AS Total'
            )
            ->whereIn('dlup.dlup_year', $yearcolumn)
            ->where('dlup.id_dlup', '>=', $sess_monref)
            ->where('xa_mon.region_id', $sess_reg)
            ->get();

        // Query 5: Region Name
        $regionName = DB::connection('db_con_409')->table('lupnewsregion')
            ->where('id_region', $sess_reg)
            ->first();

        // Query 6: Mail Header
        $mailHead = DB::connection('db_con_409')->table('mail_head')
            ->where('mhead_id', 1)
            ->first();

        // Query 7: Region Airport Summary
        $regionSummary = DB::connection('db_con_409')->table('lupregion')
            ->leftJoin('apref', 'apref.regid_apref', '=', 'lupregion.id_region')
            ->leftJoin('xc_ann', 'xc_ann.ap_id', '=', 'apref.apid_apref')
            ->select('apref.aport_apref', 'apref.code_apref', 'xc_ann.fc5', 'lupregion.regionname')
            ->where('xc_ann.year_fcm', $sess_annref)
            ->where('apref.regid_apref', $sess_reg)
            ->orderBy('apref.aport_apref', 'ASC')
            ->orderBy('xc_ann.fc5', 'DESC')
            ->get();
        $fetchRegionForecasts = $this->fetchRegionForecasts();
        $fetchAnnualRegionForecasts = $this->fetchAnnualRegionForecasts();
        $regionrollinchange_chart = $this->regionrollinchange_chart();
        $airportRegionRollingMonthlyForecastGraph = $this->airportRegionRollingMonthlyForecastGraph();

        // Pass data to Blade view
        return view('airports.airportsforecastsworld', [
            'regAnn' => $regAnn,
            'regAnnChange' => $regAnnChange,
            'ctryMon' => $ctryMon,
            'ctryMonChange' => $ctryMonChange,
            'regionName' => $regionName,
            'mailHead' => $mailHead,
            'regionSummary' => $regionSummary,
            'yearcolumn' => $yearcolumn,
            'startmonthyear' => $startmonthyear,
            'monthlastyear' => $monthlastyear,
            'selector' => $selector,
            'fetchRegionForecasts' => $fetchRegionForecasts,
            'fetchAnnualRegionForecasts' => $fetchAnnualRegionForecasts,
            'regionrollinchange_chart' => $regionrollinchange_chart,
            'airportRegionRollingMonthlyForecastGraph' => $airportRegionRollingMonthlyForecastGraph
        ]);
    }


    public function airportsQuickSum()
    {

        $row_rst_monname =  DB::connection('db_con_latest')
            ->table('latest_track3_sum as lts')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'lts.dlup')
            ->select([
                'lts.recid',
                'lts.dlup',
                'dlup.dlup_fullmontxt',
                'dlup.dlup_year',
            ])
            ->where('lts.recid', 7)
            ->first();
        $row_rst_inttot = DB::connection('db_con_latest')
            ->table('latest_track3_sum')
            ->where('recid', 7)
            ->first();

        $regions = [
            'africa' => 'latest_track3_afr',
            'asia'   => 'latest_track3_asp',
            'europe' => 'latest_track3_eur',
            'latamerica'  => 'latest_track3_latam',
            'northamerica'    => 'latest_track3_nam',
            'middleeast'    => 'latest_track3_mea',
            'global' => 'latest_track3',

        ];
        $latestMonths = [];

        foreach ($regions as $key => $table) {
            $results = DB::connection('db_con_latest')->select("
                    SELECT montxt
                    FROM {$table}
                    ORDER BY id DESC
                    LIMIT 12
                ");
            $latestMonths[$key] = $results[11]->montxt ?? null; // Get the 12th most recent month
        }


        return view('airports.airportsquicksum', [
            'row_rst_inttot' => $row_rst_inttot,
            'row_rst_monname' => $row_rst_monname,
            'latestMonths' => $latestMonths
        ]);
    }
    public function airportsQuickSumAirpChanges()
    {
        return view('airports.airportsquicksumairpchanges');
    }

    public function airportsQuickSumAirportRecentGrowth()
    {
        return view('airports.airportsquicksumairportrecentgrowth');
    }

    public function airportsQuickSumAirpRegChanges()
    {
        return view('airports.airportsquicksumairpregchanges');
    }

    public function airportsQuickSumBigDownloads()
    {
        return view('airports.airportsquicksumbigdownloads');
    }

    public function airportsQuickSumTermiChanges()
    {
        return view('airports.airportsquicksumtermichanges');
    }

    public function airportsQuickSumTotalRegion()
    {
        return view('airports.airportsquicksumTotalregion');
    }

    public function airportsQuickTopAirportByRegion()
    {
        return view('airports.airportsquicktopairportbyregion');
    }

    public function airportsQuickTopTwentyAirportByRegion()
    {
        return view('airports.airportsquicktoptwentyairportbyregion');
    }

    public function alertBox()
    {
        return view('airports.alertbox');
    }

    // public function alertBoxAllAirportView(Request $request) {

    //     $getid = $request->input('data');
    // $viewid = $request->input('dataview');
    // $dataview_id = $request->input('dataview_id');
    // $loginname = Auth::guard('loginapp')->check() ? Auth::guard('loginapp')->user()?->login_username : null;
    // $companyname = Auth::guard('loginapp')->check() ? Auth::guard('loginapp')->user()?->login_company : null;

    // $viewArr = DB::table('loginapp')
    //     ->where('login_id', $getid)
    //     ->value('restrictview');
    // $viewArr = explode(',', $viewArr);

    // $currentDateTime = date('Y-m-d');
    // $check_mail = DB::table('downloadhistory')
    //     ->where('userid', $getid)
    //     ->where('selector', $viewid)
    //     ->whereDate('datet', $currentDateTime)
    //     ->where('count_download', '1')
    //     ->whereNull('countfile')
    //     ->count();

    // $dataArray = $getid . '=' . $viewid . '=' . $currentDateTime;

    // $check_mail2 = DB::table('downloadhistory')
    //     ->where('userid', $getid)
    //     ->where('selector', $viewid)
    //     ->whereDate('datet', $currentDateTime)
    //     ->count();

    // $count_limit = 5;
    // $arrExtraLimit = array('8', '9', '10');
    // if (in_array($dataview_id, $arrExtraLimit)) {
    //     $count_limit = 10;
    // }

    //     $numberlimits = '';
    //     $numberlimits = $check_mail2 / $count_limit;
    //     $putnumber = '';
    //     if ($numberlimits >= 0) {
    //         $putnumber = $numberlimits;
    //         if ($putnumber == 1) {
    //             $putnumber = "User is blocked " . $putnumber . ' time';
    //         } else {
    //             $putnumber = "User is blocked " . $putnumber . ' times';
    //         }
    //     } else {
    //         $putnumber = '';
    //     }

    //     $allow_download = false;
    //     if ($check_mail <= $count_limit) {
    //         $allow_download = true;
    //         if (in_array($dataview_id, $viewArr)) {
    //             $allow_download = false;
    //         }
    //     }
    //     if ($check_mail >= $count_limit) {
    //         $allow_download = false;
    //     }

    //     $send_mail = false;
    //     if ($allow_download) {
    //         echo "1";
    //     } else {
    //         echo "5";
    //         $send_mail = true;
    //     }

    //     if ($send_mail) {
    //         Mail::to('testve0519@gamil.com')->send(new AlertMail($loginname, $companyname, $viewid, $putnumber));
    //     }
    // }

    public function aportLists()
    {
        return view('airports.aportlists');
    }

    public function aportListsAirportsActual()
    {
        return view('airports.aportlists_aiports_actual');
    }

    public function bigDown()
    {
        return view('airports.BigDown3_2');
    }

    public function compareAirportsForecasts(Request $request)
    {
        $airportList = $request->input('airportlist');
        $dataset = $request->input('dataset');
        $viewName = $request->input('viewname');

        $username = Auth::guard('loginapp')->check() ? Auth::guard('loginapp')->user()?->login_username : null;
        $company = Auth::guard('loginapp')->check() ? Auth::guard('loginapp')->user()?->login_company : null;
        $userId = Auth::guard('loginapp')->check() ? Auth::guard('loginapp')->user()?->login_id : null;
        $companyId = Auth::guard('loginapp')->check() ? Auth::guard('loginapp')->user()?->login_company_id : null;

        $this->recordDownloadHistory($userId, $username, $company, $viewName, $companyId);

        $airportNames = explode(',', $airportList);
        $airportNames = array_map(function ($name) {
            return trim($name, "'"); // remove single quotes from the airport name
        }, $airportNames);
        $datasetArray = explode(',', $dataset);

        $csvFilename = 'AirportForcastsCompare.csv';

        $output = fopen('php://temp', 'w');
        $output1 = fopen('php://temp', 'w'); // Note the addition of $output1

        CsvHelper::generateCsvContent($airportNames, $datasetArray, $output, $output1);

        rewind($output);
        $csvContent = stream_get_contents($output);
        fclose($output);
        fclose($output1); // Don't forget to close $output1

        return response()->stream(function () use ($csvContent) {
            echo $csvContent;
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFilename . '"',
        ]);
    }

    protected function recordDownloadHistory($userId, $username, $company, $viewName, $companyId)
    {
        $curdate = now()->format('Y-m-d H:i:s');

        DB::table('downloadhistory')->insert([
            'userid' => $userId,
            'username' => $username,
            'company' => $company,
            'selector' => $viewName,
            'datet' => $curdate,
            'company_id' => $companyId,
            'ip_address' => "127.0.0.1",
            'selector_type' => 1,
            'selector_id' => 0,
            'site_id' => 0,
            'download_url' => $viewName,
        ]);
    }
    public function compareCountryForecasts()
    {
        return view('airports.comparecountry_forecasts');
    }

    public function compareData()
    {
        return view('airports.comparedata');
    }

    public function compareRegionForecasts()
    {
        return view('airports.compareregion_forecasts');
    }

    public function countryForecastsMulti()
    {
        return view('airports.country_forecasts_multi');
    }

    public function countryList()
    {
        return view('airports.countrylist');
    }

    public function findAportCode(Request $request)
    {
        $keyword = $request->input('keyword');

        // First, find dlup ID from latest_liveinput3
        $result = DB::connection('db_con_latest')
            ->table('latest_liveinput3')
            ->select('dlup')
            ->where('jracode', 'LIKE', "%$keyword%")
            ->orderBy('jracode')
            ->first();

        if (!$result) {
            return response()->json(['dlup_fullmontxt' => null, 'dlup_year' => null]);
        }

        $dlup = $result->dlup;

        // Now get full month text and year from dlup table
        $dlupdata = DB::connection('db_con_latest')
            ->table('dlup')
            ->select('dlup_fullmontxt', 'dlup_year')
            ->where('id_dlup', $dlup)
            ->first();

        return response()->json($dlupdata);
    }
    public function findAportCodeDom(Request $request)
    {
        $keyword = $request->input('keyword');

        // Step 1: Get 'dlup' from latest_liveinput
        $dlupRecord = DB::connection('db_con_latest')
            ->table('latest_liveinput')
            ->where('jracode', 'like', '%' . $keyword . '%')
            ->orderBy('jracode', 'asc')
            ->first();

        if (!$dlupRecord) {
            return response()->json(['dlup_fullmontxt' => null, 'dlup_year' => null]);
        }

        // Step 2: Get dlup data from 'dlup' table using the retrieved ID
        $dlupData = DB::connection('db_con_latest')
            ->table('dlup')
            ->where('id_dlup', $dlupRecord->dlup)
            ->select('dlup_fullmontxt', 'dlup_year')
            ->first();

        return response()->json($dlupData);
    }


    public function findAportList(Request $request)
    {
        $keyword = $request->input('keyword');
        $curyear = $request->input('curyear');

        // Get id_dlup from 'dlup' table
        $dlup = DB::connection('db_con_latest')
            ->table('dlup')
            ->where('dlup_monthtxt', $keyword)
            ->where('dlup_year', $curyear)
            ->first();

        if (!$dlup) {
            return response()->json('<li>No data found</li>');
        }

        // Get jracodes from 'latest_liveinput3'
        $jracodes = DB::connection('db_con_latest')
            ->table('latest_liveinput3')
            ->select('jracode')
            ->where('dlup', $dlup->id_dlup)
            ->orderBy('jracode')
            ->pluck('jracode');

        // Step 3: Return HTML <li> elements as response
        $html = '';
        foreach ($jracodes as $code) {
            $html .= '<li>' . e($code) . '</li>';
        }

        return response()->json($html);
    }

    public function findAportListDom(Request $request)
    {
        $month = $request->input('keyword');
        $curYear = $request->input('curyear');

        // Step 1: Get id_dlup for the selected month and year
        $dlup = DB::connection('db_con_latest')
            ->table('dlup')
            ->where('dlup_monthtxt', $month)
            ->where('dlup_year', $curYear)
            ->value('id_dlup');

        if (!$dlup) {
            return response()->json('<li>No data found</li>');
        }

        // Step 2: Get jracode values for that dlup
        $jracodes = DB::connection('db_con_latest')
            ->table('latest_liveinput')
            ->where('dlup', $dlup)
            ->orderBy('jracode', 'asc')
            ->pluck('jracode');

        // Step 3: Return HTML <li> elements as response
        $html = '';
        foreach ($jracodes as $code) {
            $html .= '<li>' . e($code) . '</li>';
        }

        return response()->json($html);
    }

    public function multiAirportActual()
    {
        return view('airports.multi_airport_actual');
    }

    public function multiCountryActual()
    {
        return view('airports.multi_country_actual');
    }

    public function multiRegionActual()
    {
        return view('airports.multi_region_actual');
    }

    public function pageControl()
    {
        return view('airports.pagecontrol');
    }

    public function regionForecastsMulti()
    {
        return view('airports.region_forecasts_multi');
    }

    public function regionList()
    {
        return view('airports.regionlist');
    }

    public function testAttachment()
    {
        return view('airports.testattachment');
    }

    public function theBigDownloadRestrictionAlertbox()
    {
        return view('airports.thebigdownload_restriction_alertbox');
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $airports = DB::connection('db_con_409')->table('lupap')->where('apname', 'like', '%' . $keyword . '%')->get();
        return view('airports.aportlists', compact('airports'));
    }

    public function one_airport_at_a_time(Request $request)
    {
        // Step 1: Get default terminal (first airport with year > 2018)
    $row = DB::connection('db_con_latest')->table('latest_act')
    ->where('year', '>', 2018)
    ->orderBy('apcode', 'asc')
    ->limit(1)
    ->first();
if (!$row) {
    return response()->json(['message' => 'No data found'], 404);
}

$finalgettermcodeval = $row->apcode;
$finalapnameval = $row->apname;
$mergevalues = $row->apname . ' ' . $row->apcode;

Session::put('sess_airport_sel', $finalgettermcodeval);


// Step 2: Get terminal data for selected airport
$sub = DB::connection('db_con_latest')->table('latest_act')
    ->selectRaw('MAX(id) as id')
    ->where('apcode', $finalgettermcodeval)
    ->where('year', '>', 2018)
    ->groupBy('dlup', 'dno');

$rst_terminal = DB::connection('db_con_latest')->table('latest_act')
    ->joinSub($sub, 'sub', 'latest_act.id', '=', 'sub.id')
    ->orderBy('dlup', 'asc')
    ->get();
    //dd($rst_terminal);

// Step 3: Get all unique terminals
$terminalList = DB::connection('db_con_latest')->table('latest_act')
    ->select('apcode', 'apname')
    ->distinct()
    ->get()
    ->map(function ($row) {
        return $row->apname . ' ; ' . $row->apcode;
    });

$encodedData = json_encode($terminalList);

// Step 4: Build nested array
$rawData = DB::connection('db_con_latest')->table('latest_act')
    ->where('apcode', $finalgettermcodeval)
    ->where('year', '>', 2018)
    ->get();

$arr = [];
foreach ($rawData as $row) {
    $key = $row->apcode;
    $year = $row->year;
    $monthKey = $row->dlup . '-' . $row->montxt;
    $dno = $row->dno;
    $arr[$key][$year][$monthKey][$dno] = $row->pax;
}

// Step 5: Build structured arrays
$arrValArr = [];
$arrIntTerminalData = [];
$arrDomTerminalData = [];
$arrTotTerminalData = [];
$arrAllTerminalData = [];

foreach ($arr as $apcode => $yearData) {
    foreach ($yearData as $year => $monthGroups) {
        foreach ($monthGroups as $monthKey => $dnoValues) {
            [$dlup, $montxt] = explode('-', $monthKey);
            $monthVal = date("m", strtotime($montxt));
            $monthName = date("F", strtotime($montxt));
            $yearForMonth = ($montxt === 'Jan') ? $year : '';
            $monthWithYear = $monthName . ' ' . $yearForMonth;

            $arrValArr[] = [
                'termcode' => $apcode,
                'year' => $year,
                'dlup' => $monthKey,
                'month' => $montxt,
                'int' => $dnoValues[3] ?? 0,
                'dom' => $dnoValues[4] ?? 0,
                'tot' => $dnoValues[5] ?? 0,
            ];

            $arrAllTerminalData[] = [
                'mon' => "$montxt $year",
                'month' => $monthWithYear,
                'int_prop' => $dnoValues[3] ?? 0,
                'dom_prop' => $dnoValues[4] ?? 0,
                'tot_prop' => $dnoValues[5] ?? 0,
                'date' => "$year-$monthVal",
                'year' => (string)$year,
            ];

            $arrIntTerminalData[] = [
                'mon' => "$montxt $year",
                'month' => $monthWithYear,
                'prop' => $dnoValues[3] ?? 0,
                'date' => "$year-$monthVal",
                'year' => (string)$year,
            ];

            $arrDomTerminalData[] = [
                'mon' => "$montxt $year",
                'month' => $monthWithYear,
                'prop' => $dnoValues[4] ?? 0,
                'date' => "$year-$monthVal",
                'year' => (string)$year,
            ];

            $arrTotTerminalData[] = [
                'mon' => $montxt,
                'prop' => $dnoValues[3] ?? 0,
                'year' => $year,
            ];
        }
    }
}
        return view('airports.one-airport-at-a-time', compact(
            'arrValArr',
            'arrIntTerminalData',
            'arrDomTerminalData',
            'arrTotTerminalData',
            'arrAllTerminalData',
            'encodedData',
            'finalapnameval',
            'mergevalues'
        ));
    }
}
