@section('script')
	@parent
	<script src="{{ asset('js/select2.js') }}"></script>
	<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
	<link href="{{ asset('css/select2-bootstrap.css') }}" rel="stylesheet">
	
	<script type="text/javascript">	 
			
 /*$(function() {
	// Dealer selection click
	$('#dealer').click(function() {
		if ( $('#dealer-select').css('display') == 'block' ) {
			$('#dealer-select').css('display', 'none');
		} else {
			console.log('should be openinig');
			$('#dealer-select').css('display', 'block');
			$('#dealers').select2('open');
		}
	});

	// See http://runnable.com/UmuP-67-dQlIAAFU/events-in-select2-for-jquery for select2 events
	$('#dealers')
	.on("change", function(e) {
		var dealerID = e.val;
		//console.log("change val=" + e.val);
		$('#dealer-select').css('display', 'none');
		console.log('You selected: ' + dealerID);
		$.ajax({
			method: 'POST',
			url: '/dashboard/dealer/' + dealerID + '/select',
			async: false
		}).done(function(response) {
			//window.open(response, '_blank');
			//alert(response);
			location.reload();
		});
	})
	.on("select2-close", function() {
		$('#dealer-select').css('display', 'none');
	});
});*/

	</script>
@stop
				