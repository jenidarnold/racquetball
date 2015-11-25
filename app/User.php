<?php namespace App;

use Guzzlehttp;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Cookie\FileCookieJar;
//use Gidlov\Copycat\Copycat;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, 
                                    AuthorizableContract,
									CanResetPasswordContract 
{

	use Authenticatable, Authorizable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'player_id', 'enabled'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * [link_Usar description]
	 * @param  [type] $userId   [description]
	 * @param  [type] $username [description]
	 * @param  [type] $password [description]
	 * @return [type]           [description]
	 */
	public static function link_Usar($userId, $username, $password) {
		//file to store cookie data
		$cookieFile = '/var/www/racquetball/jar.txt';
		$jar = new FileCookieJar($cookieFile, true);

		$url = 'https://www.r2sports.com/';

		// Need to add the token to the header?
		//X-CSRF-Token: [token]
	 	// Create a client with a base URI
		$client = new \GuzzleHttp\Client(['base_uri' => $url, 'cookies' => $jar ]);
		// Send a request to https://foo.com/api/test
		$response = $client->request('GET', 'membership/loginCheck.asp?TID=&sportOrganizationID=0&returnToRefPage=&directorID=', [
			'form_params' => [
				'userName' => $username,
				'password' => $password
				]			
		]);

		//dd($response);
		//$body = $response->getBody();

		//echo $header;
		//echo $body;

	}
		  
	/**
	 * User's permissions
	 *
	 */
	public function permissions() {

		return $this->hasMany('App\Permission', 'user_id', 'user_id');
	}

	public function hasPermission( $permission_id) {
		$result = 0;
		$result = \DB::table('permissions')
			->where('user_id', '=', $this->id)
			->where('permission_id', '=', $permission_id)
			->count();

		if ($result > 0 ) {
			return true;
		}
		else {
			return false;
		}

	}


}
