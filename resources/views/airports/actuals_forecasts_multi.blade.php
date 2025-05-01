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
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
           <tr>
              <td align="center" class="emmahelveticaa26darkgrey">Airport Forecasts | Multi-Selector</td>
            </tr>
            <tr>
              <td height="10" align="center" class="emmahelveticaa18darkgreylight"></td>
            </tr>
            <tr>
              <td align="center" class="emmahelveticaa18darkgreylight"><table width="100%" border="0">
                <tr>
                  <td width="5%">&nbsp;</td>
                  <td width="90%" align="center" class="emmahelveticaa16darkgreylight">Use the panel below to make easy multi-selections, using an airport as a basis. You can use this tool to select multiple airports, and then decide the years you want to profile for forecasts</td>
                  <td width="5%">&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
				<div class="emmahelveticaa16darkgreylight" style="text-align:center;">Give it a go!</div>  
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
				<div class="emmahelveticaa16darkgreylight" style="text-align:center;">SELECT UP TO 10 AIRPORTS:</div>  
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            
			<tr>
			  <td align="center"><div class="pageCompare pageMulti" style="padding-top:0;">
				  <div class="compare_cont_left">
					<div class="search_drop"> 
					  <input type="search" name="search" placeholder="Search airport list" id="search">
					  <div id="suggesstion-box"></div>
					</div>
					<select class="comp_multi_select" id="airport_list" size="17">
              @foreach($airports as $airport)
                  <option value="{{ $airport->apname }}; {{ $airport->id_ap }}">{{ $airport->apname }}</option>
              @endforeach
          </select>
				  </div>
				  <div class="compare_cont_right">
					<div class="emmahelveticaa16darkgreybold" style="text-align: left;">SELECTED</div>
					<div class="compare_selected_airport" id="menu" style="height: 311px;">
					  <ul id="selectedlist">
					  </ul>
					</div>
					<div class="emmahelveticaa15darkgrey no_airp">No. of Airports: <span id="nmbr">0</span></div>
				  </div>
				</div>
				<div class="pageCompare pageMulti" style="padding-top:0;">
				  <div class="emmahelveticaa16darkgrey" style="margin-bottom:20px;">SELECT ONE/MORE YEARS:</div>
          @php
            $startYear = date('Y') - 10;
            $endYear = date('Y') + 15;
          @endphp
          @for ($year = $startYear; $year <= $endYear; $year++)
              <label class="btn btn-default yearsel">
                  <input type="checkbox" id="{{ $year }}" class="check_airport" value="{{ $year }}">
                  {{ $year }}
              </label>
          @endfor

          <div class="row">
          <form id="formdown1" name="formdown1" method="post" action="{{ route('airports.compareairports_forecasts') }}">
						@csrf
						<input class="btn_download" id="btnCrtDownload" style="width: 260px;" type="button" value="CREATE DOWNLOAD"  disabled="disabled">
						<input type="hidden" id="airportlist" name="airportlist" value="">
						<input type="hidden" id="airportlistsendto" name="airportlistsendto" value="">
						<input type="hidden" id="dataset" name="dataset" value="">										
						<input type="hidden" name="viewname" id="viewname" value="Airport Forecasts View">
					</form>
          </div>
				</div>
				</td>
			</tr>

            <tr>
              <td>&nbsp;</td>
            </tr>            
            <tr>
              <td>&nbsp;</td>
            </tr>
            </table>
        </div></td>
        </tr>
      </table></td>
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
  <!-- Modal -->
<div class="modal fade" id="popUp" tabindex="-1" role="dialog" aria-labelledby="downloadLimitModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Download Limit Reached</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You have reached the maximum number of downloads allowed for today.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

  @endsection
  @section('scripts')
 
  <script type="text/javascript">	
	$("#btnCrtDownload").on("click", function(e) {
    var getid = {{ Auth::guard('loginapp')->check() ? Auth::guard('loginapp')->user()?->login_id : 'null' }};
    var viewid = "Airport Forecasts View";
    var view_id = 8;

    $.ajax({
        type: "POST",
        url: "{{ route('airports.alertboxallairportview') }}",
        data: {
            data: getid,
            dataview: viewid,
            dataview_id: view_id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data){
          if(data != 0 && data >= 5) {
              $('#popUp').trigger('show'); // <-- Is this popup correctly configured?
          } else {
              $('#formdown1').submit();
          }
      }
    });
});

	
	</script>
   <script type="text/javascript">
  $("#search").keyup(function(){
    var search_keyword_value = $(this).val();
    if(search_keyword_value != ''){
      $.ajax({
        type: "POST",
        url: "{{ route('airports.search') }}",
        data: 'keyword=' + $(this).val(),
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
        beforeSend: function(){
          $("#search").css("background","#FFF");
        },
        success: function(data){
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(data);
          $("#search").css("background","#FFF");
        }
      });
    } else {
      $("#suggesstion-box").hide();
    }
  });

  $(document).on('click','label.btn [type="checkbox"]', function(){
    $(this).parent().toggleClass('active');
  });
