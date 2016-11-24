<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookUser extends Model
{
/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'fb_users';

	public $primaryKey = 'id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'token', 'id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['token'];

	public function user()
	{
		//return $this->hasManyThrough('App\User','App\AccountLink', 
		//	                          'user_id', 'id', 'app_user_id');

		$user=  \DB::table('users')
			->join('account_links', 'users.id', '=', 'account_links.user_id')
			->where('account_links.app_user_id', '=', $this->id)
			->first();

		return $user;
	}
}