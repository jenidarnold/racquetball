<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GameFormat extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game_formats';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['format_id', 'format'];

	public $primaryKey = 'format_id';

}
