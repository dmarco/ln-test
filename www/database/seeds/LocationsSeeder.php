<?php

use App\Location;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
			
			Location::truncate();

			Location::create([
					'name' => 'Canada',
					'lat' => '56.130366',
					'lng' => '-106.346771',
					'created_at' => now(),
					'updated_at' => now(),
			]);

			Location::create([
					'name' => 'United States',
					'lat' => '37.090240',
					'lng' => '-95.712891',
					'created_at' => now(),
					'updated_at' => now(),
			]);

			Location::create([
					'name' => 'South Africa',
					'lat' => '-30.559482',
					'lng' => '22.937506',
					'created_at' => now(),
					'updated_at' => now(),
			]);
			
	}
}
