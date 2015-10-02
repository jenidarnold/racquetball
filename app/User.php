<?php namespace App;

use Gidlov\Copycat\Copycat;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

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

	public static function link_Usar($userId, $username, $password) {

		$postinfo = "userName=".$username."&password=".$password;
	 	$url = 'https://www.r2sports.com/membership/login.asp';
	 	
	 	$cc = new CopyCat;
	 	$cc->setCurl(array(
	 		CURLOPT_RETURNTRANSFER => 1,
	 		CURLOPT_CONNECTTIMEOUT => 5,
	 		CURLOPT_HTTPHEADER, "Content-Type: text/html; charset=iso-8859-1",
	 		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
	 		CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_FOLLOWLOCATION => 0,
            CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POST => 1, 
			CURLOPT_POSTFIELDS => $postinfo,
	 	));

	 	$cc->matchAll(
		 				array(
		 					'player_id' => '/&UID=(.*?)&/ms',	
		 				))
	 		->URLS($url);
	 	$result = $cc->get();

	 	dd($result);
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
