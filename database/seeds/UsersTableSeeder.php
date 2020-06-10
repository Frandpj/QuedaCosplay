<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Seed de usuarios
      $users = [
          [
              'username' => 'Frandpj',
              'name' => 'Francisco Jesús',
              'surname' => 'del Pino Jiménez',
              'email' => 'fdelpino@naftic.com',
              'password' => bcrypt('password'),
              'province_id' => '1',
              'town_id' => '1',
          ]
      ];
      DB::table('users')->insert($users);
    }
}
