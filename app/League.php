<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'leagues';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['league_id', 'name', 'location_id', 'format_id', 'start_date', 'end_date', 'img_logo'];

	public $primaryKey = 'league_id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];

	public function players() {

		return $this->hasManyThrough('App\Player', 'App\LeaguePlayer', 'league_id', 'player_id');
	}

	public function matches() {

		return $this->hasManyThrough('App\Match', 'App\LeagueMatch', 'league_id', 'tournament_id');
	}

	public function getMatches($league_id, $player_id) {

		$m = \DB::table('matches')
			->join('leagues', 'leagues.league_id', '=', 'matches.tournament_id')
			->join('players as winner', 'winner.player_id', '=', 'matches.player1_id')
			->join('players as loser', 'loser.player_id', '=', 'matches.player2_id')
			->where('matches.tournament_id', '=', $league_id)
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
				'leagues.name as league'
				)
			->distinct()
			->get();

		return $m;
	}
}
