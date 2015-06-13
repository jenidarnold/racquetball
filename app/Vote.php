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
	protected $fillable = ['voter_id', 'skill_id', 'for_id', 'against_id'];

	public $primaryKey = 'vote_id';

	public function skills() {

		return $this->hasMany('App\Skill', 'skill_id', 'skill_id');
	}

	public static function head2head($skill_id, $player1, $player2) {

		$p1_for_vs = Vote::where('skill_id', '=', $skill_id)
			->where('for_id', '=', $player1)
			->where('against_id', '=', $player2)
			->get()
			->count();


		$p2_for_vs = Vote::where('skill_id', '=', $skill_id)
			->where('for_id', '=', $player2)
			->where('against_id', '=', $player1)
			->get()
			->count();

		$p1_for_all = Vote::where('skill_id', '=', $skill_id)
			->where('for_id', '=', $player1)
			->get()
			->count();

		$p2_for_all = Vote::where('skill_id', '=', $skill_id)
			->where('for_id', '<>', $player1)
			->get()
			->count();

		$total_vs = $p1_for_vs + $p2_for_vs;

		$total_all = Vote::where('skill_id', '=', $skill_id)
			->where('for_id', '=', $player1)
			->get()
			->count() 
			+ 
			Vote::where('skill_id', '=', $skill_id)
			->Where('against_id', '=', $player1)
			->get()
			->count();

		$vs_percent  = 0;
		if($total_vs > 0) {
			$vs_percent = (int)(($p1_for_vs/$total_vs)*100 + .5);
		}
		
		$all_percent =  0;
		if ($total_all > 0 ) {
			$all_percent = (int)(($p1_for_all/$total_all)*100 + .5);
		}

		$versus = [ 
			 'for' => $vs_percent,
			 'total_vs' => $total_vs,
			 'for_all' => $all_percent ,
			 'total_all' => $total_all,
		];	

		//dd($versus);
		return $versus;
	}
	/**
	 *  Get votes for all skills
	 */
	public static function hasVote($voter_id, $skill_id, $player1, $player2) {
			$vote = Vote::where('voter_id', '=', $voter_id)
			->where('skill_id', '=', $skill_id)
			->where('for_id', '=', $player1)
			->where('against_id', '=', $player2)
			->count();
		if($vote > 0 ) {
			return "true";
		}
		else		{
			return "false" ;
		}
	}
}

