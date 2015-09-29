@extends('layouts.app')
@section('style')
	<style>
		.div-welcome {
			text-align: center;
			padding-top: 15px;
			padding-bottom: 15px;
		}
		.welcome {
			font-weight: 300;
			font-size: 18pt;
		}		
		.div-describe {
			text-align: center;
			padding-top: 15px;
			padding-bottom: 15px;
		}

		.describe {
			font-weight: 500;
			font-size: 20pt;
		}	
		.describe-sm {
			font-weight: 300;
			font-size: 14pt;
		}	

		.user-form {
			text-align: center;			
			padding-top: 15px;
			padding-bottom: 15px;
		}
		.control-label {
			font-size: 14pt;
			font-weight: 500;
		}
	</style>
	@parent
@stop
@section('content')
<div class="main-content">
	<div class="row">
		<div class="row col-md-12 div-describe">
			<label class="describe">Link your USAR Account to this account</label>
		</div>
	</div>
	<div class="row">
		<div class="row div-describe describe-sm">	
			By Linking your USAR account, you will have access to your USAR History	in your RballHub account	
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">			
			<div class="user-form panel panel-default box-shadow--2dp">				
				{!! Form::model($user, array('route' => array('edit-link-usar', $user->id), 'role' => 'form', 'class'=> 'form-horizontal','method' => 'POST')) !!}
					{!! Form::hidden ('_token', csrf_token()) !!}
					<div class="form-group">
						<label class="col-md-5 control-label">USAR Login:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="username" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">USAR Password:</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password">
						</div>
					</div>						
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							{!!  Form::submit('Link Accounts', array('class' => 'btn btn-success')) !!}
						</div>
					</div>
					<div class="form-group"> 
						<div class="alert-info col-sm-6 col-sm-offset-3">Note: We not store your USAR username and password</div>
					</div>
				{!! Form::close() !!}							
			</div>
			
		</div>
	</div>
</div>
@stop


<!-- HOW TO Log into USAR website using Curl

Get Username and PAssword in textbox
POST variables to
     https://www.r2sports.com/membership/loginCheck.asp?sportOrganizationID=1&returnToRefPage=&directorID=

//username and password of account
$username = trim($values["userName"]);
$password = trim($values["password"]);

//set the directory for the cookie using defined document root var
$dir = DOC_ROOT."/ctemp";
//build a unique path with every request to store 
//the info per user with custom func. 
$path = build_unique_path($dir);

//login form action url
$url="https://www.site.com/login/action"; 
$postinfo = "email=".$username."&password=".$password;

$cookie_file_path = $path."/cookie.txt";

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
//set the cookie the site has for certain features, this is optional
curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");
curl_setopt($ch, CURLOPT_USERAGENT,
    "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
curl_exec($ch);

//page with the content I want to grab
curl_setopt($ch, CURLOPT_URL, "http://www.site.com/page/");
//do stuff with the info with DomDocument() etc
$html = curl_exec($ch);
curl_close($ch);
-->
