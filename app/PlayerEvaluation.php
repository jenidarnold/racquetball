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
	protected $fillable = ['evaluation_id', 'player_id', 'title', 'creator_id'];
	
	public $primaryKey = 'evaluation_id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];

	/**
	 * [scores description]
	 * @return [type] [description]
	 */
	public function scores() {

		return $this->hasMany('App\EvaluationScore', 'evaluation_id', 'evaluation_id');
	}

	/**
	 * [getScore description]
	 * @param  [type] $catID    [description]
	 * @param  [type] $subCatID [description]
	 * @return [type]           [description]
	 */
	public function getScore($catID, $subCatID) {

		$s= EvaluationScore::where('evaluation_id', '=', $this->evaluation_id)
			->where('category_id', '=', $catID)
			->where('subcategory_id', '=',  $subCatID)
			->select('score')
			->first();
		
		return $s->score;
	}

	/**
	 * [getComment description]
	 * @param  [type] $catID    [description]
	 * @param  [type] $subCatID [description]
	 * @return [type]           [description]
	 */
	public function getComment($catID, $subCatID) {

		$s= EvaluationScore::where('evaluation_id', '=', $this->evaluation_id)
			->where('category_id', '=', $catID)
			->where('subcategory_id', '=',  $subCatID)
			->select('comment')
			->first();
		
		return $s->comment;
	}

	/**
	 * [creator description]
	 * @return [type] [description]
	 */
	public function creator() {
		return $this->hasOne('App\Player', 'player_id', 'creator_id');
	}

	/**
	 * [target description]
	 * @return [type] [description]
	 */
	public function target() {
		return $this->hasOne('App\Player', 'player_id', 'player_id');
	}

	/**
	 * [show description]
	 * @param  Request          $request    [description]
	 * @param  PlayerEvaluation $evaluation [description]
	 * @return [type]                       [description]
	 */
	public function show(Request $request, PlayerEvaluation $evaluation)
	{
		$this->authorize('show', $evaluation);		
	}
}
