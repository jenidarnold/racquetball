<?php namespace App\Http\Controllers\Tools\Matchmaker;

use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Player;
use App\MatchmakerPlayerAnswer;

class PlayersController extends MatchmakerController {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function players()
	{
		$players = \DB::table('players')
			->join('matchmaker_player_answers', 'players.player_id', '=', 'matchmaker_player_answers.player_id')
			->select('players.player_id', 'first_name', 'last_name')
			->distinct()
			->orderBy('first_name', 'last_name')
			->get();

		$player_list = array();

		foreach ($players as $p) {			
			$player_list[$p->player_id] = $p;
		}

		return response()->json($player_list);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function answersByPlayer($player_id)
	{
		//$answers = MatchmakerPlayerAnswer::where('player_id', '=', $player_id)->get();
	
		return response()->json($answers);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function answers()
	{
		$answers = MatchmakerPlayerAnswer::get();	
		$answers_list = array();

		foreach ($answers as $a) {			
			$answers_list[$a->player_id][$a->question_id] = $a;
		}

		return response()->json($answers_list);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	
	}

	/**
	 * Store Player Answers.
	 *
	 * @return Response
	 */
	public function storePlayerAnswers(Request $request)
	{
		//return response()->json(
		//	MatchmakerPlayerAnswer::create(['player_id' => 123,
		//		'question_id' => 1,
		//		'answer_id' => 1
		//	]));
		

		$player_id = $request->player_id;
		$player_answers = $request->player_answers;

		$question_id = 1;
		foreach ($player_answers as $a) {
			$answer_id = $a[0];

			$answer = MatchmakerPlayerAnswer::find($player_id)->where('question_id', '=', $question_id);
		
			//var_dump($answer->count());

			$answer->question_id = $question_id;
			$answer->answer_id = $answer_id;
			$answer->save();

			//next question
			$question_id +=1;
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($user_id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($user_id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($user_id)
	{
		//
	}

}
