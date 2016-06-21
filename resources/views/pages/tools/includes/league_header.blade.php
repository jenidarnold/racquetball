<div class="row">
	<div class="col-xs-12">
		<h3>{{$league->name}}</h3>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-4">
		<h5>
			<address>
				{{$league->gym}}
				<a class="link" target="_blank" href="https://www.lafitness.com/pages/clubhome.aspx?clubid=430&Carrollton-Texas"></a>
				LA | Fitness<br/>
		    	4220 Midway </br>
		    	Carrollton, TX 75007
		    </address>
		</h5>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-4">
		<h5>
			<address>
				{{date('n-d-y', strtotime($league->start_date))}} thru {{date('n-d-y', strtotime($league->end_date))}} <br/>
				{{date('l', strtotime($league->start_date))}}'s {{date('g:i A', strtotime($league->start_date))}} to {{date('g:i A', strtotime($league->end_date))}} <br/>
			</address>
		</h5>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-4">
		<h5> Weeks, Round Robin, one game to 11
		{{$league->description}}<h5>
	</div>
</div>	