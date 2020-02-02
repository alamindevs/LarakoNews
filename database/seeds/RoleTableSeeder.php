<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Role::insert([
        [
          'name'=>'Admin',
          'slug'=>'admin',
        ],
        [
          'name'=>'Author',
          'slug'=>'author',
        ],
        [
          'name'=>'Editor',
          'slug'=>'Editor',
        ],
      ]);
    }
}
