<?php namespace App\Http\Controllers;

use Redirect;
use Illuminate\Contracts\Auth;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		/*$user = \Auth::user();

		$lastLogin = date_create("2015/9/1");
		$today = date_create(date("Y/m/d"));

		//If player go to Player Profile page
		if ($user->player_id > 0){
			return Redirect::action('PlayersJournalController@index', array($user->player_id));
		}elseif ($lastLogin->diff($today)->days > 7){
		//	/* Remind user to link their account to USAR */
		//	return Redirect::action('Users\UserInfoController@show_linkUsar', array($user->id, $lastLogin));
		//}else {
		return view('pages/home');			
		//}*/
	}

}
