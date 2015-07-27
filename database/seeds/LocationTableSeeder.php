<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Location;

class LocationTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('locations')->delete();


		Location::create([
			'location_id' => '0',
			'location'    => 'National',
			'abbrev'      => 'National',
		]);
		
		Location::create([
			'location_id' => '1',
			'location'    => 'Texas',
			'abbrev'      => 'TX',
		]);

		Location::create([
			'location_id' => '2',
			'location'    => 'Alabama',
			'abbrev'      => 'AL',
		]);
		
		Location::create([
			'location_id' => '3',
			'location'    => 'Alaska',
			'abbrev'      => 'AK'
		]);		

		Location::create([
			'location_id' => '4',
			'location'    => 'Arizona',
			'abbrev'      => 'AZ'
		]);	

		Location::create([
			'location_id' => '5',
			'location'    => 'Arkansas',
			'abbrev'      => 'AR'
		]);	

		Location::create([
			'location_id' => '384',
			'location'    => 'Armed Forces Americas',
			'abbrev'      => 'AA'
		]);	

		Location::create([
			'location_id' => '385',
			'location'    => 'Armed Forces Europe',
			'abbrev'      => 'AE'
		]);	

		Location::create([
			'location_id' => '386',
			'location'    => 'Armed Forces Pacific',
			'abbrev'      => 'AP'
		]);	

		Location::create([
			'location_id' => '6',
			'location'    => 'California',
			'abbrev'      => 'CA'
		]);	

		Location::create([
			'location_id' => '7',
			'location'    => 'Colorado',
			'abbrev'      => 'CO'
		]);	

		Location::create([
			'location_id' => '8',
			'location'    => 'Connecticut',
			'abbrev'      => 'CT'
		]);	

		Location::create([
			'location_id' => '10',
			'location'    => 'Delaware',
			'abbrev'      => 'DE'
		]);	

		Location::create([
			'location_id' => '9',
			'location'    => 'District of Columbia',
			'abbrev'      => 'CO'
		]);	

		Location::create([
			'location_id' => '11',
			'location'    => 'Florida',
			'abbrev'      => 'FL'
		]);	

		Location::create([
			'location_id' => '12',
			'location'    => 'Georgia',
			'abbrev'      => 'GA'
		]);	

		Location::create([
			'location_id' => '14',
			'location'    => 'Hawaii',
			'abbrev'      => 'HI'
		]);	

		Location::create([
			'location_id' => '15',
			'location'    => 'Idaho',
			'abbrev'      => 'ID'
		]);	

		Location::create([
			'location_id' => '17',
			'location'    => 'Illinois',
			'abbrev'      => 'IL'
		]);	

		Location::create([
			'location_id' => '18',
			'location'    => 'Indiana',
			'abbrev'      => 'IN'
		]);	

		Location::create([
			'location_id' => '16',
			'location'    => 'Iowa',
			'abbrev'      => 'IA'
		]);	

		Location::create([
			'location_id' => '19',
			'location'    => 'Kansas',
			'abbrev'      => 'KS'
		]);	

		Location::create([
			'location_id' => '20',
			'location'    => 'Kentucky',
			'abbrev'      => 'KY'
		]);	

		Location::create([
			'location_id' => '21',
			'location'    => 'Louisiana',
			'abbrev'      => 'LA'
		]);	

		Location::create([
			'location_id' => '22',
			'location'    => 'Maine',
			'abbrev'      => 'ME'
		]);	

		Location::create([
			'location_id' => '23',
			'location'    => 'Maryland',
			'abbrev'      => 'MD'
		]);	

		Location::create([
			'location_id' => '24',
			'location'    => 'Massachusetts',
			'abbrev'      => 'MA'
		]);	

		Location::create([
			'location_id' => '25',
			'location'    => 'Michigan',
			'abbrev'      => 'MI'
		]);	

		Location::create([
			'location_id' => '26',
			'location'    => 'Minnesota',
			'abbrev'      => 'MN'
		]);	

		Location::create([
			'location_id' => '27',
			'location'    => 'Mississippi',
			'abbrev'      => 'MS'
		]);	

		Location::create([
			'location_id' => '28',
			'location'    => 'Missouri',
			'abbrev'      => 'MO'
		]);	

		Location::create([
			'location_id' => '29',
			'location'    => 'Montana',
			'abbrev'      => 'ME'
		]);	

		Location::create([
			'location_id' => '30',
			'location'    => 'Nebraska',
			'abbrev'      => 'NE'
		]);	

		Location::create([
			'location_id' => '31',
			'location'    => 'Nevada',
			'abbrev'      => 'NE'
		]);	

		Location::create([
			'location_id' => '32',
			'location'    => 'New Hampshire',
			'abbrev'      => 'NH'
		]);	

		Location::create([
			'location_id' => '33',
			'location'    => 'New Jersey',
			'abbrev'      => 'NJ'
		]);	

		Location::create([
			'location_id' => '34',
			'location'    => 'New Mexico',
			'abbrev'      => 'MM'
		]);	

		Location::create([
			'location_id' => '35',
			'location'    => 'New York',
			'abbrev'      => 'NY'
		]);	

		Location::create([
			'location_id' => '36',
			'location'    => 'North Carolina',
			'abbrev'      => 'NC'
		]);

		Location::create([
			'location_id' => '37',
			'location'    => 'North Dakota',
			'abbrev'      => 'ND'
		]);	

		Location::create([
			'location_id' => '38',
			'location'    => 'Ohio',
			'abbrev'      => 'OH'
		]);	

		Location::create([
			'location_id' => '39',
			'location'    => 'Oklahoma',
			'abbrev'      => 'OK'
		]);	

		Location::create([
			'location_id' => '40',
			'location'    => 'Oregon',
			'abbrev'      => 'OR'
		]);	

		Location::create([
			'location_id' => '41',
			'location'    => 'Pennsylvania',
			'abbrev'      => 'PA'
		]);	

		Location::create([
			'location_id' => '42',
			'location'    => 'Rhoda Island',
			'abbrev'      => 'RI'
		]);	

		Location::create([
			'location_id' => '43',
			'location'    => 'South Carolina',
			'abbrev'      => 'SC'
		]);	

		Location::create([
			'location_id' => '44',
			'location'    => 'South Dakota',
			'abbrev'      => 'SD'
		]);	

		Location::create([
			'location_id' => '45',
			'location'    => 'Tennessee',
			'abbrev'      => 'TN'
		]);	

		Location::create([
			'location_id' => '46',
			'location'    => 'Utah',
			'abbrev'      => 'UT'
		]);	

		Location::create([
			'location_id' => '47',
			'location'    => 'Vermont',
			'abbrev'      => 'VT'
		]);

		Location::create([
			'location_id' => '48',
			'location'    => 'Virginia',
			'abbrev'      => 'VA'
		]);		

		Location::create([
			'location_id' => '49',
			'location'    => 'Washington',
			'abbrev'      => 'WA'
		]);	

		Location::create([
			'location_id' => '50',
			'location'    => 'West Virginia',
			'abbrev'      => 'WV'
		]);	

		Location::create([
			'location_id' => '51',
			'location'    => 'Wisconson',
			'abbrev'      => 'WI'
		]);	

		Location::create([
			'location_id' => '52',
			'location'    => 'Wyoming',
			'abbrev'      => 'WY'
		]);	
	}

}
