<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationCategory extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evaluation_categories';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['category_id', 'category'];

	public $primaryKey = 'category_id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	// protected $hidden = ['password', 'remember_token'];
	// 
	public function subcategories() {

		return $this->hasMany('App\EvaluationSubCategory', 'category_id', 'category_id');
	}
}
