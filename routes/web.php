<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginAppController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AuthenticateLoginApp;
use App\Http\Controllers\Airport\AirportController;
use App\Http\Controllers\csvpages\CsvpagesController;

Route::get('login', [LoginAppController::class, 'showLoginForm'])->name('loginapp.show');
Route::post('login', [LoginAppController::class, 'login'])->name('loginapp.login');



Route::middleware(AuthenticateLoginApp::class)->group(function () {
    Route::post('logout', [LoginAppController::class, 'logout'])->name('loginapp.logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::middleware([AuthenticateLoginApp::class])->prefix('airports')->group(function () {
    Route::get('home', [AirportController::class, 'airportshome'])->name('airports.home');
    Route::get('actuals-forecast-multi', [AirportController::class, 'actualsForecastMulti'])->name('airports.actuals.forecast.multi');
    Route::get('airport-actual-country-multi-comparedata', [AirportController::class, 'airportActualCountryMultiCompareData'])->name('airports.actual.country.multi.comparedata');
    Route::get('airport-actual-multi-comparedata', [AirportController::class, 'airportActualMultiCompareData'])->name('airports.actual.multi.comparedata');
    Route::get('airport-forecast-country-multi-comparedata', [AirportController::class, 'airportForecastCountryMultiCompareData'])->name('airports.forecast.country.multi.comparedata');
    Route::get('airport-forecasts-country-multi', [AirportController::class, 'airportForecastsCountryMulti'])->name('airports.forecasts.country.multi');
    Route::get('airportforecasts-multiselector', [AirportController::class, 'airportForecastsMultiSelector'])->name('airports.forecasts.multiselector');
    Route::get('actual-airports', [AirportController::class, 'airportsActualAirports'])->name('airports.actual.airports');
    Route::get('actual-airports-countrymulti', [AirportController::class, 'airportsActualAirportsCountryMulti'])->name('airports.actual.airports.countrymulti');
    Route::get('actual-airports-multi', [AirportController::class, 'airportsActualAirportsMulti'])->name('airports.actual.airports.multi');
    Route::get('actual-lat-month', [AirportController::class, 'airportsActualLatMonth'])->name('airports.actual.lat.month');
    Route::get('actuals-airl', [AirportController::class, 'airportsActualsAirl'])->name('airports.actuals.airl');
    Route::get('actuals-airl-alpr', [AirportController::class, 'airportsActualsAirlALPR'])->name('airports.actuals.airl.alpr');
    Route::get('actuals-airl-alr', [AirportController::class, 'airportsActualsAirlALR'])->name('airports.actuals.airl.alr');
    Route::get('actuals-airl-lp', [AirportController::class, 'airportsActualsAirlLP'])->name('airports.actuals.airl.lp');
    Route::get('actuals-airl-lpr', [AirportController::class, 'airportsActualsAirlLPR'])->name('airports.actuals.airl.lpr');
    Route::get('actuals-airl-p', [AirportController::class, 'airportsActualsAirlP'])->name('airports.actuals.airl.p');
    Route::get('actuals-int', [AirportController::class, 'airportsActualsInt'])->name('airports.actuals.int');
    Route::get('actuals-int-lat', [AirportController::class, 'airportsActualsIntLat'])->name('airports.actuals.int.lat');
    Route::get('actuals-tot', [AirportController::class, 'airportsActualsTot'])->name('airports.actuals.tot');
    Route::get('airportsactualstot', [AirportController::class, 'airportsActualsTottest'])->name('airports.actuals.tottest');
    Route::get('actuals-tot-lat', [AirportController::class, 'airportsActualsTotLat'])->name('airports.actuals.tot.lat');
    Route::get('forecasts', [AirportController::class, 'airportsForecasts'])->name('airports.forecasts');
    Route::get('forecasts-airp', [AirportController::class, 'airportsForecastsAirp'])->name('airports.forecasts.airp');
    Route::get('forecasts-airpdl', [AirportController::class, 'airportsForecastsAirpdl'])->name('airports.forecasts.airpdl');
    Route::get('forecasts-city', [AirportController::class, 'airportsForecastsCity'])->name('airports.forecasts.city');
    Route::get('forecasts-country', [AirportController::class, 'airportsForecastsCountry'])->name('airports.forecasts.country');
    Route::get('forecasts-countrymulti', [AirportController::class, 'airportsForecastsCountryMulti'])->name('airports.forecasts.countrymulti');
    Route::get('forecasts-reg', [AirportController::class, 'airportsForecastsReg'])->name('airports.forecasts.reg');
    Route::get('forecasts-world', [AirportController::class, 'airportsForecastsWorld'])->name('airports.forecasts.world');
    Route::get('quicksum', [AirportController::class, 'airportsQuickSum'])->name('airports.quicksum');
    Route::get('quicksum-airp-changes', [AirportController::class, 'airportsQuickSumAirpChanges'])->name('airports.quicksum.airp.changes');
    Route::get('quicksum-airport-recent-growth', [AirportController::class, 'airportsQuickSumAirportRecentGrowth'])->name('airports.quicksum.airport.recent.growth');
    Route::get('quicksum-airpreg-changes', [AirportController::class, 'airportsQuickSumAirpRegChanges'])->name('airports.quicksum.airpreg.changes');
    Route::get('quicksum-bigdownloads', [AirportController::class, 'airportsQuickSumBigDownloads'])->name('airports.quicksum.bigdownloads');
    Route::get('quicksum-termichanges', [AirportController::class, 'airportsQuickSumTermiChanges'])->name('airports.quicksum.termichanges');
    Route::get('quicksum-totalregion', [AirportController::class, 'airportsQuickSumTotalRegion'])->name('airports.quicksum.totalregion');
    Route::get('quicktop-airport-by-region', [AirportController::class, 'airportsQuickTopAirportByRegion'])->name('airports.quicktop.airport.by.region');
    Route::get('quicktop-twenty-airport-by-region', [AirportController::class, 'airportsQuickTopTwentyAirportByRegion'])->name('airports.quicktop.twenty.airport.by.region');
    Route::get('alertbox', [AirportController::class, 'alertBox'])->name('airports.alertbox');
    Route::get('alertbox-all-airport-view', [AirportController::class, 'alertBoxAllAirportView'])->name('airports.alertbox.allairportview');
    Route::get('aportlists', [AirportController::class, 'aportLists'])->name('airports.aportlists');
    Route::get('aportlists-airports-actual', [AirportController::class, 'aportListsAirportsActual'])->name('airports.aportlists.airports.actual');
    Route::get('bigdown', [AirportController::class, 'bigDown'])->name('airports.bigdown');
    Route::get('compare-airports-forecasts', [AirportController::class, 'compareAirportsForecasts'])->name('airports.compare.airports.forecasts');
    Route::get('compare-country-forecasts', [AirportController::class, 'compareCountryForecasts'])->name('airports.compare.country.forecasts');
    Route::get('compare-data', [AirportController::class, 'compareData'])->name('airports.compare.data');
    Route::get('compare-region-forecasts', [AirportController::class, 'compareRegionForecasts'])->name('airports.compare.region.forecasts');
    Route::get('country-forecasts-multi', [AirportController::class, 'countryForecastsMulti'])->name('airports.country.forecasts.multi');
    Route::get('countrylist', [AirportController::class, 'countryList'])->name('airports.countrylist');
    Route::get('find-aportcode', [AirportController::class, 'findAportCode'])->name('airports.find.aportcode');
    Route::get('find-aportcode-dom', [AirportController::class, 'findAportCodeDom'])->name('airports.find.aportcode.dom');
    Route::get('find-aportlist', [AirportController::class, 'findAportList'])->name('airports.find.aportlist');
    Route::get('find-aportlist-dom', [AirportController::class, 'findAportListDom'])->name('airports.find.aportlist.dom');
    Route::get('multi-airport-actual', [AirportController::class, 'multiAirportActual'])->name('airports.multi.airport.actual');
    Route::get('multi-country-actual', [AirportController::class, 'multiCountryActual'])->name('airports.multi.country.actual');
    Route::get('multi-region-actual', [AirportController::class, 'multiRegionActual'])->name('airports.multi.region.actual');
    Route::get('pagecontrol', [AirportController::class, 'pageControl'])->name('airports.pagecontrol');
    Route::get('region-forecasts-multi', [AirportController::class, 'regionForecastsMulti'])->name('airports.region.forecasts.multi');
    Route::get('regionlist', [AirportController::class, 'regionList'])->name('airports.regionlist');
    Route::get('bigdownload-alertbox', [AirportController::class, 'theBigDownloadRestrictionAlertbox'])->name('airports.bigdownload.alertbox');
});

Route::middleware([AuthenticateLoginApp::class])->prefix('csvpages')->group(function () {
Route::post('airportactuals_lot_csv', [CsvpagesController::class, 'airportactuals_lot_csv'])->name('airportactuals_lot_csv.download');

});