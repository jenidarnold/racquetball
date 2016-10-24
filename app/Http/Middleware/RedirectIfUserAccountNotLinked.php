<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class RedirectIfUserAccountNotLinked {

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
		$user = \Auth::user();

		$lastLogin = date_create("2015/9/1");
		$today = date_create(date("Y/m/d"));


		return new RedirectResponse(url('scores/{user_id}/show', array($user->id)));

		//If player go to Player Profile page
		if ($user->player_id > 0){
			return new RedirectResponse(action('PlayersJournalController@index', array($user->player_id)));
		}elseif ($lastLogin->diff($today)->days > 7){
			/* Remind user to link their account to USAR */
			return new RedirectResponse(action('Users\UserInfoController@show_linkUsar', array($user->id)));
		}else {
			return new RedirectResponse(url('/home'));
		}
		return $next($request);
	}

}
