@extends('pages.players.journal.opponent.layout')

@section('style')	
	<style type="text/css">
	.starrr{
		color: green;
		font-size: 14pt;
	}

	.opp-header{
		color:white;
		font-weight: 500;
		font-size: 14pt;
		width:450px;
        padding-left: 10px !important; 
	}

    .opp-title{
        font-weight:700;
        font-size: 16pt;
    }
	</style>
	@parent
@stop

@section('title')
	
	 <div class="form-group">	 	
        {!! Form::open(array('class' =>'form-inline','role'=>'form', 'method'=>'POST', 'route' => array('opponent.edit', $player->player_id, $entry)))!!}
        <label class="player-sub-title">Opponent: {{$opponent->full_name}}</label>
        {!! Form::button('Edit', array('class' =>'btn btn-warning btn-xs', 'type' =>'submit')) !!}
        <label class="entry-date" style="float:right">Updated : </label>
        {!! Form::close()!!}
    </div>
			
@stop

@section('opponent-content')
        <div class="row">
        	<div class="col-md-8">
    			<div>
	    			<h3>Evaluation</h3>
						<table class="table table-condensed">
		    				<thead class="label-primary">
			    				<th class="eval-header">Area of Evaluation</th>
			    				<th class="eval-header">Rating</th>
			    				<th class="eval-header">Comments</th>
			    			</thead>
			    			@foreach($categories as $c)
			    			<tr>
			    				<td class="eval-category info" colspan="3">{{ $c->category }}</td>
			    			</tr>
			    				@foreach($c->subcategories as $s)
			    				<tr>
			    					<td class="eval-subcategory"> {{ $s->subcategory }}</td>			
			    					<td>
			    						<div id={{"stars-$c->category_id-$s->subcategory_id"}} class="starrr" data-rating={{$evaluation->getScore($c->category_id,$s->subcategory_id )}}></div>
			    					</td>
			    					<td class="eval-comment"> 
			    					 <span class="">{{$evaluation->getComment($c->category_id,$s->subcategory_id )}} </span>
			    					</td>
			    				</tr>
			    				@endforeach
			    			@endforeach
			    		</table>
    			</div>
    			<div>
	    			<h3>Notes</h3>
	    			<li></li>
	    			<li></li>
		    		<li></li>
	    		</div>
	    	</div>
    		<div class="col-md-4">
    			<div>
    				<h3>Head to Head Stats</h3>
	    			<table class="table table-condensed table-bordered tbl-facts">					
						<tr class="tr-facts">							
							<td colspan="2" class='row-subheader'>Rank</td>
						</tr>
						<tr>
							<td style="width:50%">{{$player->national_rank}}</td>
							<td>{{$opponent->national_rank}}</td>
						</tr>
						<tr class="tr-facts">
							<td colspan="2" class='row-subheader'>Skill</td>
						</tr>
						<tr>
							<td>{{$player->skill_level}}</td>
							<td>{{$opponent->skill_level}}</td>
						</tr>
						<tr class="tr-facts">
							<td colspan="2" class='row-subheader'>Wins</td>
						</tr>
						<tr>
							<td>{{ $head2head['player1']['wins'] }}</td>
							<td>{{ $head2head['player2']['wins'] }}</td>
						</tr>
					</table>
				</div>
				<div>
					<h3>Match History</h3>
    				<div>
    					<table class="table table-condensed table-bordered tbl-facts">	
    						<tr class="tr-match">
    							<th>Tournament</th>
    							<th>Date</th>
    							<th>Winner</th>
    						</tr>				
								
	    					@foreach($head2head['matches'] as $match)
							<tr class="tr-match">
	    						<td>{{ $match->name}}</td>
	    						<td>{{ $match->start_date}}</td>
	    						<td>{{ $match->winner_first_name . ' ' . $match->winner_last_name}}</td>
	    					</tr>
	    					@endforeach	    					
	    				</table>
    				</div>
    			</div>
    		</div>
        </div>

@stop

@section('script')
<script type="text/javascript"></script>
	@parent
@stop