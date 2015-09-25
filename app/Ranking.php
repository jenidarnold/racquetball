<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rankings';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ranking_date', 'player_id', 'ranking', 'group_id', 'location_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = ['password', 'remember_token'];


	/**
	 * [getStateRankAttribute description]
	 * @param  [type]
	 * @return [type]
	 */
	public function getLastRankingDateAttribute($stateID = null)
	{
		return\DB::table('rankings')
			->max('ranking_date');
	}


	public function getLatestRankings($group_id, $location_id) {

		$latest_date = \DB::table('rankings')
			->where('group_id','=', $group_id)
			->where('location_id','=', $location_id)
			->max('ranking_date');

		return $this->getRankings($latest_date, $group_id, $location_id);
	}

	/**
	 *  Get Rankings
	 *  @var  array
	 */
	public function getRankings($ranking_date, $group_id, $location_id) {

		$rankings= \DB::table('rankings')
			->join('players', 'rankings.player_id', '=', 'players.player_id')
			->join('groups', 'rankings.group_id', '=', 'groups.group_id')
			->join('locations', 'rankings.location_id', '=', 'locations.location_id')
			->where('ranking_date', '=', $ranking_date)
			->where('rankings.group_id', '=', $group_id)
			->where('rankings.location_id', '=', $location_id)
			->distinct()
			->paginate(10);
			//->get();

			var_dump($rankings);
			return $rankings;
	}
}
