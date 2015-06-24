<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerEvaluation extends Model {
/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'player_evaluations';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['evaluation_id', 'player_id'];
	
	public $primaryKey = 'evaluation_id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];

	public function scores() {

		return $this->hasMany('App\EvaluationScore', 'evaluation_id', 'evaluation_id');
	}

}
