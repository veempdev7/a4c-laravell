<div class="grey_container">
                            <p class="emmahelveticaa22darkgrey">
                                <span id="annualforecasts4">{{ $forecastType }}</span> Region Selection
                            </p>

                            <div class="nati_form_container nati_form_container2">
                                <div class="form_colmn full_form_colmn">
                                    <div class="form_field">
                                        Year(s):
                                        <div class="btn-group air_btn_group air_btn_group_check" id="annualforecasts4_check" data-toggle="buttons">
                                            @for($i = $cY; $i <= $cY + $year_count - 1; $i++)
                                                <label class="btn btn-default yearselregion">
                                                <input type="checkbox" name="box4" class="check_airport regionChk" autocomplete="off" value="{{ $i }}">
                                                {{ $i }}
                                                </label>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="nati_form_container">
                                {{-- Form 1: Region Selection --}}
                                <form id="form41{{ $forecastType }}" name="form1" class="form8" method="POST" action="{{ route('airports.airportsforecastsreg') }}">
                                    @csrf
                                    <div class="form_colmn">
                                        <div class="form_field">
                                            Region:
                                            <select name="searchField_selreg" class="a-10-b-listmenu250bl" id="searchField_selreg">
                                                @foreach($regions as $region)
                                                <option value="{{ $region->id_region }}">{{ $region->regionname }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <input type="hidden" name="foo7" id="foo7" class="hiddnfldrgn" />
                                        <input type="hidden" name="sel3" id="sel3" class="airsel" value="{{ $forecastType }}" />

                                        <div class="form_field">
                                            <button name="form1" type="submit" class="headsubmitgrey btnForm4" id="btn_form41" value="form1">
                                                Submit <i class="fa fa-angle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="form_colmn">
                                    <div class="form_field_or ln_h_80"><strong>OR</strong></div>
                                </div>

                                {{-- Form 2: World Summary Option --}}
                                <form id="form42{{ $forecastType }}" name="form2" class="form9" method="POST" action="{{ route('airports.airportsforecastsworld') }}">
                                    @csrf
                                    <div class="form_colmn">
                                        <div class="form_field">
                                            &nbsp;
                                            <select name="searchField_selreg" class="a-10-b-3c63a2" id="searchField_selreg">
                                                <option value="7">World Summary</option>
                                            </select>
                                        </div>

                                        <input type="hidden" name="foo7" id="foo7" class="hiddnfldrgn" />
                                        <input type="hidden" name="sel3" id="sel3" class="airsel" value="{{ $forecastType }}" />

                                        <div class="form_field">
                                            <button name="form1" type="submit" class="headsubmitgrey btnForm4" id="btn_form42" value="form1">
                                                Submit <i class="fa fa-angle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>