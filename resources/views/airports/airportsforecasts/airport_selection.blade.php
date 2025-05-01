<div class="grey_container">
    <p class="emmahelveticaa22darkgrey"><span id="annualforecasts1">{{ $forecastType }}</span> Airport Selection</p>
    <div class="nati_form_container nati_form_container2">
        <div class="form_colmn full_form_colmn">
            <div class="form_field">
                Year(s):
                <div class="btn-group air_btn_group air_btn_group_check" id="annualforecasts1_check" data-toggle="buttons">
                    @for($i = $cY; $i <= $cY + $year_count - 1; $i++)
                        <label class="btn btn-default yearsel">
                        <input type="checkbox" name="years[]" id="box{{ $i }}" class="check_airport year_check" value="{{ $i }}"> {{ $i }}
                        </label>
                        @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="nati_form_container">
        <form id="form11{{ $forecastType }}" class="form1" name="form1" method="POST" action="{{ route('airports.airportsforecastsairp') }}">
            @csrf
            <div class="form_colmn">
                <div class="form_field">Region:
                    <!-- <select name="searchField_selreg" class="a-10-b-listmenu250bl" id="searchField_selreg">
                        @foreach($regions as $row)
                        <option value="{{ $row->id_region }}">{{ $row->regionname }}</option>
                        @endforeach
                    </select> -->
                    <select id="searchField_selreg" name="searchField_selreg" data-target="monthly-regions"></select>
                </div>
                <div class="form_field">Country:
                     <select name="searchField_selctry" id="searchField_selctry" data-target="monthly-countries"></select>
                    <!-- <select name="searchField_selctry" class="a-10-b-listmenu120bl" id="searchField_selctry">
                        @foreach($countries as $row)
                        <option value="{{ $row->id_country }}">{{ $row->countryname }}</option>
                        @endforeach
                    </select> -->
                </div>
                <div class="form_field">City:
                    <select name="searchField_selcity" id="searchField_selcity" data-target="monthly-cities"></select>
                    <!-- <select name="searchField_selcity" class="a-10-b-listmenu120bl" id="searchField_selcity">
                        @foreach($cities as $row)
                        <option value="{{ $row->id_city }}">{{ $row->cityname }}</option>
                        @endforeach
                    </select> -->
                </div>
                <div class="form_field">Airport:
                    <select name="searchField_selap" id="searchField_selap" data-target="monthly-airports"></select>
                    <!-- <select name="searchField_selap" class="a-10-b-listmenu120bl" id="searchField_selap">
                        @foreach($airports as $row)
                        <option value="{{ $row->id_ap }}">{{ $row->apname }}</option>
                        @endforeach
                    </select> -->
                </div>
                <input type="hidden" name="foo" id="foo" class="hiddnannual" />
                <input type="hidden" name="sel" id="sel" class="airsel" value="{{ $forecastType }}" />
                <div class="form_field">
                <button type="submit" name="form1" class="headsubmitgrey btnForm1" id="btn_form11" value="form1">
                    Submit <i class="fa fa-angle-right"></i>
                </button>
                </div>
            </div>
        </form>
        <div class="form_colmn">
            <div class="form_field_or mt_mb_76"><strong>OR</strong></div>
        </div>
        <form id="form12{{ $forecastType }}" name="form2" class="form2" method="POST" action="{{ route('airports.airportsforecastsairp') }}">
            @csrf
            <div class="form_colmn">
                <div class="form_field mt_mb_122">IATA Code:
                    <select name="searchField_selap" class="a-10-b-listmenu250bl" id="searchField_selap">
                        @foreach($iata_codes as $row)
                        <option value="{{ $row->apid_apref }}">{{ $row->code_apref }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="foo" id="foo" class="hiddnannual" />
                <input type="hidden" name="sel" id="sel" class="airsel" value="{{ $forecastType }}" />
                <div class="form_field">
                <button name="form2" type="submit" class="headsubmitgrey btnForm1" id="btn_form12" value="form2">
                    Submit <i class="fa fa-angle-right"></i>
                </button>
                                    </div>
            </div>
        </form>
        <div class="form_colmn">
            <div class="form_field_or mt_mb_76"><strong>OR</strong></div>
        </div>
        <form id="form13{{ $forecastType }}" name="form3" class="form3" method="POST" action="{{ route('airports.airportsforecastsairp') }}">
            @csrf
            <div class="form_colmn">
                <div class="form_field mt_mb_122">Airport Name:
                    <select name="searchField_selap" class="a-10-b-listmenu250bl" id="searchField_selap">
                        @foreach($aprefs as $row_rst_apref)
                        <option value="{{ $row_rst_apref->apid_apref }}">{{ $row_rst_apref->aport_apref }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="foo" id="foo" class="hiddnannual" />
                <input type="hidden" name="sel" id="sel" class="airsel" value="{{ $forecastType }}" />
                <div class="form_field">
                    <button name="form3" type="submit" class="headsubmitgrey btnForm1" id="btn_form13" value="form3">
                        Submit <i class="fa fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

