<?php 
namespace App\Http\Helpers\airports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;


class AirportHelper
{
    public static function airportsforecastsair1()
    {
        $yearColumn = Session::get('yearselect');

        if (!$yearColumn) {
            abort(400, 'Year selection is missing.');
        }

        // Handle "searchField_selap" from POST (if any)
        if (request()->has('searchField_selap')) {
            Session::put('sess_idap', request('searchField_selap'));
        }

        $apId = Session::get('sess_idap', 0);

        if (!$apId) {
            abort(400, 'Airport ID missing.');
        }

        // Query database (conn_409mysql)
        $rows = DB::connection('db_con_409')
            ->table('xc_ann')
            ->select([
                'year_fcm as Year',
                'fc3 as International',
                'fc4 as Domestic',
                'fc5 as Total',
                'fc3_change',
                'fc4_change',
                'fc5_change'
            ])
            ->where('ap_id', $apId)
            ->whereIn('year_fcm', explode(',', $yearColumn))
            ->orderBy('year_fcm', 'ASC')
            ->get()
            ->toArray();

        // Set CSV headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="AnnualPassengers.csv"',
        ];

        $callback = function() use ($rows) {
            $output = fopen('php://output', 'w');
            // Write CSV headings
            fputcsv($output, ['Year', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change']);
            // Write data rows
            foreach ($rows as $row) {
                fputcsv($output, (array) $row);
            }
            fclose($output);
        };

        // Optionally you can log download history here (if you have similar logic)
        // self::logDownloadHistory();

        return response()->stream($callback, 200, $headers);
    }

    public static function airportsforecastsair_singlemonth()
    {
        $filename = 'Airport_Single_Monthly.csv';
        
        // Prepare headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        
        $callback = function() {
            $output = fopen('php://output', 'w');

            // Write header row
            fputcsv($output, [
                'Year', 'Month', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change'
            ]);

            // Read session values
            $yearColumn = session('yearselect');
            $yearArray = explode(',', trim($yearColumn));
            $firstYear = $yearArray[0] ?? '';

            $apId = session('sess_idap') ?? 0;
            $cM = session('sess_monref') ?? 0;

            if (!$apId || !$cM) {
                fclose($output);
                return;
            }

            // Build Query
            $rows = DB::connection('db_con_409')  // <--- assuming your 409mysql connection is setup
                ->select("
                    SELECT 
                        dlup.dlup_year AS Year,
                        dlup.dlup_monthtxt AS Month,
                        xa_mon.fc3 AS International,
                        xa_mon.fc4 AS Domestic,
                        xa_mon.fc5 AS Total,
                        xa_mon.fc3_change,
                        xa_mon.fc4_change,
                        xa_mon.fc5_change
                    FROM xa_mon
                    LEFT JOIN dlup ON dlup.id_dlup = xa_mon.dlup
                    WHERE xa_mon.ap_id = ?
                      AND xa_mon.dlup >= ? - 1
                      AND xa_mon.dlup <= ? + 10
                    ORDER BY xa_mon.dlup ASC
                ", [$apId, $cM, $cM]);

            foreach ($rows as $row) {
                fputcsv($output, (array) $row);
            }

            fclose($output);
        };

        // Return streamed response
        return response()->stream($callback, 200, $headers);
    }

    public static function airportsforecastsair2()
    {
        $filename = 'QuarterlyPassengers.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        
        $callback = function() {
            $output = fopen('php://output', 'w');

            // Write header
            fputcsv($output, [
                'Year', 'Q', 'International', 'Domestic', 'Total', 'Intnl change', 'Dom change', 'Total change'
            ]);

            // Read session values
            $yearColumn = session('yearselect');
            $apId = session('sess_idap') ?? 0;
            $cQ = session('sess_quartref') ?? 0; // I assume 'sess_quartref' same as $cQ in your PHP

            if (!$apId || !$cQ) {
                fclose($output);
                return;
            }

            // Build Query
            $rows = DB::connection('mysql_409')
                ->select("
                    SELECT 
                        xb_quart.year_fcm,
                        xb_quart.q_txt,
                        xb_quart.fc3,
                        xb_quart.fc4,
                        xb_quart.fc5,
                        xb_quart.fc3_change,
                        xb_quart.fc4_change,
                        xb_quart.fc5_change
                    FROM xb_quart
                    WHERE xb_quart.ap_id = ?
                      AND xb_quart.qlup >= ?
                      AND xb_quart.qlup <= ? + 19
                    ORDER BY xb_quart.qlup ASC
                ", [$apId, $cQ, $cQ]);

            foreach ($rows as $row) {
                fputcsv($output, (array) $row);
            }

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }

    public static function airportsforecastsair_seasonal()
    {
        $filename = 'airport_season.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        
        $callback = function() {
            $output = fopen('php://output', 'w');

            fputcsv($output, []);

            // Write the CSV header
            fputcsv($output, ['Month', 'Season %']);

            // Read session value
            $apId = session('sess_idap') ?? -1;

            if ($apId == -1) {
                fclose($output);
                return;
            }

            // Fetch data
            $rows = DB::connection('db_con_409')
                ->table('lupseason')
                ->select('montxt', 'season_lupseason')
                ->where('id_ap', $apId)
                ->orderBy('month_lupseas', 'asc')
                ->get();

            foreach ($rows as $row) {
                fputcsv($output, (array) $row);
            }

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }

    // City
    public static function airportsforecastscity_annual()
{
    $filename = 'city_fcast.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function() {
        $output = fopen('php://output', 'w');

        // CSV Header
        fputcsv($output, ['Year', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change']);

        $cityId = session('searchField_selcity') ?? -1;
        $yearColumn = session('yearselect') ?? '';

        if ($cityId == -1 || empty($yearColumn)) {
            fclose($output);
            return;
        }

        // Fetch Data
        $rows = DB::connection('db_con_409')
            ->table('xc_ann')
            ->selectRaw('year_fcm AS Year, fc3 AS International, fc4 AS Domestic, fc5 AS Total, fc3_change, fc4_change, fc5_change')
            ->where('city_id', $cityId)
            ->whereIn('year_fcm', explode(',', $yearColumn))
            ->orderBy('year_fcm', 'asc')
            ->get();

        foreach ($rows as $row) {
            fputcsv($output, (array) $row);
        }

        fclose($output);
    };

    return response()->stream($callback, 200, $headers);
}

public static function airportsforecastscity_singlemonthly()
{
    $filename = 'city_fcast_Monthly.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function() {
        $output = fopen('php://output', 'w');

        // CSV header
        fputcsv($output, [
            'Year', 'Month', 'Domestic', 'International', 'Total',
            'Int_change', 'Dom_change', 'Total_change'
        ]);

        // Get session values
        $cityId = session('searchField_selcity', -1);
        $cM = session('sess_monref', 0);

        if ($cityId == -1 || $cM == 0) {
            fclose($output);
            return;
        }

        // Fetch monthly data
        $rows = DB::connection('db_con_409')
            ->table('xa_mon')
            ->leftJoin('dlup', 'dlup.id_dlup', '=', 'xa_mon.dlup')
            ->select([
                'dlup.dlup_year as Year',
                'dlup.dlup_monthtxt as Month',
                'xa_mon.fc4 as Domestic',
                'xa_mon.fc3 as International',
                'xa_mon.fc5 as Total',
                'xa_mon.fc3_change',
                'xa_mon.fc4_change',
                'xa_mon.fc5_change',
            ])
            ->where('xa_mon.city_id', $cityId)
            ->whereBetween('xa_mon.dlup', [$cM - 1, $cM + 10])
            ->orderBy('xa_mon.dlup')
            ->get();

        foreach ($rows as $row) {
            fputcsv($output, [
                $row->Year,
                $row->Month,
                $row->Domestic,
                $row->International,
                $row->Total,
                $row->fc3_change,
                $row->fc4_change,
                $row->fc5_change
            ]);
        }

        fclose($output);
    };

    return response()->stream($callback, 200, $headers);
}

public static function exportCityQuarterlyForecast()
{
    $cityId = session('sess_city', 0); // Default to 0 if not set
    $currentQuarter = session('cQ') ?? 123; // Default to current quarter
    $baseUrl = config('app.url');

    // Fetch the forecast data
    $results = DB::connection('db_con_409')->select("
        SELECT 
            year_fcm, q_txt, fc3, fc4, fc5, 
            fc3_change, fc4_change, fc5_change 
        FROM xb_quart 
        WHERE city_id = ? 
          AND qlup >= ? 
          AND qlup <= ? 
        ORDER BY qlup ASC
    ", [$cityId, $currentQuarter, $currentQuarter + 19]);
    // CSV headers
    $headers = [
        'Content-Type' => 'text/csv; charset=utf-8',
        'Content-Disposition' => 'attachment; filename=City_quarter.csv',
    ];

    // Output CSV
    $callback = function () use ($results) {
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Year', 'Q', 'International', 'Domestic', 'Total', 'Intnl change', 'Dom change', 'Total change']);
        foreach ($results as $row) {
            fputcsv($output, [
                $row->year_fcm, $row->q_txt, $row->fc3, $row->fc4, $row->fc5,
                $row->fc3_change, $row->fc4_change, $row->fc5_change
            ]);
        }
        fclose($output);
    };

    return response()->stream($callback, 200, $headers);
}

public static function exportCountryAnnualForecast()
{
    $countryId = session('sess_ctry', 0); // Default to 0 if not set
    $yearColumn = session('yearselect', 2025); // Expecting array or comma-separated string
    $baseUrl = config('app.url');

    if (is_int($yearColumn)) {
        $yearColumn = [$yearColumn]; // wrap single int in an array
    } elseif (is_string($yearColumn)) {
        $yearColumn = array_map('trim', explode(',', $yearColumn)); // convert comma-separated string to array
    }

    $results = DB::connection('db_con_409')->table('xc_ann')
        ->select([
            'year_fcm as Year',
            'fc3 as International',
            'fc4 as Domestic',
            'fc5 as Total',
            'fc3_change as Int_change',
            'fc4_change as Dom_change',
            'fc5_change as Total_change'
        ])
        ->where('year_fcm', '>=', 2000)
        ->where('country_id', $countryId)
        ->whereIn('year_fcm', $yearColumn)
        ->orderBy('year_fcm')
        ->get();

    $headers = [
        'Content-Type' => 'text/csv; charset=utf-8',
        'Content-Disposition' => 'attachment; filename=Country_fcast.csv',
    ];

    $callback = function () use ($results) {
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Year', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change']);
        foreach ($results as $row) {
            fputcsv($output, [
                $row->Year, $row->International, $row->Domestic, $row->Total,
                $row->Int_change, $row->Dom_change, $row->Total_change
            ]);
        }
        fclose($output);
    };

    return response()->stream($callback, 200, $headers);
}

public static function exportCountryMonthlyForecast()
{
    $countryId = session('sess_ctry', 0);
    $monRef = session('sess_monref', 0);
    $cM = session('cM', 0);

    $results = DB::connection('db_con_409')->select("
        SELECT 
            dlup.dlup_year AS Year,
            dlup.dlup_monthtxt AS Month,
            xa_mon.fc3 AS International,
            xa_mon.fc4 AS Domestic,
            xa_mon.fc5 AS Total,
            xa_mon.fc3_change AS Int_change,
            xa_mon.fc4_change AS Dom_change,
            xa_mon.fc5_change AS Total_change
        FROM xa_mon
        LEFT JOIN dlup ON dlup.id_dlup = xa_mon.dlup
        WHERE xa_mon.country_id = ?
          AND xa_mon.dlup >= ?
          AND xa_mon.dlup <= ?
        ORDER BY xa_mon.dlup ASC
    ", [$countryId, $cM - 1, $cM + 10]);

    $headers = [
        'Content-Type' => 'text/csv; charset=utf-8',
        'Content-Disposition' => 'attachment; filename=Country_fcast_Monthly.csv',
    ];

    $callback = function () use ($results) {
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Year', 'Month', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change']);
        foreach ($results as $row) {
            fputcsv($output, [
                $row->Year,
                $row->Month,
                $row->International,
                $row->Domestic,
                $row->Total,
                $row->Int_change,
                $row->Dom_change,
                $row->Total_change
            ]);
        }
        fclose($output);
    };

    return response()->stream($callback, 200, $headers);
}

public static function exportCountryQuarterlyForecast()
{
    $countryId = session('sess_ctry', 0);
    $cQ = session('cQ', 0); // assuming cQ is quarter lookup base value
    $results = DB::connection('db_con_409')->select("
        SELECT 
            year_fcm AS Year,
            q_txt AS Quarter,
            fc3 AS International,
            fc4 AS Domestic,
            fc5 AS Total,
            fc3_change AS Int_change,
            fc4_change AS Dom_change,
            fc5_change AS Total_change
        FROM xb_quart
        WHERE country_id = ?
          AND qlup >= ?
          AND qlup <= ?
        ORDER BY qlup ASC
    ", [$countryId, $cQ, $cQ + 19]);

    $headers = [
        'Content-Type' => 'text/csv; charset=utf-8',
        'Content-Disposition' => 'attachment; filename=Country_quarter.csv',
    ];

    $callback = function () use ($results) {
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Year', 'Quarter', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change']);

        foreach ($results as $row) {
            fputcsv($output, [
                $row->Year,
                $row->Quarter,
                $row->International,
                $row->Domestic,
                $row->Total,
                $row->Int_change,
                $row->Dom_change,
                $row->Total_change,
            ]);
        }

        fclose($output);
    };

    return response()->stream($callback, 200, $headers);
}

public static function airportsforecastsreg_annual()
{
    $regionId = session('sess_reg', 0);
    $yearColumn = session('yearselect', '');

    if (empty($yearColumn)) {
        abort(400, 'No year selected');
    }

    $yearValues = explode(',', $yearColumn);
    $placeholders = implode(',', array_fill(0, count($yearValues), '?'));

    $results = DB::connection('db_con_409')->select("
        SELECT 
            year_fcm AS Year,
            fc3 / 1000 AS International,
            fc4 / 1000 AS Domestic,
            fc5 / 1000 AS Total,
            fc3_change AS Int_change,
            fc4_change AS Dom_change,
            fc5_change AS Total_change
        FROM xc_ann
        WHERE year_fcm >= 2000
          AND region_id = ?
          AND year_fcm IN ($placeholders)
          AND fc_ident = 12
        ORDER BY year_fcm ASC
    ", array_merge([$regionId], $yearValues));

    $headers = [
        'Content-Type' => 'text/csv; charset=utf-8',
        'Content-Disposition' => 'attachment; filename=Region_fcast.csv',
    ];

    $callback = function () use ($results) {
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Year', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change']);

        foreach ($results as $row) {
            fputcsv($output, [
                $row->Year,
                $row->International,
                $row->Domestic,
                $row->Total,
                $row->Int_change,
                $row->Dom_change,
                $row->Total_change,
            ]);
        }

        fclose($output);
    };

    return response()->stream($callback, 200, $headers);
}
public static function airportsforecastsreg_singlemonthly()
{
    $regionId = session('sess_reg', 0);
    $cM = session('sess_monref', 0); // e.g., dlup reference value

    $results = DB::connection('db_con_409')->select("
        SELECT 
            dlup.dlup_year AS Year,
            dlup.dlup_monthtxt AS Month,
            xa_mon.fc3 / 1000 AS International,
            xa_mon.fc4 / 1000 AS Domestic,
            xa_mon.fc5 / 1000 AS Total,
            xa_mon.fc3_change AS Int_change,
            xa_mon.fc4_change AS Dom_change,
            xa_mon.fc5_change AS Total_change
        FROM xa_mon
        LEFT JOIN dlup ON dlup.id_dlup = xa_mon.dlup
        WHERE xa_mon.region_id = ?
          AND xa_mon.dlup >= ?
          AND xa_mon.dlup <= ?
        ORDER BY xa_mon.dlup ASC
    ", [$regionId, $cM - 1, $cM + 10]);

    $headers = [
        'Content-Type' => 'text/csv; charset=utf-8',
        'Content-Disposition' => 'attachment; filename=Region_fcast_Monthly.csv',
    ];

    $callback = function () use ($results) {
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Year', 'Month', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change']);

        foreach ($results as $row) {
            fputcsv($output, [
                $row->Year,
                $row->Month,
                $row->International,
                $row->Domestic,
                $row->Total,
                $row->Int_change,
                $row->Dom_change,
                $row->Total_change,
            ]);
        }

        fclose($output);
    };

    return response()->stream($callback, 200, $headers);
}
public static function airportsforecastsreg_quaterly()
{
    $regionId = session('sess_reg', 0);
    $cQ = session('cQ', 0); // quarter reference value (e.g., 202301)

    $results = DB::connection('db_con_409')->select("
        SELECT 
            year_fcm AS Year,
            q_txt AS Q,
            fc3 AS International,
            fc4 AS Domestic,
            fc5 AS Total,
            fc3_change AS Int_change,
            fc4_change AS Dom_change,
            fc5_change AS Total_change
        FROM xb_quart
        WHERE region_id = ?
          AND qlup >= ?
          AND qlup <= ?
        ORDER BY qlup ASC
    ", [$regionId, $cQ, $cQ + 19]);

    $headers = [
        'Content-Type' => 'text/csv; charset=utf-8',
        'Content-Disposition' => 'attachment; filename=Region_quarter.csv',
    ];

    $callback = function () use ($results) {
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Year', 'Q', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change']);

        foreach ($results as $row) {
            fputcsv($output, [
                $row->Year,
                $row->Q,
                $row->International,
                $row->Domestic,
                $row->Total,
                $row->Int_change,
                $row->Dom_change,
                $row->Total_change,
            ]);
        }

        fclose($output);
    };

