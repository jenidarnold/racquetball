<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'games';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'score1', 'score2', 'minutes'];

	//public $primaryKey = 'game_id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];
	// 
	
	public function match() {

		return $this->belongsTo('App\MatchGame', 'id', 'game_id');
	}

}
