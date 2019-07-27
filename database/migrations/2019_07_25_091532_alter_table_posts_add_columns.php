<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePostsAddColumns extends Migration
{
    /**
     * Run the migrations.
     * This class serve as addition migration to an existing table, without having to delete the existing data in it. 
     * @return void
     */
    public function up()
    {
        Schema::table('posts',function (Blueprint $table){
          $table -> string('cover_img')->after('body')->nullable();
          //Nullable just for initil empty setup
          $table -> string('slug')->after('cover_img')->nullable();
          $table -> boolean('published')->after('slug')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts',function(Blueprint $table){
          $table->dropColumn('cover_img');
          $table->dropColumn('slug');
          $table->dropColumn('published');
        });
    }
}
