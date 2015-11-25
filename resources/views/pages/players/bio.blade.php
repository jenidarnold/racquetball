@extends('pages.players.layout')

@section('style')
	<style type="text/css">
		.table-bio, tr{
			padding: 20px 20px 20px 20px;
		}
		.td-profile-head {
			font-weight: bold;
			padding: 5px 5px 5px 5px;
		}
		.td-stat {
			font-weight: 600;
			font-size: 12pt;
			padding-right: 5px;
			color: orangered;
		}
		.rankings{
			width: 100%;
			height: 200px;
			display:inline-block
		}

	</style>
	@parent
@stop

@section('title')
	Profile	
@stop
@section('menu')

@stop
@section('player-content')
<div class="row">
	<div class="col-md-12">				
		<div class="col-md-4">
			<div class="well">
				<table>								
					<tr>
	                    <td class="td-profile-head">National Rank:</td><td class="td-stat"> {{ $player->national_rank }}</td>
	                 </tr>
	                <tr>
	                    <td class="td-profile-head">State Rank:</td><td class="td-stat">{{ $player->state_rank}}</td>
	                </tr>
					<tr>
						<td class="td-profile-head">Tracking #:</td><td class="td-stat">{{ $player->tracking_id }}</td>
	                </tr>
	                <tr>
	                    <td class="td-profile-head">Tracking:</td><td class="td-stat">{{ $player->tracking }}</td>
	                </tr>				                
				</table>
			</div>							
		</div>
		<div class="col-md-4">
			<div class="well">
				<table>
					<tr>
						<td class="td-profile-head">Skill Level:</td><td class="td-stat">{{ $player->skill_level }}</td>
					</tr>
					<tr>
						<td class="td-profile-head">Racquet:</td><td class="td-stat">{{ $player->racquet }}</td>
					</tr>
					<tr>
						<td class="td-profile-head">Plays Left/Right:</td><td class="td-stat">{{ $player->handed }}</td>
					</tr>	
					<tr>
						<td class="td-profile-head">Sponsor:</td><td class="td-stat">{{ $player->sponsor}}</td>
					</tr>
				</table>
			</div>	
		</div>	
		<div class="col-md-4">
			<div class="well">
				<table>
					<tr>
						<td class="td-profile-head">Home:</td><td class="td-stat">{{ $player->home }}</td>
					</tr>
					<tr>
						<td class="td-profile-head">Gender:</td><td class="td-stat">{{ $player->gender }}</td>
					</tr>
				</table>
			</div>	
		</div>
	</div>				
</div>
<div class="row">
	<div class="col-md-12">				
		<div class="col-md-4">
			<div id="divNational" class="rankings"></div>
		</div>
		<div class="col-md-4">
			<div id="divState" class="rankings"></div>
		</div>
		<div class="col-md-4">
			<div id="divCompare" class="rankings"></div>
		</div>
	</div>
</div>	

@stop
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('/js/jchartfx/jchartfx.system.js')}}"></script>
    <script src="{{ asset('/js/jchartfx/jchartfx.coreVector.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//Vote Percentage color-code
			$('#li-profile').init(function(){	
				var el = $(this);
				el.addClass('active');
			});
							
	  		var player_id = {{ $player->player_id }};
	  		var location_id = {{ $player->state_id }};
	  		var gender = '{{ $player->gender }}';
	  		var group_id =1; //Male

	  		if (gender.toLowerCase() == 'female') {
	  			group_id =2;
	  		} 

	  		$.ajax({
	            url: '{{ URL::to('api/rankings/history') }}',
	            data: 'player_id=' + player_id + '&location_id=' + location_id + '&group_id=' + group_id,
	            type: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType : "json",
	            success: function (result) {
	               national = result["National"];
	               state = result["State"];
	               compare = result["Compare"];

	               $("div", ".divNational").init(function(){
				        chartNational = new cfx.Chart();
				        chartNational.setGallery(cfx.Gallery.Lines);		
						chartNational.getAxisY().getDataFormat().setFormat(cfx.AxisFormat.Number);
		          		var divHolder = document.getElementById('divNational');
		          		chartNational.setDataSource(national);
		          		chartNational.create(divHolder);
				    });

	               $("div", ".divState").init(function(){
				        chartState = new cfx.Chart();
				        chartState.setGallery(cfx.Gallery.Lines);
		          		var divHolder = document.getElementById('divState');
		          		chartState.setDataSource(state);
		          		chartState.create(divHolder);
				    });

	               $("div", ".divCompare").init(function(){
				        chartCompare = new cfx.Chart();
				        chartCompare.setGallery(cfx.Gallery.Lines);
		          		var divHolder = document.getElementById('divCompare');
		          		chartCompare.setDataSource(compare);
		          		chartCompare.create(divHolder);
				    });
	            },
	            error: function (xhr, txt, err) {
	                alert("error connecting to data: " + txt);            }
       		});		   

			
		});
</script>	