<div class="grey_container">
                            <p class="emmahelveticaa22darkgrey">
                                <span id="annualforecasts2">{{ $forecastType }}</span> City Selection
                            </p>

                            <div class="nati_form_container nati_form_container2">
                                <div class="form_colmn full_form_colmn">
                                    <div class="form_field">
                                        Year(s):

                                        <div class="btn-group air_btn_group air_btn_group_check" id="annualforecasts2_check" data-toggle="buttons">
                                            @foreach(range($cY, $cY + $year_count - 1) as $i)
                                            <label class="btn btn-default yearselcity">
                                                <input type="checkbox" name="box2" class="check_airport cityChk" autocomplete="off" value="{{ $i }}">
                                                {{ $i }}
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="nati_form_container">
                                <form id="form21{{ $forecastType }}" name="form1" class="form4" method="post" action="{{ route('airports.airportsforecastscity') }}">
                                    @csrf
                                    <div class="form_colmn">
                                        <div class="form_field">
                                            City with multiple airports:
                                            <select name="searchField_selcity" class="a-10-b-listmenu250bl" id="searchField_selcity">
                                                @foreach($multicities as $city)
                                                <option value="{{ $city->id_city }}">{{ $city->cityname }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <input type="hidden" name="foo3" id="foo3" class="hiddncity" />
                                        <input type="hidden" name="sel1" id="sel1" class="airsel" value="{{ $forecastType }}" />

                                        <div class="form_field">
                                            <button name="form1" type="submit" class="headsubmitgrey btnForm2" id="btn_form21" value="form1">Submit <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </div>
                                </form>

                                <div class="form_colmn">
                                    <div class="form_field_or ln_h_80"><strong>OR</strong></div>
                                </div>

                                <form id="form22{{ $forecastType }}" name="form2" class="form5" method="post" action="{{ route('airports.airportsforecastscity') }}">
                                    @csrf
                                    <div class="form_colmn">
                                        <div class="form_field"> All Cities:
                                            <select name="searchField_selcity" class="a-10-b-listmenu250bl" id="searchField_selcity">
                                                @foreach($cities as $city)
                                                <option value="{{ $city->id_city }}">{{ $city->cityname }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <input type="hidden" name="foo3" id="foo3" class="hiddncity" />
                                        <input type="hidden" name="sel1" id="sel1" class="airsel" value="{{ $forecastType }}" />

                                        <div class="form_field">
                                            <button name="form2" type="submit" class="headsubmitgrey btnForm2" id="btn_form22" value="form2">Submit <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>