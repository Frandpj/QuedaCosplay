<?php

use Illuminate\Database\Seeder;

class StaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $stays = [
          [
              'title' => 'Quedada1',
              'description' => 'La quedada será en Córdoba',
              'datetime' => '2011-12-24 13:00:00',
              'location' => '{lat: 37.885568, lng: -4.785387}',
              'whatsappurl' => 'whatsappurlprueba.com',
              'user_id' => '1',
              'province_id' => '1',
          ]
      ];
      DB::table('stays')->insert($stays);
    }
}
