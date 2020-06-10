//<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
          //UsersTableSeeder::class,
          //StaysTableSeeder::class,
          //CommentsTableSeeder::class,
          //ProductsTableSeeder::class,
          //CollaboratorsTableSeeder::class,
          ProvincesTableSeeder::class,
          TownsTableSeeder::class,
      ]);
    }
}
