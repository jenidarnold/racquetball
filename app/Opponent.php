<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Opponent extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'opponents';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['opponent_id', 'player_id', 'title'];

	public $primaryKey = 'opponent_id';

}
