<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaguePlayer extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'league_players';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['league_id', 'player_id'];

	public $primaryKey = 'league_id';  //['league_id', 'player_id'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];

	public function players() {

		return $this->hasMany('App\Players', 'player_id', 'player_id');
	}
}