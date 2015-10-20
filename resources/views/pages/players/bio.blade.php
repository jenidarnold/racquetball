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

	<div id="ChartDiv" style="width:600px;height:400px;display:inline-block"></div>
@stop

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//Vote Percentage color-code
			$('#li-profile').init(function(){	
				var el = $(this);
				el.addClass('active');
			});
							

			$('#ChartDiv').init(function(){  


          		var player_id = 192412;
          		var location_id =1;
          		var state = 'Texas';

				chart1 = new cfx.Chart();
	            chart1.getData().setSeries(1);
	            //chart1.getAxisY().setMin(1);
	            //chart1.getAxisY().setMax(100);
	            var series1 = chart1.getSeries().getItem(0);
	            //var series2 = chart1.getSeries().getItem(1);
	            series1.setGallery(cfx.Gallery.Lines);
	            //series2.setGallery(cfx.Gallery.Lines);
	            series1.setText('National');
	            //series2.setText(state);
	            //
	            var fields = chart1.getDataSourceSettings().getFields();
				var field1 = new cfx.FieldMap();
				var field2 = new cfx.FieldMap();
				var field3 = new cfx.FieldMap();

				field1.setName("ranking_date");
				field1.setUsage(cfx.FieldUsage.Label);
				fields.add(field1);

				field2.setName("location_id");
				field2.setUsage(cfx.FieldUsage.NotUsed);
				fields.add(field2);

				field3.setName("ranking");
				field3.setUsage(cfx.FieldUsage.Value);
				fields.add(field3);

          		var divHolder = document.getElementById('ChartDiv');
          		chart1.create(divHolder); 	


	            $.ajax({
	            url: '{{ URL::to('api/rankings/history') }}',
	            data: 'player_id=' + player_id + '&location_id=' + location_id,
	            type: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType : "json",
	            success: function (result) {
	                chart1.setDataSource(result.d);
	            },
	            error: function (xhr, txt, err) {
	                alert("error connecting to data: " + txt);            }
	       		});
		    });

		    //$("div", ".ChartDiv1").chart({
            //            gallery:cfx.Gallery.Pie
            //});
		    
		});
</script>	