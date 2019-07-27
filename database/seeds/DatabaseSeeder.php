<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //php artisan db:seed
        //Arrangement matters, depends on database relation (foreign key)
        $this->call(UsersTableSeeder::class);
        $this->call(PostTableSeeder::class);
    }
}
