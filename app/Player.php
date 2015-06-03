<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'players';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['player_id', 'first_name', 'last_name', 'gender', 'home', 'skill_level', 'img_profile'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];


	public function getFullNameAttribute()
	{
		return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
	}	

	public function getLastFirstNameAttribute()
	{
		return $this->attributes['last_name'] .', '. $this->attributes['first_name'];
	}

	public function getNationalRankAttribute()
	{
		return 100;
	}

	public function getStateRankAttribute($stateID = null)
	{
		return 10;
	}
}
