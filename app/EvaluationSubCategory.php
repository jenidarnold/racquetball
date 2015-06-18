<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationSubCategory extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evaluation_subcategories';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['subcategory_id', 'subcategory', 'category_id'];


	public $primaryKey = 'subcategory_id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	// protected $hidden = ['password', 'remember_token'];

	public function category() {

		return $this->belongsTo('App\EvaluationCategory', 'category_id', 'category_id');
	}
}
