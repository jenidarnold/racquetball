<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'locations';

	public $primaryKey = 'location_id';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['location_id', 'location', 'abbrev'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];
}
