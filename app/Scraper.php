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
	 					'gender'      =>'/Gender(?:.*?)<h3>(.*?)<\/h3>/s',
	 					'home'        => '//s',
	 					'skill_level' => '//s',
	 					'name'        => '/<h1>(.*?)<\/h1>/s',
	 				))
	 		->URLS('http://www.usaracquetballevents.com/profile-player.asp?UID=8220');	 		

	 	$result = $cc->get();

	 	return $result;
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
	 					'gender'      =>'/Gender(?:.*?)<h3>(.*?)<\/h3>/s',
	 					'home'        => '//s',
	 					'skill_level' => '//s',
	 					'name'        => '/<h1>(.*?)<\/h1>/s',
	 				))
	 		->URLS('http://www.r2sports.com/tourney/home.asp?TID=13654');	 		

	 	$result = $cc->get();
	 	
	 	return $result;

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
	 		'tournament_id' => '/TID=(.*?)">/ms',
	 		'name' => '/TID=(?:.*?)">(.*?)</ms',
	 		'location' => '/Location:<\/span>(.*?)</ms',
	 		'start_date' => '/Date:<\/span>(.*?)-/ms',
	 		'end_date' => '/Date:<\/span>(?:.*?)-(.*?)</ms',
	 		))
	 		->URLS('http://www.usaracquetballevents.com/Texas/future.asp');	 		

	 	$result = $cc->get();

	 	return $result;
 	}

}



