<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Gidlov\Copycat\Copycat;
use App\Services\ScreenScraper;

class Scraper {
 
 	/*
 	 * Get Players from R2Sports.com
 	 * https://github.com/gidlov/copycat
 	 * https://regex101.com/
 	 * http://www.regular-expressions.info/refcapture.html
 	 */

 	public function get_rankings() 
 	{
		//require_once('copycat.php');

	 	$cc = new CopyCat;
	 	$cc->setCurl(array(
	 		CURLOPT_RETURNTRANSFER => 1,
	 		CURLOPT_CONNECTTIMEOUT => 5,
	 		CURLOPT_HTTPHEADER, "Content-Type: text/html; charset=iso-8859-1",
	 		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
	 	));

	 				
	 	$url_rankings = 	'http://www.usaracquetballevents.com/rankings.asp';

	 	$cc->matchAll(
	 				array(
	 					'ranking_date' => '/Rankings last updated:(?:.*?)>(.*?)</ms',
	 					'player_id' => '/&UID=(.*?)">/ms',		 									
	 				))
	 		->URLS($url_rankings);	 		

	 	$result = $cc->get();

	 	$ss = New ScreenScraper;

		$player_rankings = array();
	 	$i = 0;
	 	$rdate = date('1/1/0000');
	 	$prev_pid = -1;
	 	$curr_pid = 0;

	 	//Save Rankings to database
	 	foreach ($result as $rankings) {
	 		foreach ($rankings as $players) {
	 			foreach ($players as $player) {
	 				foreach (explode(" ", $player) as $pid) {
	 				
		 				if ($i == 0) {
							$rdate =  date("Y-m-d H:i:s", strtotime($pid));
							$i = $i + 1;
						}
						else {
							$curr_pid = $pid;
					 		
							if ($prev_pid != $curr_pid) {
								$rank = array(
									'ranking_date' => $rdate,
									'player_id' => $curr_pid,
									'ranking' =>  $i,
								);
								//Save to database
								$ss->create_ranking($rank);
								array_push($player_rankings, $rank);
								$i = $i + 1;
							}

					 	}					 	
					 	$prev_pid = $curr_pid;
				 	}
				}
			}
	 	}
	 	return $player_rankings;

 	}

 	public function get_player($uid) 
 	{
		//require_once('copycat.php');

	 	$cc = new CopyCat;
	 	$cc->setCurl(array(
	 		CURLOPT_RETURNTRANSFER => 1,
	 		CURLOPT_CONNECTTIMEOUT => 5,
	 		CURLOPT_HTTPHEADER, "Content-Type: text/html; charset=iso-8859-1",
	 		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
	 	));

	 	$cc->match(
	 				array(
	 					'first_name'  => '/Player Name:(?:.*?)<h1>(.*?) (?:.*?)<\/h1>/s',
	 					'last_name'   => '/Player Name:(?:.*?)<h1>(?:.*?) (.*?)<\/h1>/s',	 					
	 					'gender'      =>'/Gender(?:.*?)<h3>(.*?)<\/h3>/s',
	 					'home'        => '/Player From(?:.*?)<h3>(.*?)<\/h3>/s',
	 					'skill_level' => '/Skill Level(?:.*?)<h3>(.*?)<\/h3>/s',
	 					'img_profile' => '/gallery\/player\/(.*?)"/s',
	 				))
	 		->URLS('http://www.usaracquetballevents.com/profile-player.asp?UID=' .$uid);	 		

	 	$result = $cc->get();
		
		var_dump($result);

		$ss = New ScreenScraper;

		$player = array();
	 	$i = 0;
	 
	 	//Save Player to database
	 	foreach ($result as $player_info) {
	 	//	for ($x = 0; $x <= count($tourneys); $x++) {
	        
				$player = array(
					'player_id' =>  $uid,
					'first_name' => $player_info["first_name"],
					'last_name' => $player_info["last_name"],
					'gender' => $player_info["gender"],
					'home' => $player_info["home"],
					'skill_level' => $player_info["skill_level"],
					'img_profile' => $player_info["img_profile"],
				);

				//Save to database				
				//TODO: don't create if already exists in database
				$ss->create_player($player);
		 //	}
		}

		var_dump($player);
	 	return $player;
	}



