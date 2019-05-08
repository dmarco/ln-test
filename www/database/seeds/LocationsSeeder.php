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
					'name' => 'La Nacion',
					'lat' => '-34.5334209',
					'lng' => '-58.4696912'
			]);
			
			Location::create([
					'name' => 'Kiosco Paris',
					'lat' => '-34.539455',
					'lng' => '-58.467413'
			]);

			Location::create([
					'name' => 'Kiosco 24hs. PACO',
					'lat' => '-34.5387761',
					'lng' => '-58.4758562'
			]);

			Location::create([
					'name' => 'Osco kiosco',
					'lat' => '-34.5125426',
					'lng' => '-58.4898639'
			]);

			Location::create([
					'name' => 'Kiosco de Diarios y Revistas',
					'lat' => '-34.5089949',
					'lng' => '-58.4921693'
			]);
			
	}
}
