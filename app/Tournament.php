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

}