    return response()->stream($callback, 200, $headers);
}


public static function airportsforecastsworld_annual()
{
    $regionId = session('sess_reg', 0);
    $yearColumn = session('yearselect', '');

    // If year selection is empty, prevent SQL errors
    if (empty($yearColumn)) {
        abort(400, 'No year selected.');
    }

    $query = "
        SELECT 
            xc_ann.year_fcm AS Year,
            xc_ann.fc3 / 1000 AS International,
            xc_ann.fc4 / 1000 AS Domestic,
            xc_ann.fc5 / 1000 AS Total,
            xc_ann.fc3_change AS Int_change,
            xc_ann.fc4_change AS Dom_change,
            xc_ann.fc5_change AS Total_change
        FROM xc_ann
        WHERE xc_ann.year_fcm >= 2000
          AND xc_ann.region_id = ?
          AND xc_ann.year_fcm IN ($yearColumn)
        ORDER BY xc_ann.year_fcm ASC
    ";

    $results = DB::connection('db_con_409')->select($query, [$regionId]);

    $headers = [
        'Content-Type' => 'text/csv; charset=utf-8',
        'Content-Disposition' => 'attachment; filename=Region_fcast.csv',
    ];

    $callback = function () use ($results) {
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Year', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change']);

        foreach ($results as $row) {
            fputcsv($output, [
                $row->Year,
                $row->International,
                $row->Domestic,
                $row->Total,
                $row->Int_change,
                $row->Dom_change,
                $row->Total_change,
            ]);
        }

        fclose($output);
    };

    return response()->stream($callback, 200, $headers);
}

