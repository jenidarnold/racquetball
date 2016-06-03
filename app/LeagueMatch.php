<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LeagueMatch extends Model {

	//use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'league_matches';

	public $primaryKey = 'league_id';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['league_id', 'match_id'];


	public function matches() {

		return $this->hasMany('App\Match', 'match_id', 'match_id');
	}


}
