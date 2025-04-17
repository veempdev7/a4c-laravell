<?php

namespace App\Http\Controllers\Airport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirportController extends Controller
{
    public function airportshome()
{
    return view('airports.airportshome');
}

public function actualsForecastMulti() {
    return view('airports.actuals_forecasts_multi');
}

public function airportActualCountryMultiCompareData() {
    return view('airports.airport_actual_country_multi_comparedata');
}

public function airportActualMultiCompareData() {
    return view('airports.airport_actual_multi_comparedata');
}

public function airportForecastCountryMultiCompareData() {
    return view('airports.airport_forecast_country_multi_comparedata');
}

public function airportForecastsCountryMulti() {
    return view('airports.airport_forecasts_country_multi');
}

public function airportForecastsMultiSelector() {
    return view('airports.airportforecasts_multiselector');
}

public function airportsActualAirports() {
    return view('airports.airportsactualairports');
}

public function airportsActualAirportsCountryMulti() {
    return view('airports.airportsactualairportscountrymulti');
}

public function airportsActualAirportsMulti() {
    return view('airports.airportsactualairportsmulti');
}

public function airportsActualLatMonth() {
    return view('airports.airportsactuallatmonth');
}

public function airportsActualsAirl() {
    return view('airports.airportsactualsairl');
}

public function airportsActualsAirlALPR() {
    return view('airports.airportsactualsairlALPR');
}

public function airportsActualsAirlALR() {
    return view('airports.airportsactualsairlALR');
}

public function airportsActualsAirlLP() {
    return view('airports.airportsactualsairlLP');
}

public function airportsActualsAirlLPR() {
    return view('airports.airportsactualsairlLPR');
}

public function airportsActualsAirlP() {
    return view('airports.airportsactualsairlP');
}

public function airportsActualsInt() {
    return view('airports.airportsactualsint');
}

public function airportsActualsIntLat() {
    return view('airports.airportsactualsint_lat');
}


public function airportsActualsTottest(Request $request)
    {
        $stMonth = DB::connection('db446161675')->table('latestnewmon')
    ->where('id', 1)
    ->value('newmon');
    $KTColParam1_rst_latest_aport = "AAL";
    if (session()->has("sess_aport")) {
      $KTColParam1_rst_latest_aport = session()->get("sess_aport");
    }
    
    $rst_latest_aport = DB::connection('db446161800')->table('latest_liveinput')
  ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
  ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
  ->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt', 'latest_liveinput.paxchange', 'latest_liveinput.pax', 'latest_liveinput.dlup')
  ->where('latest_liveinput.jracode', $KTColParam1_rst_latest_aport)
  ->first();
    
       // Query 1: $rst_latest_list
$row_rst_latest_list = DB::connection('db446161800')->table('latest_liveinput')
->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
->where('latest_liveinput.dlup', $stMonth)
->orderBy('latest_apref.aport_apref', 'ASC')
->get();

// Query 2: $rst_latest_list2
$row_rst_latest_list2 =  DB::connection('db446161800')->table('latest_liveinput')
->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
->where('latest_liveinput.dlup', $stMonth - 1)
->orderBy('latest_apref.aport_apref', 'ASC')
->get();

// Query 3: $rst_latest_list3
$row_rst_latest_list3 = DB::connection('db446161800')->table('latest_liveinput')
->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
->where('latest_liveinput.dlup', '<=', $stMonth - 2)
->orderBy('latest_apref.aport_apref', 'ASC')
->get();

// Query 4: $rst_latest_min
$row_rst_latest_min = DB::connection('db446161800')->table('latest_liveinput')
->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
->select(DB::raw('MIN(latest_liveinput.dlup) AS min_dlup_1'), 'dlup.dlup_fullmontxt', 'dlup.dlup_year')
->groupBy('dlup.dlup_fullmontxt', 'dlup.dlup_year')
->orderBy('min_dlup_1', 'ASC')
->get();

// Query 5: $rst_latest_max
$row_rst_latest_max = DB::connection('db446161800')->table('latest_liveinput')
->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
->select('dlup.dlup_fullmontxt', 'dlup.dlup_year', DB::raw('MAX(latest_liveinput.dlup) AS max_dlup_1'))
->groupBy('dlup.dlup_fullmontxt', 'dlup.dlup_year')
->orderBy('max_dlup_1', 'DESC')
->get();

// Query 6: $rst_monthdrop
$row_rst_monthdrop = DB::connection('db446161800')->table('dlup')
->where('id_dlup', 196)
->get();

// Query 7: $rst_aportdrop
$rst_aportdrop = DB::connection('db446161800')->table('latest_liveinput')
->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
->select('latest_liveinput.jracode', DB::raw("CONCAT(latest_apref.aport_apref, '; ', dlup.dlup_monthtxt) AS aportdate"))
->orderBy('latest_apref.aport_apref', 'ASC')
->get();

// Query 8: $rst_latest_list_3head
$row_rst_latest_list_3head = DB::connection('db446161800')->table('latest_liveinput')
    ->leftJoin('latest_apref', 'latest_apref.code_apref', '=', 'latest_liveinput.jracode')
    ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveinput.dlup')
    ->select('latest_liveinput.id', 'latest_apref.aport_apref', 'latest_liveinput.jracode', 'dlup.dlup_monthtxt', 'dlup.dlup_year', 'dlup.dlup_fullmontxt')
    ->where('latest_liveinput.dlup', $stMonth - 2)
    ->orderBy('latest_apref.aport_apref', 'ASC')
    ->get();
    
  // Get the values of KTColParam1_rst_latest12pax and KTColParam2_rst_latest12pax
  $jr_code = "ZYI";
  $last_date = 397;

    $rst_latest12pax = DB::connection('db446161800')
    ->table('latest_liveupdate')
    ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')
    ->where('latest_liveupdate.jracode', $jr_code)
    ->where('latest_liveupdate.dlup', '<=', $last_date)
    ->where('latest_liveupdate.dlup', '>=', $last_date - 11)
    ->orderBy('latest_liveupdate.dlup', 'asc')
    ->select('dlup.dlup_year', 'dlup.dlup_monthtxt', 'latest_liveupdate.fc', 'latest_liveupdate.jracode', 'latest_liveupdate.dlup')
    ->get();




$KTColParam1_rst_latest12 = "ZYI";
$KTColParam2_rst_latest12 = 397;
// Define the query
$rst_latest12 = DB::connection('db446161800')
    ->table('latest_liveupdate')
    ->leftJoin('dlup', 'dlup.id_dlup', '=', 'latest_liveupdate.dlup')
    ->where('latest_liveupdate.jracode', $KTColParam1_rst_latest12)
    ->where('latest_liveupdate.dlup', '<=', $KTColParam2_rst_latest12)
    ->where('latest_liveupdate.dlup', '>=', $KTColParam2_rst_latest12 - 11)
    ->orderBy('latest_liveupdate.dlup', 'asc')
    ->select('dlup.dlup_year', 'dlup.dlup_monthtxt', 'latest_liveupdate.fc_change', 'latest_liveupdate.jracode', 'latest_liveupdate.dlup')
    ->get();
// Execute the query

$colname_rst_ytd = "-1";
if (session()->has('sess_aport')) {
    $colname_rst_ytd = session('sess_aport');
}

$rst_ytd = DB::connection('db446161800')->table('latest_ytd')
    ->where('jracode', $colname_rst_ytd)
    ->first();

$row_rst_ytd = $rst_ytd;


  
// Get the total rows for each query

// $totalRows_rst_latest_list = $row_rst_latest_list->count();
// $totalRows_rst_latest_list2 = $row_rst_latest_list2->count();
// $totalRows_rst_latest_list3 = $row_rst_latest_list3->count();
// $totalRows_rst_latest_min = $row_rst_latest_min->count();
// $totalRows_rst_latest_max = $row_rst_latest_max->count();
// $totalRows_rst_monthdrop = $row_rst_monthdrop->count();
// $totalRows_rst_aportdrop = $rst_aportdrop->count();
// $totalRows_rst_latest_list_3head = $row_rst_latest_list_3head->count();

// Get the first row for each query

//$colname_rst_ytd = "-1";ZYI
$colname_rst_ytd = "ZYI";
if (session()->has('sess_aport')) {
    $colname_rst_ytd = session('sess_aport');
}

$rst_ytd = DB::connection('db446161800')->table('latest_ytd')
    ->where('jracode', $colname_rst_ytd)
    ->first();

    $colname_rst_onsystem = session('sess_aport', 'ZYI');

    // Query the database using the Query Builder
    $row_rst_onsystem  = DB::connection('db446161800')->table('latest_liveinput')
    ->where('jracode', $colname_rst_onsystem)
    ->select('entdate')
    ->first();

    $colname_rst_websource = "YKM";
    if (session()->has('sess_aport')) {
        $colname_rst_websource = session('sess_aport');
    }
    
    $row_rst_websource = DB::connection('db446161800')->table('liveupdate_websource')
    ->where('jracode', $colname_rst_websource)
    ->select('websource')
    ->first();
    $totalRows_rst_aportdrop = $rst_aportdrop->count();
    $latest_ap_array = $this->getLatestData();
    $latest_apann280_arr = $this->getAirportDataForGraph();
    $latestApGraphData = $this->getLatestApGraphData();
    $trendData = $this->getTrendData();
    $minMaxData = $this->getMinMaxData();
    $latest_apgraphline_arr = $this->prepareChartData($latestApGraphData, $trendData);
    return view('airports.airportsActualsTottest', compact('rst_latest_aport','rst_aportdrop','row_rst_latest_list','row_rst_latest_list2','row_rst_latest_list3', 'totalRows_rst_aportdrop', 'row_rst_latest_list_3head','rst_latest12pax','rst_latest12','rst_ytd','row_rst_onsystem','row_rst_websource','latest_ap_array','latest_apann280_arr','latestApGraphData','trendData','minMaxData','latest_apgraphline_arr'));
}

