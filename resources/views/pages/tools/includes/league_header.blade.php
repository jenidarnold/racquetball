<div class="row">
	<div class="col-xs-3">
		<h3>{{$league->name}}</h3>
		<h5>{{$league->start_date}} to {{$league->end_date}}</h5>
	</div>
	<div class="col-xs-3">
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
	<div class="col-xs-6">
		<h5> Weeks, Round Robin, one game to 11
		{{$league->description}}<h5>
	</div>
</div>	