public static function airportsforecastsworld_monthly()
{
        // Get session data
        $regionId = session('sess_reg', 0);
        $yearColumn = session('yearselect', '');

        // If year selection is empty, return a 400 response
        if (empty($yearColumn)) {
            abort(400, 'No year selected.');
        }

        // Parse years and sanitize
        $yearArray = array_filter(array_map('intval', explode(',', $yearColumn)));
        if (empty($yearArray)) {
            abort(400, 'Invalid year selection.');
        }
        $yearList = implode(',', $yearArray);

        // Set headers for CSV file download
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename=Region_fcast.csv',
        ];

        // Execute query to get forecast data
        $results = DB::connection('db_con_409')->select(
            "SELECT 
                year_fcm AS Year,
                fc3 / 1000 AS International,
                fc4 / 1000 AS Domestic,
                fc5 / 1000 AS Total,
                fc3_change AS Int_change,
                fc4_change AS Dom_change,
                fc5_change AS Total_change
            FROM xc_ann
            WHERE year_fcm >= 2000
                AND region_id = ?
                AND year_fcm IN ($yearList)
            ORDER BY year_fcm ASC",
            [$regionId]
        );

        // Callback for outputting CSV data
        $callback = function () use ($results) {
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Year', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change']);

            foreach ($results as $row) {
                fputcsv($output, [
                    $row->Year,
                    $row->International,
                    $row->Domestic,
                    $row->Total,
                    $row->Int_change,
                    $row->Dom_change,
                    $row->Total_change,
                ]);
            }

            fclose($output);
        };

        // Return CSV as a streamed response
        return response()->stream($callback, 200, $headers);
    }
    public static function airportsforecastsworld_singlemonthly()
    {
        // Get session data
        $regionId = session('sess_reg', 0);
        $monthRef = session('sess_monref', 0);
        $yearColumn = session('yearselect', '');
        
        // If year selection is empty, return a 400 response
        if (empty($yearColumn)) {
            abort(400, 'No year selected.');
        }

        // Parse years and sanitize
        $yearArray = array_filter(array_map('intval', explode(',', $yearColumn)));
        if (empty($yearArray)) {
            abort(400, 'Invalid year selection.');
        }
        $yearList = implode(',', $yearArray);

        // Set headers for CSV file download
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename=World_fcast.csv',
        ];

        // Query the database to get the forecast data
        $results = DB::connection('db_con_409')->select(
            "SELECT 
                dlup.dlup_year AS Year,
                dlup.dlup_monthtxt AS Month,
                xa_mon.fc3/1000 AS International,
                xa_mon.fc4/1000 AS Domestic,
                xa_mon.fc5/1000 AS Total,
                xa_mon.fc3_change AS Int_change,
                xa_mon.fc4_change AS Dom_change,
                xa_mon.fc5_change AS Total_change
            FROM xa_mon 
            LEFT JOIN dlup ON dlup.id_dlup = xa_mon.dlup
            WHERE xa_mon.region_id = ? 
                AND xa_mon.dlup >= ? 
                AND xa_mon.dlup <= ?
            ORDER BY xa_mon.dlup ASC",
            [$regionId, $monthRef - 1, $monthRef + 10]
        );

        // Callback function to output the CSV data
        $callback = function () use ($results) {
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Year', 'Month', 'International', 'Domestic', 'Total', 'Int_change', 'Dom_change', 'Total_change']);

            foreach ($results as $row) {
                fputcsv($output, [
                    $row->Year,
                    $row->Month,
                    $row->International,
                    $row->Domestic,
                    $row->Total,
                    $row->Int_change,
                    $row->Dom_change,
                    $row->Total_change,
                ]);
            }

            fclose($output);
        };

        // Return the CSV as a streamed response
        return response()->stream($callback, 200, $headers);
    }

    public static function airportsforecastsworld_quaterly()
    {
        // Get session data
        $regionId = session('sess_reg', 0); // Default to 0 if session is not set
        $yearColumn = session('yearselect', ''); // Default to empty if session is not set
        
        // If year selection is empty, return a 400 response
        if (empty($yearColumn)) {
            abort(400, 'No year selected.');
        }

        // Parse years and sanitize
        $yearArray = array_filter(array_map('intval', explode(',', $yearColumn)));
        if (empty($yearArray)) {
            abort(400, 'Invalid year selection.');
        }
        $yearList = implode(',', $yearArray);

        // Set headers for CSV file download
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename=World_quart.csv',
        ];

        // Query the database to get the forecast data
        $results = DB::connection('db_con_409')->select(
            "SELECT 
                xb_quart.year_fcm AS Year,
                xb_quart.q_txt AS Quarter,
                xb_quart.fc3/1000 AS International,
                xb_quart.fc4/1000 AS Domestic,
                xb_quart.fc5/1000 AS Total,
                xb_quart.fc3_change AS Intnl_change,
                xb_quart.fc4_change AS Dom_change,
                xb_quart.fc5_change AS Total_change
            FROM xb_quart
            WHERE xb_quart.region_id = ?
                AND xb_quart.year_fcm IN ($yearList)
            ORDER BY xb_quart.qlup ASC",
            [$regionId]
        );

        // Callback function to output the CSV data
        $callback = function () use ($results) {
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Year', 'Quarter', 'International', 'Domestic', 'Total', 'Intnl_change', 'Dom_change', 'Total_change']);

            foreach ($results as $row) {
                fputcsv($output, [
                    $row->Year,
                    $row->Quarter,
                    $row->International,
                    $row->Domestic,
                    $row->Total,
                    $row->Intnl_change,
                    $row->Dom_change,
                    $row->Total_change,
                ]);
            }

            fclose($output);
        };

        // Return the CSV as a streamed response
        return response()->stream($callback, 200, $headers);
    }

    public static function quicksum_worldsummary_csv()
{
    // Set headers for CSV file download
    $headers = [
        'Content-Type' => 'text/csv; charset=utf-8',
        'Content-Disposition' => 'attachment; filename=db_export__' . date('Y-m-d') . '.csv',
    ];

    $callback = function () {
        $output = fopen('php://output', 'w');

        fputcsv($output,[]);

        // Define regions with tables and columns
        $regions = [
            'Global International Passengers' => ['table' => 'latest_track3', 'columns' => ['montxt', 'datach']],
            'Africa International Passengers' => ['table' => 'latest_track3_afr', 'columns' => ['id', 'dlup', 'montxt', 'datach']],
            'Asia/Pacific International Passengers' => ['table' => 'latest_track3_asp', 'columns' => ['id', 'dlup', 'montxt', 'datach', 'year']],
            'Europe International Passengers' => ['table' => 'latest_track3_eur', 'columns' => ['id', 'dlup', 'montxt', 'datach']],
            'Latin America International Passengers' => ['table' => 'latest_track3_latam', 'columns' => ['id', 'dlup', 'montxt', 'datach']],
            'North America International Passengers' => ['table' => 'latest_track3_nam', 'columns' => ['id', 'dlup', 'montxt', 'datach']],
            'Middle East International Passengers' => ['table' => 'latest_track3_mea', 'columns' => ['id', 'dlup', 'montxt', 'datach']],
        ];

        foreach ($regions as $title => $info) {
            // Write region title and headers
            fputcsv($output, [$title]);
            fputcsv($output, $info['columns']);

            // Fetch rows from database
            $rows = DB::connection('db_con_latest')
                ->table($info['table'])
                ->select($info['columns'])
                ->orderBy('dlup')
                ->get();

            foreach ($rows as $row) {
                $data = [];
                foreach ($info['columns'] as $column) {
                    $data[] = $row->$column ?? '';
                }
                fputcsv($output, $data);
            }
        }

        fclose($output);
    };

    return response()->stream($callback, 200, $headers);
}

