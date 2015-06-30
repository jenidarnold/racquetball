@extends('pages.players.journal.opponent.layout')

@section('style')	
	<style type="text/css">
	.starrr{
		color: green;
		font-size: 14pt;
	}

	.eval-header{
		color:white;
		font-weight: 500;
		font-size: 14pt;
		width:450px;
        padding-left: 10px !important; 
	}
    .eval-title{
        font-weight:700;
        font-size: 16pt;
    }
	.eval-category{
		font-weight: 700;
		font-size: 12pt;
        padding-left: 10px !important; 
	}
	.eval-subcategory{
		font-weight: 500;
		font-size: 10pt;
		vertical-align: center;
         padding-left: 20px !important; 
	}
	.eval-comment {
		width: 400px;
	}

    .form-label{
        font-weight:500;
    }
	</style>
	@parent
@stop

@section('title')
	<label class="player-sub-title">Create New Opponent</label>
	<label class="entry-date" style="float:right">Last Entry: 6/1/15</label>		
@stop

@section('opponent-content')

@stop