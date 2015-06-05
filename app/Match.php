<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model {

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

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];

	public function head2head($player1, $player2) {

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
			];

		return $versus;
	}

	public function tournament() {

		return $this->belongsTo('App\Tournament', 'tournament_id', 'tournament_id');
	}
}