</script>
<script type="text/javascript">
$( document ).ready(function() {
   enableDownload();
});

    var str_assign="";
	var arr=[];
	var str_hidden="";
	    function enableDownload(){  
        if(dataarr.length >0 && arr.length >0){
            $('#btnCrtDownload').prop('disabled', false);
        }else{
            $('#btnCrtDownload').prop('disabled', true);            
        }
    }
	
	function selectAirport(val) {
			 $("#search").val(val);
		     $("#suggesstion-box").hide();
	 		 if(arr.indexOf(val) == -1 )
			 {
				arr.push(val);
				$('#selectedlist').append("<li>"+val+"<span><i class='fa fa-close'></i></span></li>");
			 }	
			
			str_assign="'"+arr[0]+"'";				
			for(i=1;i<arr.length;i++)		
            {
                str_assign = str_assign+','+"'"+arr[i]+"'";
            }
		    $('#airportlist').val(str_assign);
			$("#search").val('');
			$("#suggesstion-box").hide();
            enableDownload();
		}

	
	

$(document).on('click','#airport_list option', function(){
			var val = $(this).val();        // whole text			
			var valtxt = $(this).text();
			
			var text_slct_combo=val.split(';');
			var text_slct=text_slct_combo[1].trim();
			
			if(arr.indexOf(valtxt) == -1)
             {
				 if ( $('#menu ul li').size() <= 9 && $('#menu ul li').size() >= 0) 
					{
					   if(arr.indexOf(valtxt) != -1)
						{
							var indx = arr.indexOf(valtxt);
							arr.splice(indx,1);
						}
						else 
						{
							$('#selectedlist').append("<li>"+valtxt+"<span><i class='fa fa-close'></i></span></li>");
							arr.push(valtxt);
							$('#nmbr').text($('#menu ul li').size() );
							enableDownload();
						}
							str_assign="'"+arr[0]+"'";
							for(i=1;i<arr.length;i++)		
							{
								str_assign = str_assign+','+"'"+arr[i]+"'";
							}
							//alert("string"+str_assign);   // only jracode
							$('#airportlist').val(str_assign);
							//console.log($('#airportlist').val()); 
					}
					else{
						//alert("Please select up to 10 airports");
						$("#btn_trigger").trigger("click");
					} 
		     }
			 else{
				 alert("Allready Exists");
			 }
			
});

	
	  	$(document).on("click", "#aport-list li", function(){
		   if ( $('#menu ul li').size() <= 9 && $('#menu ul li').size() >= 0) 
           {
				 var valueList = $(this).text().trim();
				 if($(this).hasClass('active') != true)
				  {
					  //alert(valueList) ;
					  selectAirport(valueList);
					  $(this).addClass('active');
				  }
				$("#search").val('');
				$('#nmbr').text($('#menu ul li').size() );
				enableDownload();
		   }else{
				alert("You select only 10 Airports");
               }   
           		   
        });	
	
	
	
	  	$(document).on("click","#selectedlist li", function () {
		var textaport= $(this).text();
		
		for(i=0;i<arr.length;i++)
		{
			if(textaport == arr[i])
			{
				arr.splice(i,1);
			}
		}
		str_assign="'"+arr[0]+"'";
		for(i=1;i<arr.length;i++)		
		{
			str_assign = str_assign+','+"'"+arr[i]+"'";
		}
		//alert(str_assign);
		$('#airportlist').val(str_assign);
		$(this).closest("li").remove(); 
		$('#nmbr').text($('#menu ul li').size() );
        enableDownload();
		
	}); 
	
</script>




<script>
    var str_hidden_aport = '';
    var counter_aport = 0;
	var dataarr=[];
	var datastr_assign="";
    $(document).on("click",".check_airport", function () {
        counter_aport = counter_aport + 1;
        var text_slct_aport=$(this).val();

        //alert(text_slct_aport);

        if(dataarr.indexOf(text_slct_aport) != -1)
        {
            //alert("exists");
            var indx = dataarr.indexOf(text_slct_aport);
            dataarr.splice(indx,1);
        }
        else /* if(dataarr.indexOf(text_slct_aport) === -1) */
        {
            //alert("Fresh values" + text_slct_aport);
            dataarr.push(text_slct_aport);
        }
         //alert(dataarr);
        datastr_assign=dataarr[0];
        for(i=1;i<dataarr.length;i++)		
        {
            datastr_assign = datastr_assign+', '+dataarr[i];
        }
        $('#dataset').val(datastr_assign); 
        
        enableDownload();
		   
    }); 
</script>
  @endsection
 