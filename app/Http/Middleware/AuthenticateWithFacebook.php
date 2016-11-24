<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use App\FacebookUser;
use App\User;

class AuthenticateWithFacebook {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	
		$fb_user = FacebookUser::find($request->id);

		if (is_null($fb_user)) {
			$fb_user = New FacebookUser;
			//Create FB User		
			$fb_user->id = $request->id;
			$fb_user->name = $request->name;
			$fb_user->email = $request->email;
			$fb_user->token = $request->token;

			$fb_user->save();
		}

		//$user = \Auth::user();
		$user = New User;
		$user->id = 17; //$fb_user->id;
		$user->first_name = $fb_user->name;

		//$lastLogin = date_create("2015/9/1");
		//$today = date_create(date("Y/m/d"));


		return new RedirectResponse(route('scores.user.show', array($user->id)));

		////If player go to Player Profile page
		//if ($user->player_id > 0){
		//	return new RedirectResponse(action('PlayersJournalController@index', array($user->player_id)));
		//}elseif ($lastLogin->diff($today)->days > 7){
		//	/* Remind user to link their account to USAR */
		//	return new RedirectResponse(action('Users\UserInfoController@show_linkUsar', array($user->id)));
		//}else {
		//	return new RedirectResponse(url('/home'));
		//}
		//return $next($request);
	}

}
