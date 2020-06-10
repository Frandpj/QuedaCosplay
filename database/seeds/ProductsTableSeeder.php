<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Seed de productos
      $products = [
          [
              'title' => 'Ordenador MSI',
              'description' => 'Es lo mejor de lo mejor',
              'price' => '212',
          ],
      ];
      DB::table('products')->insert($products);
    }
}