public static function one_airport_at_a_time_csv()
{
    $apcode = Session::get('sess_airport_sel');

    if (!$apcode) {
        abort(400, 'No airport selected in session.');
    }

    $data = DB::connection('db_con_latest')
    ->table('latest_act')
    ->selectRaw('dlup, dno, MAX(apcode) as apcode, MAX(apname) as apname, MAX(year) as year, MAX(montxt) as montxt, MAX(dname) as dname, MAX(pax) as pax')
    ->where('apcode', $apcode)
    ->where('year', '>', 2018)
    ->groupBy('dlup', 'dno')
    ->orderBy('dlup', 'asc')
    ->get();

    $csvData = [];
    $csvData[] = ['One Airport At a Time'];
    $csvData[] = [''];
    $csvData[] = ['Airport Actuals Passenger Numbers'];
    $csvData[] = [''];
    $csvData[] = ['One Airport Actuals'];
    $csvData[] = [''];
    $csvData[] = [Carbon::now()->format('m/d/Y')];
    $csvData[] = [''];
    $csvData[] = ['Airport', 'Year', 'Month', 'Data No', 'Pax 000'];

    foreach ($data as $row) {
        $csvData[] = [
            $row->apcode . ' :' . $row->apname,
            $row->year,
            $row->montxt,
            $row->dname,
            $row->pax,
        ];
    }

    $filename = 'Airport_Actuals__' . Carbon::now()->format('Y-m-d') . '.csv';

    return Response::stream(function () use ($csvData) {
        $handle = fopen('php://output', 'w');
        foreach ($csvData as $line) {
            fputcsv($handle, $line);
        }
        fclose($handle);
    }, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$filename}",
    ]);
}


}
