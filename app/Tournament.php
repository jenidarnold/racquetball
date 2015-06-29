<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tournaments';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['tournament_id', 'name', 'location', 'start_date', 'end_date', 'img_logo'];

	public $primaryKey = 'tournament_id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];

	public function participants() {

		return $this->hasMany('App\Participant', 'tournament_id', 'tournament_id');
	}


	public function divisions() {

		return $this->hasMany('App\TournamentDivision', 'tournament_id', 'tournament_id');
	}

	public function matches() {

		return $this->hasMany('App\Match', 'tournament_id', 'tournament_id');
	}

	public function getMatches($tournament_id, $player_id) {

		$m = \DB::table('matches')
			->join('tournaments', 'tournaments.tournament_id', '=', 'matches.tournament_id')
			->join('players as winner', 'winner.player_id', '=', 'matches.player1_id')
			->join('players as loser', 'loser.player_id', '=', 'matches.player2_id')
			->where('matches.tournament_id', '=', $tournament_id)
			->where(
				function($q)use($player_id) {
					$q->where('player1_id', '=', $player_id)
						->orWhere('player2_id', '=', $player_id);
			})
			->orderBy('match_division')
			->orderBy('round')
			->select( '*',
				'winner.first_name as winner_first_name', 				
			 	'winner.last_name as winner_last_name' ,
				'loser.first_name as loser_first_name', 
				'loser.last_name as loser_last_name',
				'loser.player_id as loser_id',
				'tournaments.name as tournament'
				)
			->distinct()
			->get();

		return $m;
	}
}
