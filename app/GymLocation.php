<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GymLocation extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'gym_locations';

	public $primaryKey = 'id';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'name', 'address1', 'address2', 'city', 'state', 'zip', 'phone', 'map', 'website'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];
}
