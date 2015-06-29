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
	protected $fillable = ['evaluation_id', 'player_id', 'title'];
	
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

	public function getScore($catID, $subCatID) {


		$s= EvaluationScore::where('evaluation_id', '=', $this->evaluation_id)
			->where('category_id', '=', $catID)
			->where('subcategory_id', '=',  $subCatID)
			->select('score')
			->first();
		
		return $s->score;
	}


	public function getComment($catID, $subCatID) {


		$s= EvaluationScore::where('evaluation_id', '=', $this->evaluation_id)
			->where('category_id', '=', $catID)
			->where('subcategory_id', '=',  $subCatID)
			->select('comment')
			->first();
		
		return $s->comment;
	}
}
