<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('posts')->truncate();
      $posts = [];  
      $faker = Faker::create();
      $date = Carbon::create(2023,03,13,9);

      for($i = 1; $i <= 10; $i++){
        $image = "Post_Image_" . rand(1,5) . ".jpg";
        
        $date->addDays(1);
        $publishedDate = clone($date);
        $createdDate = clone($date);

        $posts[] = [
           'user_id' => rand(1,3),
           'title'=> $faker->sentence(rand(8,12)),
           'exerpt'=>$faker->sentence(rand(250,300)),
           'body'=> $faker->paragraphs(rand(10,15),true),
           'slug'=>$faker->slug(),
           'image'=>rand(0,1) == 1 ? $image : NULL,
           'created_at' => $createdDate,
           'updated_at' => $createdDate,
           'published_at' => $i > 5 ? $publishedDate : ( rand(0,1) == 0 ? NULL : $publishedDate->addDays(4)),
           'category_id' => 0,
        ];

        
      }
      DB::table('posts')->insert($posts);
    }
}
