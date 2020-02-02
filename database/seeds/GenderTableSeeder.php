<?php

use Illuminate\Database\Seeder;
use App\Gender;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Gender::insert([
        [
          'name' => 'Male',
          'slug' => 'male',
        ],[
          'name' => 'Female',
          'slug' => 'female',
        ]
      ]);
    }
}
