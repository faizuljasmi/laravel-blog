<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        factory('App\User')->create([
          'email'=> 'faizul@rocketweb.my',
          'name' => 'Faizul Jasmi',
          'password' => bcrypt('secret'),
          'level' => 'admin'
        ]);
        factory('App\User')->times(10)->create();
        Schema::enableForeignKeyConstraints();

    }
}