    public function getLatestData()
    {
        // Get the necessary session variables
        $colname_rst_latest12 = session()->has('sess_aport') ? session('sess_aport') : "ZYI";
        $lastDate = session()->has('sess_lastdate') ? session('sess_lastdate') : 397;
    
        // Join the tables and run the query with conditions
        $results = DB::connection('db446161800')
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

    public function getAirportDataForGraph()
    {
        // Default to 0 if session values are not available
        $KTColParam1_rst_latest12 = $lastDate ?? 397;
        $KTColParam2_rst_latest12 = $aportCode ??  "ZYI";

        // Perform the database query using Laravel's query builder
        $results = DB::connection('db446161800')
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
    
    private function getLatestApGraphData()
    {
        $lastdate = $lastDate ?? 397;
        $aport = $aportCode ??  "ZYI";
        return DB::connection('db446161800')
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
    private function getTrendData()
    {
        $lastdate = $lastDate ?? 397;
        $aport = $aportCode ??  "ZYI";
        return DB::connection('db446161854')
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
    private function getMinMaxData()
    {
        $aport = $aportCode ??  "ZYI";
        $minact = DB::connection('db446161800')
            ->table('latest_liveupdate')
            ->where('latest_liveupdate.jracode', $aport)
            ->min('latest_liveupdate.fc');

        $maxact = DB::connection('db446161800')
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


public function airportsActualsTot()
{
    $stMonth = now()->format('Ym');

    // Query 1: Dropdown aport list
    $aportDrop = DB::connection('db446161800')->select("
        SELECT 
            latest_liveinput.jracode, 
            CONCAT(latest_apref.aport_apref, '; ', dlup.dlup_monthtxt) AS aportdate
        FROM 
            latest_liveinput
        LEFT JOIN latest_apref ON latest_apref.code_apref = latest_liveinput.jracode
        LEFT JOIN dlup ON dlup.id_dlup = latest_liveinput.dlup
        ORDER BY latest_apref.aport_apref ASC
    ");

    // Query 2: Latest list 3 head (month - 2)
    $latestList3Head = DB::connection('db446161800')->select("
        SELECT 
            latest_liveinput.id, 
            latest_apref.aport_apref, 
            latest_liveinput.jracode, 
            dlup.dlup_monthtxt, 
            dlup.dlup_year, 
            dlup.dlup_fullmontxt
        FROM 
            latest_liveinput
        LEFT JOIN latest_apref ON latest_apref.code_apref = latest_liveinput.jracode
        LEFT JOIN dlup ON dlup.id_dlup = latest_liveinput.dlup
        WHERE 
            latest_liveinput.dlup = ? - 2
        ORDER BY latest_apref.aport_apref ASC
    ", [$stMonth]);

    // Query 3: Dropdown list (used in form select)
    $latestList = DB::connection('db446161800')->select("
        SELECT 
            latest_liveinput.jracode, 
            latest_apref.aport_apref
        FROM 
            latest_liveinput
        LEFT JOIN latest_apref ON latest_apref.code_apref = latest_liveinput.jracode
        GROUP BY latest_liveinput.jracode
    ");

    // Query 4: Airport stats (most recent)
    $airportStats = DB::connection('db446161800')->selectOne("
        SELECT 
            dlup.dlup_fullmontxt,
            latest_liveinput.paxchange,
            latest_liveinput.pax,
            latest_liveinput.roll_ch,
            latest_liveinput.pax_ytd,
            latest_liveinput.roll_thisyr
        FROM 
            latest_liveinput
        LEFT JOIN dlup ON dlup.id_dlup = latest_liveinput.dlup
        ORDER BY dlup.id_dlup DESC
        LIMIT 1
    ");

    // Optional: Use current and next month names
    $thisupdateYr = now()->format('F Y');
    $nxtupdateYr = now()->addMonth()->format('F Y');

    return view('airports.airportsactualstottest', [
        'aportDrop' => $aportDrop,
        'latestList3Head' => $latestList3Head,
        'latestList' => $latestList,
        'airportStats' => $airportStats,
        'thisupdateYr' => $thisupdateYr,
        'nxtupdateYr' => $nxtupdateYr,
    ]);
}

public function airportsActualsTotLat() {
    return view('airports.airportsactualstot_lat');
}

public function airportsForecasts() {
    return view('airports.airportsforecasts');
}

public function airportsForecastsAirp() {
    return view('airports.airportsforecastsairp');
}

public function airportsForecastsAirpdl() {
    return view('airports.airportsforecastsairpdl');
}

public function airportsForecastsCity() {
    return view('airports.airportsforecastscity');
}

public function airportsForecastsCountry() {
    return view('airports.airportsforecastscountry');
}

public function airportsForecastsCountryMulti() {
    return view('airports.airportsforecastscountrymulti');
}

public function airportsForecastsReg() {
    return view('airports.airportsforecastsreg');
}

public function airportsForecastsWorld() {
    return view('airports.airportsforecastsworld');
}

public function airportsQuickSum() {
    return view('airports.airportsquicksum');
}

public function airportsQuickSumAirpChanges() {
    return view('airports.airportsquicksumairpchanges');
}

public function airportsQuickSumAirportRecentGrowth() {
    return view('airports.airportsquicksumairportrecentgrowth');
}

public function airportsQuickSumAirpRegChanges() {
    return view('airports.airportsquicksumairpregchanges');
}

public function airportsQuickSumBigDownloads() {
    return view('airports.airportsquicksumbigdownloads');
}

public function airportsQuickSumTermiChanges() {
    return view('airports.airportsquicksumtermichanges');
}

public function airportsQuickSumTotalRegion() {
    return view('airports.airportsquicksumTotalregion');
}

public function airportsQuickTopAirportByRegion() {
    return view('airports.airportsquicktopairportbyregion');
}

public function airportsQuickTopTwentyAirportByRegion() {
    return view('airports.airportsquicktoptwentyairportbyregion');
}

public function alertBox() {
    return view('airports.alertbox');
}

public function alertBoxAllAirportView() {
    return view('airports.alertboxallairportview');
}

public function aportLists() {
    return view('airports.aportlists');
}

public function aportListsAirportsActual() {
    return view('airports.aportlists_aiports_actual');
}

public function bigDown() {
    return view('airports.BigDown3_2');
}

public function compareAirportsForecasts() {
    return view('airports.compareairports_forecasts');
}

public function compareCountryForecasts() {
    return view('airports.comparecountry_forecasts');
}

public function compareData() {
    return view('airports.comparedata');
}

public function compareRegionForecasts() {
    return view('airports.compareregion_forecasts');
}

public function countryForecastsMulti() {
    return view('airports.country_forecasts_multi');
}

public function countryList() {
    return view('airports.countrylist');
}

public function findAportCode() {
    return view('airports.find_aportcode');
}

public function findAportCodeDom() {
    return view('airports.find_aportcode_dom');
}

public function findAportList() {
    return view('airports.find_aportlist');
}

public function findAportListDom() {
    return view('airports.find_aportlist_dom');
}

public function multiAirportActual() {
    return view('airports.multi_airport_actual');
}

public function multiCountryActual() {
    return view('airports.multi_country_actual');
}

public function multiRegionActual() {
    return view('airports.multi_region_actual');
}

public function pageControl() {
    return view('airports.pagecontrol');
}

public function regionForecastsMulti() {
    return view('airports.region_forecasts_multi');
}

public function regionList() {
    return view('airports.regionlist');
}

public function testAttachment() {
    return view('airports.testattachment');
}

public function theBigDownloadRestrictionAlertbox() {
    return view('airports.thebigdownload_restriction_alertbox');
}


}
