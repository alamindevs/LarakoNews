<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
          [
          'name'=>'Admin',
          'username'=>'admin',
          'email'=>'admin@gmail.com',
          'phone'=>'01876619765',
          'gender'=>'1',
          'role_id'=>'1',
          'address'=>'Mirpur-1216',
          'slug'=>'admin',
          'password'=>Hash::make('123456'),
          ],
        ]);
    }
}