	/*
 	 * Param: tid = tournament id
	 */
 	public function get_participants($tid) 
 	{
		//require_once('copycat.php');

 		$cc = new CopyCat;
	 	$cc->setCurl(array(
	 		CURLOPT_RETURNTRANSFER => 1,
	 		CURLOPT_CONNECTTIMEOUT => 5,
	 		CURLOPT_HTTPHEADER, "Content-Type: text/html; charset=iso-8859-1",
	 		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
	 	));

	 	$cc->matchAll(
	 				array(
	 					'player_id'   => '/<h1>(?:.*?)profile-player(?:.*?)&UID=(.*?)"/ms',
	 					'division_id' => '/drawOut(?:.*?)&divID=(.*?)>/ms',
	 				))
	 		->URLS('http://www.r2sports.com/tourney/EntryList.asp?TID='. $tid);	 		
	 	$result_parts = $cc->get();


		$participants = array();
		$ss = New ScreenScraper;

	 	//Save Participants to database
	 	foreach ($result_parts as $part) {
	 		for ($x = 0; $x < count($part["player_id"]); $x++) {

		            $player_id = $part["player_id"][$x];
		            //Get Player's Divisions
					//$ccDiv = new CopyCat;
				 	//$ccDiv->setCurl(array(
				 	//	CURLOPT_RETURNTRANSFER => 1,
				 	//	CURLOPT_CONNECTTIMEOUT => 5,
				 	//	CURLOPT_HTTPHEADER, "Content-Type: text/html; charset=iso-8859-1",
				 	//	CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
				 	//));

		 			//$ccDiv->matchAll(
		 			//	array(
		 			//		'division_id' => '/UID='. $player_id .'"(?:.*?)drawOut(?:.*?)&divID=(.*?)>/ms',
		 			//	))
		 			//	->URLS('http://www.r2sports.com/tourney/EntryList.asp?TID='. $tid);	 	
		 			//$result_divs = $ccDiv->get();


		 			//foreach ($result_divs as $divs) {
		 			//	for ($d = 0; $d <= count($divs); $d++) {

		 					//var_dump($divs);

							$participant = array(
								'tournament_id' =>  $tid,
								'player_id' => $player_id,
								'division_id' =>  '1',//$divs["division_id"][$d],
							);
					//	}
					//}
					//Save to database
					$ss->create_participant($participant);
					array_push($participants, $participant);				
		 	}
		}

	    //var_dump($participants);
	 	return $participants;

 	}

 	public function get_tournaments() 
 	{

	 	$cc = new CopyCat;
	 	$cc->setCurl(array(
	 		CURLOPT_RETURNTRANSFER => 1,
	 		CURLOPT_CONNECTTIMEOUT => 5,
	 		CURLOPT_HTTPHEADER, "Content-Type: text/html; charset=iso-8859-1",
	 		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
	 	));

	 	$cc->matchAll(array(
	 		'tournament_id' => '/<h2>(?:.*?)TID=(.*?)">/ms',
	 		'name' => '/<h2>(?:.*?)TID=(?:.*?)">(.*?)</ms',
	 		'location' => '/Location:<\/span>(.*?)</ms',
	 		'start_date' => '/Date:<\/span>(.*?)-/ms',
	 		'end_date' => '/Date:<\/span>(?:.*?)-(.*?)</ms',
	 		))
	 		->URLS('http://www.usaracquetballevents.com/Texas/future.asp');	 		

	 	$result = $cc->get();

	 	$ss = New ScreenScraper;

		$tournaments = array();
	 	$i = 0;
	 
	 	//Save Tournaments to database
	 	foreach ($result as $tourneys) {
	 		for ($x = 0; $x <= count($tourneys); $x++) {
	            $tid = $tourneys["tournament_id"][$x];
	            $tname = $tourneys["name"][$x];

				//var_dump($tname[0]);
	        
				$tourney = array(
					'tournament_id' =>  $tourneys["tournament_id"][$x],
					'name' => $tourneys["name"][$x],
					'location' => $tourneys["location"][$x],
					'start_date' => date("Y-m-d H:i:s", strtotime($tourneys["start_date"][$x])),
					'end_date' => date("Y-m-d H:i:s", strtotime($tourneys["start_date"][$x])),
				);

				//Save to database
				$ss->create_tournament($tourney);
				array_push($tournaments, $tourney);	
		 	}
		}

	 	return $tournaments;
 	}

}



