<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'participants';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['tournament_id', 'player_id', 'division_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];


	/**
	 * Participant's divisions
	 *
	 */
	public function divisions() {

		return $this->hasMany('App\Division', 'id', 'division_id');
	}

    /**
	 * Participant's profile info
	 *
	 */
	public function player() {

		return $this->belongsTo('App\Player', 'player_id', 'player_id');
	}

	public function tournament() {

		return $this->belongsTo('App\Tournament', 'tournament_id', 'tournament_id');
	}
}