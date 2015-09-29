<?php namespace App\Handlers\Events;

use App\Events\UserWasRegistered;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendRegistrationConfirmation {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserWasRegistered  $event
	 * @return void
	 */
	public function handle(UserWasRegistered $event)
	{
		\Mail::raw('A new user just registered', function($message)
		{
		    $message->from('notify@racquetballhub.com', 'RacquetballHub');

		    $message->to('julie.enid@gmail.com')->subject('New RballHub Registration!');
		});		
	}

}
