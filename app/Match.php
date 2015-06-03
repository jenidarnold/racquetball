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

}
