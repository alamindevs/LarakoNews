<?php

use Illuminate\Database\Seeder;
use App\LogoBreadcrumb;

class LogoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      LogoBreadcrumb::insert([
        'log'=>'logo.png',
        'breadcrumb'=>'breadcrumb.jpg',
      ]);
    }
}
