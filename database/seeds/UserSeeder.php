<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    public function run() {
        DB::table('users')->insert([
            [
                'name' => 'Anuz Pandey',
                'email' => 'anuz@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@gmail.com',
                'password' => Hash::make('password')
            ],
        ]);
    }
}
