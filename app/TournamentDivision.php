<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentDivision extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tournament_division';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['tournament_id', 'division_id'];

}
