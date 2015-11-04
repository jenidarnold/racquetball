<?php namespace App\Repositories;
 
interface TournamentRepositoryInterface {
	
	public function selectAll();
	
	public function find($id);

	public function past();

	public function live();

	public function future();
	
}