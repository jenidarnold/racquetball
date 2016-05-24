<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchmakerPlayerAnswer extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'matchmaker_player_answers';

	protected $primaryKey = 'player_id';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['player_id', 'question_id', 'answer_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];
}
