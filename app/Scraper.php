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

 	public function get_rankings($group_id, $location_id, $maxRank) 
 	{
		//require_once('copycat.php');

	 	$cc = new CopyCat;
	 	$cc->setCurl(array(
	 		CURLOPT_RETURNTRANSFER => 1,
	 		CURLOPT_CONNECTTIMEOUT => 5,
	 		CURLOPT_HTTPHEADER, "Content-Type: text/html; charset=iso-8859-1",
	 		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
	 	));

	 	switch ($group_id) {
	 		case 1:
	 			//Men's Singles
	 			$sexCode = 'M';
	 			break;
	 		case 2:
				//Women's Singles
	 			$sexCode = 'F';
	 			break;

	 		case 3:
	 			//Men's Doubles
				$sexCode = 'MD';
				break;

			case 4:
				//Women's State
				$sexCode = 'WD';
				break;

			case 5:
				//Men's Mixed Doubles Texas
				$sexCode = 'MX';
				break;

			case 6:
				//Women's Mixed Doubles Texas
				$sexCode = 'WX';
				break;

	 		default:
	 			$sexCode = 'U';
	 			break;
	 	}

	 	$startRank = 1;
	 	$rankChunks = 100;
		$ss = New ScreenScraper;

		$player_rankings = array();
	 	$i = 0;
	 	$rdate = date('1/1/0000');
	 	$prev_pid = -1;
	 	$curr_pid = 0;
	 	$startMemNum = 0;
	
	 	//URL only gets ranking by chunks of 100. So we have to call the url multiple times to get more pages of info
	 	for ($x = 1; $x <= $maxRank; $x=$x + $rankChunks) {
	 		
	 		if($x == 1) {
	 			$url_rankings = 'http://www.usaracquetballevents.com/rankings.asp?sortOptions=YES&sex='.$sexCode.'&stateID='.$location_id.'&ageRange=all&divClass=&lastName=&firstName=&startDisplayCount='.$startRank;
	 		}
	 		else {
	 			$url_rankings = 'http://www.usaracquetballevents.com/rankings.asp?sortOptions=YES&startMembershipNum='.$startMemNum.'&sex='.$sexCode.'&stateID='.$location_id.'&ageRange=all&divClass=&lastName=&firstName=&startDisplayCount='.$x;
	 		}

		 	$cc->matchAll(
		 				array(
		 					'ranking_date' => '/Rankings last updated:(?:.*?)>(.*?)</ms',
		 					'player_id' => '/&UID=(.*?)">/ms',	
		 					'startMemNum' => '/startMembershipNum=(.*?)&/ms',			 						 								
		 				))
		 		->URLS($url_rankings);	 		

		 	$result = $cc->get();	
		 	
		 	//Variable needed for the next page of Rankings
		 	$startMemNum = 2222;//FIXME $result[0]['startMemNum'][0];

		 	//Increment for next set of rankings
		 	$startRank = $startRank + $rankChunks;	 	

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
										'group_id' => $group_id,
										'location_id' => $location_id,
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
		 }

	 	return $player_rankings;

 	}

 	public function get_player($uid) 
 	{
		//require_once('copycat.php');

	 	$cc = new CopyCat;
	 	$cc->setCurl(array(
	 		CURLOPT_RETURNTRANSFER => 1,
	 		CURLOPT_CONNECTTIMEOUT => 2,
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

	 	return $player;
	}


    public function get_matches($uid) 
 	{
		
	 	$cc = new CopyCat;
	 	$cc->setCurl(array(
	 		CURLOPT_RETURNTRANSFER => 1,
	 		CURLOPT_CONNECTTIMEOUT => 5,
	 		CURLOPT_HTTPHEADER, "Content-Type: text/html; charset=iso-8859-1",
	 		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
	 	));

	 	$cc->matchAll(
	 				array(	 						 					
	 					'player1'   => '/<h3>(?:.*?)<b>(.*?)<\/b>(?:.*?)drawsOut/ms',
	 					'player2'  => '/<h3>(?:.*?)<b>(.*?)<\/b>(?:.*?)Track:/ms',	 					 		
	 					'tournament_id' => '/Results\.asp\?TID=(.*?)>(?:.*?)drawsOut/ms',		
	 					'match_division' => '/divID=(.*?)&/ms', 					
	 					'match_date'        => '/<h3>([0-9]+\/[0-9]+\/[0-9]+)/ms',	 				
	 					//'winner_id'      =>'/<h3>(?:.*?)<b>(.?)<\/b>/ms',
	 					//match_type' => '//s',	 					
	 				))
	 		->URLS('http://www.usaracquetballevents.com/profile-player.asp?UID='.$uid.'&matchHistoryType=Singles');

		$matches = array();
	 			
		$ss = New ScreenScraper;

		$result_matches = $cc->get();
	 	$i = 0;

	 	//Save Player to database
	 	foreach ($result_matches as $match_info) {
	 		for ($x = 0; $x < count($match_info["player1"]); $x++) {
          	        
				$match = array(
					'tournament_id' => $match_info["tournament_id"][$x],
					'player1' => $match_info["player1"][$x],
					'player2' => $match_info["player2"][$x],
					'winner' => $match_info["player1"][$x],
					'match_date' => date("Y-m-d H:i:s", strtotime($match_info["match_date"][$x])),
					'match_division' => $match_info["match_division"][$x],
					'match_type' => 'single elimination', //$match_info["match_type"],
				);
				//Save to database				
			
				//if ($match_info["player1"][$x] != $match_info["player2"][$x]){
					$ss->create_match($match);
					array_push($matches, $match);
				//}
			}

		}

	 	return $matches;
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

		$cnt = count($result_parts[0]["player_id"]);

	 	//Save Participants to database
	 	foreach ($result_parts as $part) {
	 		for ($x = 0; $x < $cnt; $x++) {

	            $player_id = $part["player_id"][$x];		          

				$participant = array(
					'tournament_id' =>  $tid,
					'player_id' => $player_id,
					'division_id' =>  '1',//$divs["division_id"][$d],
				);

				//Save to database
				$ss->create_participant($participant);
				array_push($participants, $participant);				
		 	}
		}

	    //var_dump($participants);
	 	return $participants;

 	}

 	public function get_tournaments($location, $time_period) 
 	{

 		switch($time_period) {
 			case "Past":
 				$tourney_page = "results.asp";
 				break;
 			case "Live":
 				$tourney_page = "live-events.asp";
 				break;
 			case "Future":
				$tourney_page = "results.asp";
 				break;
 		}

 		$url ="http://www.usaracquetballevents.com/$location/$tourney_page";

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
	 		'img_logo' => '/gallery\/tourneyLogo\/(.*?)"/ms',
	 		))
	 		->URLS($url);	

	 	$result = $cc->get();

	 	$ss = New ScreenScraper;

		$tournaments = array();
	 	$i = 0;
	 	$cnt = count($result[0]["tournament_id"]);
	 	
	 	//Save Tournaments to database
	 	foreach ($result as $tourneys) {

	 		for ($x = 0; $x < $cnt; $x++) {

	            $tid = $tourneys["tournament_id"][$x];
	            $tname = $tourneys["name"][$x];
	        
				$tourney = array(
					'tournament_id' =>  $tourneys["tournament_id"][$x],
					'name' => $tourneys["name"][$x],
					'location' => $tourneys["location"][$x],
					'start_date' => date("Y-m-d H:i:s", strtotime($tourneys["start_date"][$x])),
					'end_date' => date("Y-m-d H:i:s", strtotime($tourneys["start_date"][$x])),
					'img_logo' => isset($tourneys["img_logo"][$x])
				);				


				//Save to database
				$ss->create_tournament($tourney);
				array_push($tournaments, $tourney);	
		 	}
		}

	 	return $tournaments;
 	}

}



