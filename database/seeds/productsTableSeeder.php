<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => Str::random(10),
            'details' => Str::random(10).'@gmail.com',
            'slug'=>
            'description' => bcrypt('secret'),
            'price'=>
        ]);
    }
}
