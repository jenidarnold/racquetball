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

		$ranks = $this->hasMany('App\Ranking', 'player_id', 'player_id');
		$rank = $ranks->where("location_id", '=', "0")
					->first();
		if ($rank)
		{
			return $rank->ranking;
		}else
		{
			return 0;
		}					
	}

	public function getStateRankAttribute($stateID = null)
	{
		$ranks = $this->hasMany('App\Ranking', 'player_id', 'player_id');
		return $ranks->where("location_id", '=', $stateID)
					->first()
					->ranking
					;
	}

	public function participation() {

		return $this->hasMany('App\Participant', 'player_id', 'player_id');
	}

	public function getTournaments() {

		return \DB::table('tournaments')
			->join('participants', 'tournaments.tournament_id', '=', 'participants.tournament_id')
			->where('participants.player_id', '=', $this->player_id)
			->distinct()
			->get();

	}
}
