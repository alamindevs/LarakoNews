<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Post::class, function (Faker $faker) {

  //-------------
      $title=$faker->sentence(6);
      $image='post_photo'.'_'.rand(1,35).'.jpg';
      $data=rand(13,17);
      $time=rand(1,9);
      $dateTime=Carbon::create(2019,8,$data,$time);
    return [
        'title'=>$title,
        'image'=>$image,
        'description'=>$faker->text(1000),
        'short_description'=>$faker->text(150),
        'user_id'=>rand(1,7),
        'slug'=>str_slug($title),
        'created_at'=>$dateTime,
        'updated_at'=>$dateTime,
        'published_at'=>rand(0,1) == 1 ? $dateTime : NULL,
    ];
//--------------


});
