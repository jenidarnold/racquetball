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

	public $primaryKey = 'player_id';

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
		      ->orderBy('ranking_date', 'desc')
			  ->first();
		if ($rank)
		{
			return $rank->ranking;
		}else
		{
			return 0;
		}					
	}

	/**
	 * temporary stateID attribute until scrape and stored in db
	 * @return int
	 */
	public function getStateIdAttribute()
	{
		return 1; //Texas
	}

	/**
	 * temporary trackingID attribute until scrape and stored in db
	 * @return int
	 */
	public function getTrackingIdAttribute()
	{
		return 222; 
	}

	/**
	 * temporary tracking name attribute until scrape and stored in db
	 * @return int
	 */
	public function getTrackingAttribute()
	{
		return "Jo Smith"; 
	}

	public function getStateRankAttribute()
	{
		$rank = 0;

		$ranks = $this->hasMany('App\Ranking', 'player_id', 'player_id');
		$ranks = $ranks->where("location_id", '=', $this->state_id)
			->orderBy('ranking_date', 'desc')
			->first();
		
		if (isset($ranks)) {
			$rank = $ranks->ranking;
		}

		return $rank;
	}

	public function participation() {

		return $this->hasMany('App\Participant', 'player_id', 'player_id');
	}


	public function getTournaments() {

		return \DB::table('tournaments')
			->join('participants', 'tournaments.tournament_id', '=', 'participants.tournament_id')
			->where('participants.player_id', '=', $this->player_id)
			->select('player_id','participants.tournament_id', 'name', 'start_date', 'end_date')
			->distinct()
			->orderBy('start_date', 'desc')
			->get();

	}

	public function getMatches() {

		$m = \DB::table('matches')
			->join('tournaments', 'tournaments.tournament_id', '=', 'matches.tournament_id')
			->join('players as winner', 'winner.player_id', '=', 'matches.player1_id')
			->join('players as loser', 'loser.player_id', '=', 'matches.player2_id')
			->where("player1_id", '=', $this->player_id)
			->orWhere("player2_id", '=', $this->player_id)
			->orderBy('round')
			->select( '*',
				'winner.first_name as winner_first_name', 				
			 	'winner.last_name as winner_last_name' ,
				'loser.first_name as loser_first_name', 
				'loser.last_name as loser_last_name',
				'loser.player_id as loser_id',
				'tournaments.name as tournament'
				)
			->get();

		return $m;
	}

}
