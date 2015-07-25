<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<!-- Fontawesome -->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="{{ asset('/js/datepicker.js') }}"></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
@yield('style')
<style>
	.navbar-brand {
		font-size: 22pt;
		font-weight: 900;
	}
	.navbar-link {
		font-size: 14pt;
		font-weight: 500;
	}

    .row {
        width: 100%;
    }
    .main-content { 
        background-color: white;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 10px;
    }
    .box-shadow--2dp {
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .2), 0 1px 5px 0 rgba(0, 0, 0, .12)
    }
    .box-shadow--3dp {
        box-shadow: 0 3px 4px 0 rgba(0, 0, 0, .14), 0 3px 3px -2px rgba(0, 0, 0, .2), 0 1px 8px 0 rgba(0, 0, 0, .12)
    }
    .box-shadow--4dp {
        box-shadow: 0 4px 5px 0 rgba(0, 0, 0, .14), 0 1px 10px 0 rgba(0, 0, 0, .12), 0 2px 4px -1px rgba(0, 0, 0, .2)
    }
    .box-shadow--6dp {
        box-shadow: 0 6px 10px 0 rgba(0, 0, 0, .14), 0 1px 18px 0 rgba(0, 0, 0, .12), 0 3px 5px -1px rgba(0, 0, 0, .2)
    }
    .box-shadow--8dp {
        box-shadow: 0 8px 10px 1px rgba(0, 0, 0, .14), 0 3px 14px 2px rgba(0, 0, 0, .12), 0 5px 5px -3px rgba(0, 0, 0, .2)
    }
    .box-shadow--16dp {
        box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2)
    }
</style>
<body style="background-image: url('/images/grey-bg.jpg');">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61761895-2', 'auto');
  ga('send', 'pageview');
</script>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<ul class="nav navbar-nav">
					<li>
						<a class="navbar-brand logo" href="#">					
							<img style="height:25px" src="{{ asset('/images/racquet-right.png') }}">					
						</a>
					</li>
					<li>
						<a class="navbar-brand" href="{{ url('/') }}">RacquetBall</a>
					</li>
					<li>
						<a class="navbar-brand logo" href="#">					
							<img style="height:25px" src="{{ asset('/images/racquet-left.png') }}">					
						</a>
					</li>
					
				</ul>			
			</div>

			<!-- 2nd Nav menu -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
                @if (Auth::guest())
                    <li><a class="navbar-link" href="{{ url('/demo') }}"> 
                        <i class="fa fa-home" style="color:black1"></i> Demo</a></li>
                @else
					<li><a class="navbar-link" href="{{ url('/') }}"> 
						<i class="fa fa-home" style="color:black1"></i> Home</a></li>
					<li><a class="navbar-link" href="{{ url('/tournaments') }}">
						<i class="fa fa-trophy" style="color:gold1"></i> Tournaments</i></a></li>
					<li><a class="navbar-link" href="{{ url('/players') }}">
						<i class="fa fa-users" style="color:purple1"></i>
						 Players</a></li>
					<li><a class="navbar-link" href="{{ url('/rankings') }}">
						<i class="fa fa-sort-numeric-asc" style="color:purple1"></i> Rankings</a></li>
					<li><a class="navbar-link" href="{{ url('/matchups') }}">
						<i class="fa fa-user-plus" style="color:green1"></i>
						<i class="fa fa-user" style="color:green1"></i> 
						 Matchups</a></li>
                @endif
				</ul>

                @if (Auth::guest())
                @else
				<ul class="nav navbar-nav zeroed secondary-nav--left">
                <!-- Browse -->
                    <li class="dropdown ">
                        <a href="/index" class="navbar-link dropdown-toggle" data-toggle="dropdown">
                            Browse <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class=""><a href="/index">Site Index</a></li>
                            <li><a href="/all">Latest Content</a></li>
                        </ul>
                    </li>
                     <!-- Discuss -->
                    <li class="dropdown">
                        <a href="/discuss" class="navbar-link dropdown-toggle" data-toggle="dropdown">
                            Discuss <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class=""><a href="/discuss">Forum</a></li>
                            <li><a href="http://facebook.com/rballstats">Facebook</a></li>
                            <li><a href="http://twitter.com/rballstats">Twitter</a></li>
                        </ul>
                    </li>
                     <!-- Lessons -->
                    <li class="dropdown">
                        <a href="/discuss" class="navbar-link dropdown-toggle" data-toggle="dropdown">
                            Lessons <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class=""><a href="/l">Find by Location</a></li>
                            <li><a href="http://facebook.com/rballstats">Find by Instructor</a></li>
                        </ul>                
                    </li>
                    <!-- Clubs -->
                    <li class="dropdown">
                        <a href="/discuss" class="navbar-link dropdown-toggle" data-toggle="dropdown">
                            Clubs <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class=""><a href="/l">Find by Location</a></li>
                            <li class=""><a href="/l">Leagues</a></li>
                            <li><a href="http://facebook.com/rballstats">Find by Club</a></li>
                        </ul>
                    </li>
                    <!-- Shop -->
                    <li class="navbar-link dropdown-toggle" data-toggle="dropdown">
                        <a href="/shop" class="navbar-link dropdown-toggle" data-toggle="dropdown">
                        Shop <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                             <li><a href="#">Advocare</a></li>
                             <li><a href="#">Racquetball Warehouse</a></li>
                        </ul>
                    </li>
        	   	</ul>  
                @endif      
				<!-- Login -->
				<ul class="nav navbar-nav navbar-right">
                   {{--  @if((true) && (get_headers('http://www.r2sports.com/tourney/imageGallery/gallery/player/'.Auth::user()->player_id.'_normal.jpg')[0] != 'HTTP/1.1 404 Not Found' ))                                    
                        <li><img style="height:25px" class='img' src={{'http://www.r2sports.com/tourney/imageGallery/gallery/player/'. Auth::user()->player_id . '_normal.jpg' }}>
                        </a></li>
                    @endif  --}}
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else      
                           
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/users/'.Auth::user()->id) }}">My Account</a></li>
                                <li><a href="{{ url('/players/'.Auth::user()->player_id) }}">Player Page</a></li>
                                <li><a href="{{ url('/players/') }}">Favorites</a></li>
								<li><a href="{{ url('/admin/scraper') }}">Admin</a></li>
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>                         
					@endif
				</ul>
			</div>
		</div>
	</nav>
	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    @yield('script')


    @section('script')
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
             $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");
            });    
        });
    </script>
</body>
</html>
