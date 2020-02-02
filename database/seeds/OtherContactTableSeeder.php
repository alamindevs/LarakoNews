<?php

use Illuminate\Database\Seeder;
use App\OtherContact;

class OtherContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OtherContact::insert([
          'short_about'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
          'address'=>'Mirpur-1216,Dhaka,Bangladesh',
          'email'=>'demo@gmail.com',
          'phone'=>'+88017********',
          'copyright'=>'© 2019 All Rights Reserved. LarakoNews',
        ]);
    }
}
