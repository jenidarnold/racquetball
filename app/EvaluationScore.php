<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationScore extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evaluation_scores';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['evaluation_id', 'category_id' 'subcategory_id', 'score', 'comment'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];

}
