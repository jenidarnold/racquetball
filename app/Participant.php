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

		return $this->hasMany('App\Division', 'division_id', 'id');
	}
}