<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'votes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['vote_id', 'voter_id', 'skill_id', 'for_id', 'against_id'];


	public function skills() {

		return $this->hasMany('App\Skill', 'skill_id', 'skill_id');
	}

	public function head2head($skill_id, $player1, $player2) {

		$p1_for_vs = Vote::where('skill_id', '=', $skill_id)
			->where('for_id', '=', $player1)
			->where('against_id', '=', $player2)
			->get()
			->count();


		$p2_for_vs = Vote::where('skill_id', '=', $skill_id)
			->where('for_id', '=', $player2)
			->get()
			->count();

		$p1_for_all = Vote::where('skill_id', '=', $skill_id)
			->where('for_id', '=', $player1)
			->get()
			->count();

		$p2_for_all = Vote::where('skill_id', '=', $skill_id)
			->where('for_id', '=', $player2)
			->get()
			->count();

		$total_vs = $p1_for_vs + $p2_for_vs;

		$total_all =  Vote::where('skill_id', '=', $skill_id)
			->get()
			->count();

		$versus = [ 
			 'for' => ($p1_for_vs/$total_vs)*100,
			 'total_vs' => $total_vs,
			 'for_all' => $p1_for_all ,
			 'total_all' => $total_all,
		];	

		// $versus = [ 'player1' => [
		// 						 'for' => $p1_for_vs,
		// 						 'total_vs' => $total_vs,
		// 						 'for_all' => $p1_for_all ,
		// 						 'total_all' => $total_all,
		// 					],
		// 			'player2' => [
		// 						 'for' => $p2_for_vs,
		// 						 'total' => $total_vs,
		// 						 'for_all' => $p2_for_all ,
		// 						 'total_all' => $total_all,
		// 					],
		// 	];

		return $versus;
	}
}

