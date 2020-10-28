<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run() {
         $this->call([
             UserSeeder::class,
             CategorySeeder::class,
             ProductSeeder::class,
         ]);
    }
}
