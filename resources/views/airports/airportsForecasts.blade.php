@extends('layouts.app')

@section('content')
<div id="container">
    <!-- Display success or error message -->
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @elseif(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <table width="100%" border="0"> <!-- global table -->
        <tr>
            <td>
                @include('includes.header')
            </td>
        </tr>
        @include('includes.airports.header')
        <tr>
            <td align="center" class="emmahelveticaa26darkgrey">
                <span id="annualforecasts">Annual</span> Forecast {{ $cY }} - <span id="dynamicyear">{{ $cY + $year_count - 1 }}</span> Data search
            </td>
        </tr>
        <tr>
            <td height="10" align="center" class="emmahelveticaa18darkgreylight"></td>
        </tr>
        <tr>
            <td align="center" class="emmahelveticaa18darkgreylight">
                <table width="100%" border="0">
                    <tr>
                        <td width="3%">&nbsp;</td>
                        <td width="94%" align="center">
                            This section will produce air passenger forecasts by month for the airport, city, country or region you select and will open a summary page containing downloadable data and links to greater detail.<br />
                            For design simplicity, we have only included the next five years for monthly data, however if you need data further than this, we have it!<br />
                            Arriving plus departing passengers
                        </td>
                        <td width="3%">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <div class="grey_container">
                    <table>
                        <tr>
                            <td>
                                <p class="emmahelveticaa22darkgrey">Select Forecast Type :</p>
                            </td>
                            <td>
                                <div class="btn-group air_btn_group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="radio" name="forecast_type" id="forecast_type_annual" value="Annual" checked> Annual
                                    </label>
                                    <label class="btn btn-default" id="forecast_mth_btn">
                                        <input type="radio" name="forecast_type" id="forecast_type_monthly" value="Monthly" > Monthly
                                    </label>
                                </div>
                            </td>
                            <td>
                                <button type="button" id="submit-btn" class="headsubmitgrey grey_btn_sep">
                                    Submit <i class="fa fa-angle-right"></i>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>

            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <!-- Add a container to hold the content for each forecast type -->
                <div id="forecast-content">
                    <div id="annual-forecast" class="forecast-content">
                        <!-- Annual forecast content goes here -->
                        @include('airports.airportsforecasts.airport_selection', ['forecastType' => 'Annual'])
                        @include('airports.airportsforecasts.city_selection', ['forecastType' => 'Annual'])
                        @include('airports.airportsforecasts.country_selection', ['forecastType' => 'Annual'])
                        @include('airports.airportsforecasts.region_selection', ['forecastType' => 'Annual'])
                    </div>
                    <div id="monthly-forecast" class="forecast-content">
                        <!-- Monthly forecast content goes here -->
                        @include('airports.airportsforecasts.airport_selection', ['forecastType' => 'Monthly'])
                        @include('airports.airportsforecasts.city_selection', ['forecastType' => 'Monthly'])
                        @include('airports.airportsforecasts.country_selection', ['forecastType' => 'Monthly'])
                        @include('airports.airportsforecasts.region_selection', ['forecastType' => 'Monthly'])
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" bgcolor="#E1E1E1"> <!-- footer elastic table -->
                    <tr>
                        <td>
                            <div align="center">
                                <table width="1000" border="0"> <!-- footer fixed table -->
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" bgcolor="#54545E"> <!-- footer extra fixed table -->
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @include('includes.footer')
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
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

    @endsection
    @section('scripts')
    <script>
$(document).ready(function() {
  
  // --- Sample Data
  var regions = [
    { id: 1, name: "North America" },
    { id: 2, name: "South America" },
    { id: 3, name: "Europe" },
    { id: 4, name: "Asia" },
    { id: 5, name: "Africa" }
  ];

  var countries = [
    { id: 1, name: "United States", region_id: 1 },
    { id: 2, name: "Canada", region_id: 1 },
    { id: 3, name: "Mexico", region_id: 1 },
    { id: 4, name: "Brazil", region_id: 2 },
    { id: 5, name: "Nepal", region_id: 4 },
    { id: 87, name: "India", region_id: 4 }
  ];

  var cities = [
    { id: 1, name: "New York City", country_id: 1 },
    { id: 2, name: "Los Angeles", country_id: 1 },
    { id: 3, name: "Chicago", country_id: 1 },
    { id: 4, name: "Toronto", country_id: 2 },
    { id: 5, name: "Mexico City", country_id: 3 },
    { id: 200, name: "Mumbai", country_id: 87 },
    { id: 199, name: "New Delhi", country_id: 87 }
  ];

  var airports = [
    { id: 1, name: "John F. Kennedy International Airport", city_id: 1 },
    { id: 2, name: "Los Angeles International Airport", city_id: 2 },
    { id: 3, name: "O'Hare International Airport", city_id: 3 },
    { id: 4, name: "Toronto Pearson International Airport", city_id: 4 },
    { id: 5, name: "Mexico City International Airport", city_id: 5 },
    { id: 6, name: "Mumbai International Airport", city_id: 199 },
    { id: 402, name: "New Delhi International Airport", city_id: 199 }
  ];

  // --- Initially show Annual and hide Monthly
  $('#annual-forecast').show();
  $('#monthly-forecast').hide();

  // Initialize Region Dropdown for Annual forecast
  initializeRegionDropdown('Annual');

  // --- Submit button click
$('#submit-btn').on('click', function () {
  var selectedValue = $('input[name="forecast_type"]:checked').val();

  $('.forecast-content').hide();
  $(`#${selectedValue.toLowerCase()}-forecast`).show();

  initializeRegionDropdown(selectedValue);
});

// --- Function to populate dropdowns inside the correct form
function populateDropdown($dropdown, data) {
  $dropdown.empty().append(`<option value='0'>Select</option>`);
  $.each(data, function (index, value) {
    $dropdown.append(`<option value='${value.id}'>${value.name}</option>`);
  });
}

// --- Initialize region dropdown
function initializeRegionDropdown(forecastType) {
  if (forecastType === 'Annual') {
    populateDropdown($(`#form11${forecastType} #searchField_selreg`), regions);
  } else if (forecastType === 'Monthly') {
    populateDropdown($(`#form11${forecastType} [data-target='monthly-regions']`), regions);
  }
  clearChildDropdowns(forecastType);
}

// --- Clear all child dropdowns based on forecast type
function clearChildDropdowns(forecastType) {
  if (forecastType === 'Annual') {
    $(`#form11${forecastType} #searchField_selctry, #form11${forecastType} #searchField_selcity, #form11${forecastType} #searchField_selap`)
      .empty()
      .append(`<option value='0'>Select</option>`);
  } else if (forecastType === 'Monthly') {
    $(`#form11${forecastType} [data-target='monthly-countries'], #form11${forecastType} [data-target='monthly-cities'], #form11${forecastType} [data-target='monthly-airports']`)
      .empty()
      .append(`<option value='0'>Select</option>`);
  }
}

// --- Annual: Region -> Country
$(document).on('change', `#form11Annual #searchField_selreg`, function () {
  var form = $(this).closest('form');
  var selectedRegionId = $(this).val();

  form.find(`#searchField_selctry, #searchField_selcity, #searchField_selap`)
    .empty()
    .append(`<option value='0'>Select</option>`);

  var filteredCountries = countries.filter(c => c.region_id == selectedRegionId);
  populateDropdown(form.find(`#searchField_selctry`), filteredCountries);
});

// --- Monthly: Region -> Country
$(document).on('change', `#form11Monthly [data-target='monthly-regions']`, function () {
  var form = $(this).closest('form');
  var selectedRegionId = $(this).val();

  form.find(`[data-target='monthly-countries'], [data-target='monthly-cities'], [data-target='monthly-airports']`)
    .empty()
    .append(`<option value='0'>Select</option>`);

  var filteredCountries = countries.filter(c => c.region_id == selectedRegionId);
  populateDropdown(form.find(`[data-target='monthly-countries']`), filteredCountries);
});

// --- Annual: Country -> City
$(document).on('change', `#form11Annual #searchField_selctry`, function () {
  var form = $(this).closest('form');
  var selectedCountryId = $(this).val();

  form.find(`#searchField_selcity, #searchField_selap`)
    .empty()
    .append(`<option value='0'>Select</option>`);

  var filteredCities = cities.filter(c => c.country_id == selectedCountryId);
  populateDropdown(form.find(`#searchField_selcity`), filteredCities);
});

// --- Monthly: Country -> City
$(document).on('change', `#form11Monthly [data-target='monthly-countries']`, function () {
  var form = $(this).closest('form');
  var selectedCountryId = $(this).val();

  form.find(`[data-target='monthly-cities'], [data-target='monthly-airports']`)
    .empty()
    .append(`<option value='0'>Select</option>`);

  var filteredCities = cities.filter(c => c.country_id == selectedCountryId);
  populateDropdown(form.find(`[data-target='monthly-cities']`), filteredCities);
});

// --- Annual: City -> Airport
$(document).on('change', `#form11Annual #searchField_selcity`, function () {
  var form = $(this).closest('form');
  var selectedCityId = $(this).val();

  var filteredAirports = airports.filter(a => a.city_id == selectedCityId);
  populateDropdown(form.find(`#searchField_selap`), filteredAirports);
});

// --- Monthly: City -> Airport
$(document).on('change', `#form11Monthly [data-target='monthly-cities']`, function () {
  var form = $(this).closest('form');
  var selectedCityId = $(this).val();

  var filteredAirports = airports.filter(a => a.city_id == selectedCityId);
  populateDropdown(form.find(`[data-target='monthly-airports']`), filteredAirports);
});

// --- Forecast Type change
$('.airsel').on('change', function () {
  var selectedValue = $(this).val();
  $('#foo').val('');

  if (selectedValue === 'Monthly') {
    $('#annual-forecast').hide();
    $('#monthly-forecast').show();
  } else {
    $('#annual-forecast').show();
    $('#monthly-forecast').hide();
  }
});

// --- Form Submit for Annual
$('#btn_form11').on('click', function () {
  var year = [];
  $.each($(".year_check:checked"), function () {
    year.push($(this).val());
  });
  $('#foo').val(year.join(','));

  var formData = $(`#form11${selectedValue}`).serializeArray();
  console.log(formData);
  $(`#form11${selectedValue}`).submit();
});
});    
</script>

<script>
$(document).ready(function() {

    // Function to update hidden fields inside both annual and monthly sections
    function updateHiddenFields(hiddenClass, values) {
        $('#annual-forecast .' + hiddenClass).val(values.join(','));
        $('#monthly-forecast .' + hiddenClass).val(values.join(','));
    }


    // YEAR CHECKBOX
    $(document).on('change', '.year_check', function() {
        let selectedYears = [];
        $(".year_check:checked").each(function() {
            selectedYears.push($(this).val());
        });
        updateHiddenFields('hiddnannual', selectedYears);
    });

    // CITY CHECKBOX
    $(document).on('change', '.cityChk', function() {
        let selectedCities = [];
        $("input[name='box2']:checked").each(function() {
            selectedCities.push($(this).val());
        });
        updateHiddenFields('hiddncity', selectedCities);
    });

    // COUNTRY CHECKBOX
    $(document).on('change', '.countryChk', function() {
        let selectedCountries = [];
        $("input[name='box3']:checked").each(function() {
            selectedCountries.push($(this).val());
        });
        updateHiddenFields('hiddnfldcntry', selectedCountries);
    });

    // REGION CHECKBOX
    $(document).on('change', '.regionChk', function() {
        let selectedRegions = [];
        $("input[name='box4']:checked").each(function() {
            selectedRegions.push($(this).val());
        });
        updateHiddenFields('hiddnfldrgn', selectedRegions);
    });

    // Button Form Handlers
    function bindFormSubmitClick(buttonClass, activeClass) {
        $(document).on('click', buttonClass, function() {
            if (!$(`.${activeClass}`).hasClass('active')) {
                alert("Please Select Year!");
            } else {
                let formId = $(this).attr('id').split('_')[1];
                $('#' + formId).submit();
            }
        });
    }

    bindFormSubmitClick('.btnForm1', 'yearsel');
    bindFormSubmitClick('.btnForm2', 'yearselcity');
    bindFormSubmitClick('.btnForm3', 'yearselcntry');
    bindFormSubmitClick('.btnForm4', 'yearselregion');

});
</script>

    @endsection