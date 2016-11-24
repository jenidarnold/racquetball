<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountLink extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'account_links';

	public $primaryKey = 'user_id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'app_type_id', 'app_user_id'];

}
