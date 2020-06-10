<?php

use Illuminate\Database\Seeder;

class CollaboratorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Seed de colaboradores
      $collaborators = [
          [
              'user_id' => '1',
              'stays_id' => '1',
          ],
      ];
      DB::table('collaborators')->insert($collaborators);
    }
}
