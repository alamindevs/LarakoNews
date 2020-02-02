<?php

use Illuminate\Database\Seeder;
use App\Seo;

class SeoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Seo::insert([
        'author'=>'MD.Al-Amin Hawladar',
        'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
        'keywords'=>'html,php,css,laravel,javascript,python,node.js',
        'title'=>'LarakoNews - Blog & Magazine Script',
      ]);
    }
}
