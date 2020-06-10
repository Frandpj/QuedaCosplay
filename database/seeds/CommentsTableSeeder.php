<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Seed de comentarios
      $comments = [
          [
              'message' => 'Esta es a prueba de un comentario en la quedada 1',
              'user_id' => '1',
              'stay_id' => '1',
          ]
      ];
      DB::table('comments')->insert($comments);
    }
}
