<div class="grey_container">
                            <p class="emmahelveticaa22darkgrey"><span id="annualforecasts3">{{ $forecastType }}</span> Country Selection</p>
                            <div class="nati_form_container nati_form_container2">
                                <div class="form_colmn full_form_colmn">
                                    <div class="form_field">
                                        Year(s):
                                        <div class="btn-group air_btn_group air_btn_group_check" id="annualforecasts3_check" data-toggle="buttons">
                                            @for($i = $cY; $i <= $cY + $year_count - 1; $i++)
                                                <label class="btn btn-default yearselcntry">
                                                <input type="checkbox" name="years_country[]" class="check_airport countryChk" value="{{ $i }}"> {{ $i }}
                                                </label>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="nati_form_container">
                                <form id="form31{{ $forecastType }}" name="form6" class="form6" method="POST" action="{{ route('airports.airportsforecastscountry') }}">
                                    @csrf
                                    <div class="form_colmn">
                                        <div class="form_field">Region:
                                            <select name="selreg_forcountry" class="a-10-b-listmenu250bl" id="selreg_forcountry">
                                                @foreach($regions as $reg)
                                                <option value="{{ $reg->id_region }}">{{ $reg->regionname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form_field">Country:
                                            <select name="selected_ctry" class="a-10-b-listmenu250bl" id="selected_ctry">
                                                @foreach($countries as $ctry)
                                                <option value="{{ $ctry->id_country }}">{{ $ctry->countryname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="foo5" id="foo5" class="hiddnfldcntry" />
                                        <input type="hidden" name="sel2" id="sel2" class="airsel" value="{{ $forecastType }}" />
                                        <div class="form_field">
                                            <button name="form1" type="submit" class="headsubmitgrey btnForm3" id="btn_form31" value="form1">
                                                Submit <i class="fa fa-angle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="form_colmn">
                                    <div class="form_field_or ln_h_80"><strong>OR</strong></div>
                                </div>

                                <form id="form32{{ $forecastType }}" name="form7" class="form7" method="POST" action="{{ route('airports.airportsforecastscountry') }}">
                                    @csrf
                                    <div class="form_colmn">
                                        <div class="form_field">Country:
                                            <select name="selected_ctry" class="a-10-b-listmenu250bl" id="selected_ctry_all">
                                                @foreach($countries as $ctry)
                                                <option value="{{ $ctry->id_country }}">{{ $ctry->countryname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="foo5" id="foo5" class="hiddnfldcntry" />
                                        <input type="hidden" name="sel2" id="sel2" class="airsel" value="{{ $forecastType }}" />
                                        <div class="form_field">
                                            <button name="form2" type="submit" class="headsubmitgrey btnForm3" id="btn_form32" value="form2">
                                                Submit <i class="fa fa-angle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>