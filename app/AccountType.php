<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'account_types';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['type_id', 'app_name'];

}
