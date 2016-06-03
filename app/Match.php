<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model {

	//use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'matches';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['match_id', 'tournament_id', 'match_date', 'match_division', 'player1_id', 'player2_id', 'winner_id', 'match_type'];

	public $primaryKey ='match_id';
	  
	/**
	 * [$dates description]
	 * @var array
	 */
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];

	public function head2head($player1, $player2) {

		//Match detail
		$matches = \DB::table('matches')
			->join('tournaments', 'tournaments.tournament_id', '=', 'matches.tournament_id')
			->join('players as winner', 'winner.player_id', '=', 'matches.player1_id')
			->join('players as loser', 'loser.player_id', '=', 'matches.player2_id')
			->where(
				function($q)use($player1) {
					$q->where('player1_id', '=', $player1)
						->orWhere('player2_id', '=', $player1);
			})
			->where(
				function($q)use($player2) {
					$q->where('player1_id', '=', $player2)
						->orWhere('player2_id', '=', $player2);
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

		//Count wins by player
		$player1_wins = Match::where('winner_id', '=', $player1)
					->where('player2_id', '=', $player2)
					->get()
					->count();


		$player2_wins = Match::where('winner_id', '=', $player2)
					->where('player2_id', '=', $player1)
					->get()
					->count();


		$versus = [ 'player1' => [
								 'wins' => $player1_wins,
							],
					'player2' => [
								 'wins' => $player2_wins,
							],
					'matches' => $matches,
			];

		return $versus;
	}

	public function tournament() {

		return $this->belongsTo('App\Tournament', 'tournament_id', 'tournament_id');
	}

	public function league() {

		return $this->belongsTo('App\League', 'tournament_id', 'league_id');
	}

	public function getScores() {

		//return 5;
		return $this->hasMany('App\MatchGame', 'match_id', 'game_id');
	}
}