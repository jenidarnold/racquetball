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

		// Look up fb id in users
		// if found, authenticate and goto app		
		
		//dd($fb_user->id);
		$link = $fb_user->user();		
		if(! is_null($link)) {
			$user = User::find($link->id);
			\Auth::login($user);
			return new RedirectResponse(route('scores.user.show', array($link->id)));
		} else {
			// Goto page to link accounts
			// See example : https://support.runkeeper.com/hc/en-us/articles/201109976-How-to-link-your-account-to-Facebook

		}
		
		//$user = User::find($user_id);
		//$user = Auth::loginUsingId($userID);
		//return new RedirectResponse(route('scores.user.show', array($user->id)));
	

		//$user = \Auth::login($user);
		//return new RedirectResponse(route('scores.user.show', array($user->id)));

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
