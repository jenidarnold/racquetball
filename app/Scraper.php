<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Gidlov\Copycat\Copycat;

class Scraper {
 
 	public function get_players() 
 	{
		//require_once('copycat.php');

	 	$cc = new CopyCat;
	 	$cc->setCurl(array(
	 		CURLOPT_RETURNTRANSFER => 1,
	 		CURlOPT_CONNECTTIMEOUT => 5,
	 		CUROLOPT_HTTPHEADER, "Content-Type: text/html; charset=iso-8859-1",
	 		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
	 	));

	 	$cc->match(array(
	 		'score' => '/itemprop="ratingValue">(.*?)</ms',))
	 		->URLS('http://imdb.com/title/tt0256578/');	 		

	 	$result = $cc->get();

	 	var_dump($result);
 	}
}



