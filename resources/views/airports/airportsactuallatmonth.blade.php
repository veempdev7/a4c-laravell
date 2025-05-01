@extends('layouts.app')

@section('content')
<div id="container">
    <table width="100%" border="0">
        <tr>
            <td>@include('includes.header')</td>
        </tr>
        @include('includes.airports.header')

        <tr>
            <td align="center" class="emmahelveticaa26darkgrey">Airport Actuals | Which is the latest month?</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td align="center" class="emmahelveticaa17darkgrey">
                Use this section to understand which month is the the latest for an airport.
            </td>
        </tr>
        <tr><td height="10"></td></tr>

        {{-- INTERNATIONAL DATA --}}
        <tr>
            <td align="left" class="emmahelveticaa17darkgrey">
                <div class="mlr_6_per">INTERNATIONAL DATA</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="mlr_6_per">
                    <table cellspacing="2" border="0" class="blue_table">
                        <tr>
                            <td colspan="2" width="65%">
                                <div class="blue_box">
                                    <input type="text" class="btn_link" id="aportcodeinternational" placeholder="Type an airport code">
                                    <p class="emmahelveticaa16darkgrey">LATEST MONTH'S ACTUALS DECLARED</p>
                                    <h3><span id="code_int"></span> <span id="monthname"></span> <span id="aport_year"></span></h3>
                                </div>
                            </td>
                            <td width="35%">
                                <div class="blue_box">
                                    <p class="emmahelveticaa16darkgrey">
                                        NO. OF AIRPORTS WHO HAVE DECLARED FOR <strong>{{ $full_month }} {{ $full_year }}</strong>
                                    </p>
                                    <h2><span id="total_prev_aport">{{ $total_aport_count }}</span></h2>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <div class="blue_box">
                                    <select id="monthoption" name="monthoption" onchange='$("#monthvalue").val(this.value);'>
                                        @foreach($dlupThreeMonths as $month)
                                            <option value="{{ $month->dlup_monthtxt }}">{{ $month->dlup_monthtxt }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="monthvalue" id="monthvalue">
                                    <p class="emmahelveticaa16darkgrey">
                                        AIRPORTS | DECLARED FOR <strong><span id="selected_month"></span> <span id="selected_year"></span></strong>
                                    </p>
                                    <div class="contentnn demo-yx" id="scroll">
                                        <ul class="airp_vert_list" id="airplist_inter"><li>AAL</li></ul>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" width="65%">
                                <div class="blue_box">
                                    <p class="emmahelveticaa16darkgrey mb_50">
                                        AIRPORTS | DECLARED FOR<br /><strong>A MONTH WITHIN THE LAST 6 MONTHS</strong>
                                    </p>
                                    <p class="emmahelveticaa16darkgrey mb_50">No. of Airports: {{ $totalnum_rows_sixaportname }}</p>
                                    <div class="contentnn demo-yx" id="scroll2">
                                        <ul class="airp_hori_list">
                                            @foreach($sixMonthAirports as $airport)
                                                <li>
                                                    <a href="{{ url('/airports/airportsactualsint_lat.php?id=' . $airport->jracode) }}" id="{{ $airport->jracode }}">
                                                        {{ $airport->jracode }}
                                                    </a>;
                                                    {{ $airport->dlup_monthtxt }} {{ $airport->dlup_year }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>

        {{-- TOTAL DATA --}}
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td align="left" class="emmahelveticaa17darkgrey">
                <div class="mlr_6_per">TOTAL DATA</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="mlr_6_per">
                    <table cellspacing="2" border="0" class="blue_table">
                        <tr>
                            <td colspan="2" width="65%">
                                <div class="blue_box">
                                    <input type="text" class="btn_link" id="aportcodetotal" placeholder="Type an airport code">
                                    <p class="emmahelveticaa16darkgrey">LATEST MONTH'S ACTUALS DECLARED</p>
                                    <h3><span id="code_dom"></span> <span id="monthname_dom"></span> <span id="aport_year_dom"></span></h3>
                                </div>
                            </td>
                            <td width="35%">
                                <div class="blue_box">
                                    <p class="emmahelveticaa16darkgrey">
                                        NO. OF AIRPORTS WHO HAVE DECLARED FOR <strong>{{ $full_month }} {{ $full_year }}</strong>
                                    </p>
                                    <h2><span id="total_prev_aport_dom">{{ $total_aport_count_dom }}</span></h2>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <div class="blue_box">
                                    <select id="monthoption_dom" name="monthoption_dom" onchange='$("#monthvalue_dom").val(this.value);'>
                                        @foreach($dlupThreeMonthsDom as $month)
                                            <option value="{{ $month->dlup_monthtxt }}">{{ $month->dlup_monthtxt }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="monthvalue_dom" id="monthvalue_dom">
                                    <p class="emmahelveticaa16darkgrey">
                                        AIRPORTS | DECLARED FOR <strong><span id="selected_month_dom"></span> <span id="selected_year_dom"></span></strong>
                                    </p>
                                    <div class="contentnn demo-yx" id="scroll3">
                                        <ul class="airp_vert_list" id="airplist_dom"><li>AAL</li></ul>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" width="65%">
                                <div class="blue_box">
                                    <p class="emmahelveticaa16darkgrey mb_50">
                                        AIRPORTS | DECLARED FOR<br /><strong>A MONTH WITHIN THE LAST 6 MONTHS</strong>
                                    </p>
                                    <p class="emmahelveticaa16darkgrey mb_50">No. of Airports: {{ $totalnum_rows_sixaportname_dom }}</p>
                                    <div class="contentnn demo-yx" id="scroll4">
                                        <ul class="airp_hori_list">
                                            @foreach($sixMonthAirportsDom as $airport)
                                                <li>
                                                    <a href="{{ url('/airports/airportsactualstot_lat.php?id=' . $airport->jracode) }}" id="{{ $airport->jracode }}">
                                                        {{ $airport->jracode }}
                                                    </a>;
                                                    {{ $airport->dlup_monthtxt }} {{ $airport->dlup_year }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>

        {{-- FOOTER --}}
        <tr>
            <td>
                <table width="100%" border="0" bgcolor="#E1E1E1">
                    <tr>
                        <td>
                            <div align="center">
                                <table width="1000" border="0">
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" bgcolor="#54545E">
                                                <tr><td>&nbsp;</td></tr>
                                                <tr><td height="10"></td></tr>
                                                <tr><td>@include('includes.footer')</td></tr>
                                                <tr><td>&nbsp;</td></tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script>
	(function($){
		$(window).on("load",function(){						
			$(".demo-yx").mCustomScrollbar({
				axis:"yx" 
			});
		});
	})(jQuery);
</script>
<script type="text/javascript">
    $(document).ready(function () {
        const fullYear = {{ $full_year }};
        const csrfToken = '{{ csrf_token() }}';

        // Set CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        // Default load for international
        let monthval = $('#monthoption :selected').text();
        $.post("{{ route('airports.find_aportlist') }}", {
            keyword: monthval,
            curyear: fullYear
        }, function (data) {
            $("#airplist_inter").html(data);
            $("#selected_month").html(monthval);
            $("#selected_year").html(fullYear);
        });

        // International code input
        $('#aportcodeinternational').keyup(function () {
            const aportcode_int = $(this).val();
            if (aportcode_int === "") {
                $('#code_int').text("");
                $("#aport_year").text("");
                $("#monthname").text("");
            } else {
                $('#code_int').text(aportcode_int.toUpperCase() + " ;");
                $.post("{{ route('airports.find_aportcode') }}", {
                    keyword: aportcode_int
                }, function (data) {
                    const x = data;
                    $("#aport_year").text(x.dlup_year);
                    $("#monthname").text(x.dlup_fullmontxt);
                });
            }
        });

        // International month change
        $('#monthoption').change(function () {
            let monthval = $('#monthvalue').val();
            $.post("{{ route('airports.find_aportlist') }}", {
                keyword: monthval,
                curyear: fullYear
            }, function (data) {
                $("#airplist_inter").html(data);
                $("#selected_month").html(monthval);
                $("#selected_year").html(fullYear);
            });
        });

        // Domestic code input
        $('#aportcodetotal').keyup(function () {
            const aportcode_dom = $(this).val();
            if (aportcode_dom === "") {
                $('#code_dom').text("");
                $("#aport_year_dom").text("");
                $("#monthname_dom").text("");
            } else {
                $('#code_dom').text(aportcode_dom.toUpperCase() + " ;");
                $.post("{{ route('airports.find_aportcode_dom') }}", {
                    keyword: aportcode_dom
                }, function (data) {
                    const x = data;
                    $("#aport_year_dom").text(x.dlup_year);
                    $("#monthname_dom").text(x.dlup_fullmontxt);
                });
            }
        });

        // Domestic month change
        $('#monthoption_dom').change(function () {
            let monthval = $('#monthvalue_dom').val();
            $.post("{{ route('airports.find_aportlist_dom') }}", {
                keyword: monthval,
                curyear: fullYear
            }, function (data) {
                $("#airplist_dom").html(data);
                $("#selected_month_dom").html(monthval);
                $("#selected_year_dom").html(fullYear);
            });
        });

        // Load default domestic aport list
        let monthval_dom = $('#monthoption_dom :selected').text();
        $.post("{{ route('airports.find_aportlist_dom') }}", {
            keyword: monthval_dom,
            curyear: fullYear
        }, function (data) {
            $("#airplist_dom").html(data);
            $("#selected_month_dom").html(monthval_dom);
            $("#selected_year_dom").html(fullYear);
        });
    });
</script>


@endsection
