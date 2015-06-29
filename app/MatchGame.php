<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchGame extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'match_games';

	public $primaryKey = 'match_id';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['match_id', 'game_id', 'game_num'];


	public function games() {

		return $this->hasMany('App\Game', 'id', 'game_id');
	}

}
