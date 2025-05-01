<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginAppController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AuthenticateLoginApp;
use App\Http\Controllers\Airport\AirportController;
use App\Http\Helpers\DownloadHelper;
use App\Http\Helpers\airports\AirportHelper;


Route::get('/', [LoginAppController::class, 'showLoginForm'])->name('loginapp.show');
Route::get('index', [LoginAppController::class, 'showLoginForm'])->name('loginapp.show');
Route::post('login', [LoginAppController::class, 'login'])->name('loginapp.login');



Route::middleware(AuthenticateLoginApp::class)->group(function () {
    Route::post('logout', [LoginAppController::class, 'logout'])->name('loginapp.logout');
    Route::get('welcome/welcomepage', [HomeController::class, 'index'])->name('home');
});

Route::middleware([AuthenticateLoginApp::class])->prefix('airports')->group(function () {
    Route::get('airportshome', [AirportController::class, 'airportshome'])->name('airports.airportshome');
    Route::get('actuals_forecasts_multi', [AirportController::class, 'actualsForecastMulti'])->name('airports.actuals.forecast.multi');
    Route::get('airport-actual-country-multi-comparedata', [AirportController::class, 'airportActualCountryMultiCompareData'])->name('airports.actual.country.multi.comparedata');
    Route::get('airport-actual-multi-comparedata', [AirportController::class, 'airportActualMultiCompareData'])->name('airports.actual.multi.comparedata');
    Route::get('airport-forecast-country-multi-comparedata', [AirportController::class, 'airportForecastCountryMultiCompareData'])->name('airports.forecast.country.multi.comparedata');
    Route::get('airport-forecasts-country-multi', [AirportController::class, 'airportForecastsCountryMulti'])->name('airports.forecasts.country.multi');
    Route::get('airportforecasts_multiselector', [AirportController::class, 'airportForecastsMultiSelector'])->name('airports.airportforecasts_multiselector');
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
    Route::post('airportsactualstot', [AirportController::class, 'airportsActualsTottest'])->name('airports.actuals.tottest');
    Route::get('actuals-tot-lat', [AirportController::class, 'airportsActualsTotLat'])->name('airports.actuals.tot.lat');
    Route::get('airportsforecasts', [AirportController::class, 'airportsForecasts'])->name('airports.airportsforecasts');
    Route::post('airportsforecastsairp', [AirportController::class, 'airportsForecastsAirp'])->name('airports.airportsforecastsairp');
    Route::get('forecasts-airpdl', [AirportController::class, 'airportsForecastsAirpdl'])->name('airports.forecasts.airpdl');
    Route::post('airportsforecastscity', [AirportController::class, 'airportsForecastsCity'])->name('airports.airportsforecastscity');
    Route::post('airportsforecastscountry', [AirportController::class, 'airportsForecastsCountry'])->name('airports.airportsforecastscountry');
    Route::get('forecasts-countrymulti', [AirportController::class, 'airportsForecastsCountryMulti'])->name('airports.forecasts.countrymulti');
    Route::post('airportsforecastsreg', [AirportController::class, 'airportsForecastsReg'])->name('airports.airportsforecastsreg');
    Route::post('airportsforecastsworlds', [AirportController::class, 'airportsForecastsWorld'])->name('airports.airportsforecastsworld');
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
    // Route::post('alertboxallairportview', [AirportController::class, 'alertBoxAllAirportView'])->name('airports.alertboxallairportview');
    Route::get('aportlists', [AirportController::class, 'aportLists'])->name('airports.aportlists');
    Route::get('aportlists-airports-actual', [AirportController::class, 'aportListsAirportsActual'])->name('airports.aportlists.airports.actual');
    Route::get('bigdown', [AirportController::class, 'bigDown'])->name('airports.bigdown');
    Route::post('compareairports_forecasts', [AirportController::class, 'compareAirportsForecasts'])->name('airports.compareairports_forecasts');
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
    Route::post('search', [AirportController::class, 'search'])->name('airports.search');
    Route::post('alertboxallairportview', function () {
        return response(DownloadHelper::checkDownloadLimit());
    })->name('airports.alertboxallairportview');

    // csv download using helpers
    Route::post('csvpages/airportsforecastsair1', function () {
        return AirportHelper::airportsforecastsair1();
    })->name('airports.csvpages.airportsforecastsair1');

    Route::post('csvpages/airportsforecastsair_singlemonth', function () {
        return AirportHelper::airportsforecastsair_singlemonth();
    })->name('airports.csvpages.airportsforecastsair_singlemonth');

    Route::post('csvpages/airportsforecastsair2', function () {
        return AirportHelper::airportsforecastsair2();
    })->name('airports.csvpages.airportsforecastsair2');

    Route::post('csvpages/airportsforecastsair_seasonal', function () {
        return AirportHelper::airportsforecastsair_seasonal();
    })->name('airports.csvpages.airportsforecastsair_seasonal');


    // City
    Route::post('csvpages/airportsforecastscity_annual', function () {
        return AirportHelper::airportsforecastscity_annual();
    })->name('airports.csvpages.airportsforecastscity_annual');
    
    Route::post('csvpages/airportsforecastscity_singlemonthly', function () {
        return AirportHelper::airportsforecastscity_singlemonthly();
    })->name('airports.csvpages.airportsforecastscity_singlemonthly');

    Route::post('csvpages/airportsforecastscity_quaterly', function () {
        return AirportHelper::exportCityQuarterlyForecast();
    })->name('airports.csvpages.airportsforecastscity_quaterly');

    Route::post('csvpages/airportsforecastscountry_annual', function () {
        return AirportHelper::exportCountryAnnualForecast();
    })->name('airports.csvpages.airportsforecastscountry_annual');

    Route::post('csvpages/airportsforecastscountry_singlemonthly', function () {
        return AirportHelper::exportCountryMonthlyForecast();
    })->name('airports.csvpages.airportsforecastscountry_singlemonthly');

    Route::post('csvpages/airportsforecastscountry_quarterly', function () {
        return AirportHelper::exportCountryQuarterlyForecast();
    })->name('airports.csvpages.airportsforecastscountry_quarterly');

    Route::post('csvpages/airportsforecastsreg_annual', function () {
        return AirportHelper::airportsforecastsreg_annual();
    })->name('airports.csvpages.airportsforecastsreg_annual');

    Route::post('csvpages/airportsforecastsreg_singlemonthly', function () {
        return AirportHelper::airportsforecastsreg_singlemonthly();
    })->name('airports.csvpages.airportsforecastsreg_singlemonthly');

    Route::post('csvpages/airportsforecastsreg_quaterly', function () {
        return AirportHelper::airportsforecastsreg_quaterly();
    })->name('airports.csvpages.airportsforecastsreg_quaterly');


    Route::post('csvpages/airportsforecastsworld_annual', function () {
        return AirportHelper::airportsforecastsworld_annual();
    })->name('airports.csvpages.airportsforecastsworld_annual');

    Route::post('csvpages/airportsforecastsworld_monthly', function () {
        return AirportHelper::airportsforecastsworld_monthly();
    })->name('airports.csvpages.airportsforecastsworld_monthly');


    Route::post('csvpages/airportsforecastsworld_singlemonthly', function () {
        return AirportHelper::airportsforecastsworld_singlemonthly();
    })->name('airports.csvpages.airportsforecastsworld_singlemonthly');

    Route::post('csvpages/airportsforecastsworld_quaterly', function () {
        return AirportHelper::airportsforecastsworld_quaterly();
    })->name('airports.csvpages.airportsforecastsworld_quaterly');


    
});



