<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Will create dummy data
        Schema::disableForeignKeyConstraints();
        DB::table('posts')->truncate();
        Factory('App\Post')->times(100)->create()->each(function($post){
          $category = App\Category::all()->random();
          $post->categories()->save($category);
        });
        Schema::enableForeignKeyConstraints();
    }
}
