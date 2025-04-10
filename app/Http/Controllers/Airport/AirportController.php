<?php

namespace App\Http\Controllers\Airport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

public function airportsActualsTot() {
    return view('airports.airportsactualstot');
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
