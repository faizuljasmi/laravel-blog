<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
      'name'
    ];

    //Relationship with posts, many-to-many
    public function posts(){
      return $this->belongsToMany(Post::class);
    }
}
