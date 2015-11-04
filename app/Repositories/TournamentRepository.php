<?php namespace App\Repositories;
 
use App\Tournament;
 
class TournamentRepository implements TournamentRepositoryInterface {
	
	/**
	 * [selectAll description]
	 * @return [type] [description]
	 */
	public function selectAll()
	{
		return Tournament::all();
	}
	
	/**
	 * [find description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function find($id)
	{
		return Tournament::find($id);
	}

	/**
	 * [past description]
	 * @return [type]     [description]
	 */
	public function past()
	{
		return Tournament::where('end_date', '<', date('Y-m-d'))
			->orderBy('start_date', 'desc')
			;	
	}

	/**
	 * [live description]
	 * @return [type] [description]
	 */
	public function live()
	{
		return Tournament::where('start_date', '<=', date('Y-m-d'))
			->where('end_date', '>=', date('Y-m-d'))
			->orderBy('start_date')
			;
	}

	/**
	 * [future description]
	 * @return [type] [description]
	 */
	public function future()
	{
		return Tournament::where('start_date', '>', date('Y-m-d'))
		    ->orderBy('start_date')
		    ;
	}
}