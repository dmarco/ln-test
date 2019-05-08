<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
			
			User::truncate();

			User::create([
					'name' => 'Admin',
					'email' => 'admin@admin.com',
					'password' => Hash::make('adminadmin'),
			]);
			
	}
}
