<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable = [
      'message'
    ];

    //Relationship
    public function user(){
      return $this->belongsTo(User::class);
    }

    public function replies(){

      //By default foreign key= comment_id, so we need to change it
      return $this->hasMany(Comment::class,'parent_id');
    }

    public function commentable(){
      return $this->morphTo();
    }
}
