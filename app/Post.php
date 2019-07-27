<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Events\PostCreated;

class Post extends Model
{
    //
    //If do not want to follow naming convention use this to specify table name:
    //protected $table = 'posts';

    protected $fillable = ['title','body','slug','cover_img','published'];

    protected $dispatchesEvents = [
      'created' => PostCreated::class
    ];

    //Relationship
    public function user(){
      return $this->belongsTo(User::class);
    }

    //custom attribute
    public function getAuthorAttribute(){
      //Kalau ada user, ambil username, kalau tiada, kosong.
      return isset($this->user) ? $this->user->name : '';
    }

    //When it is called at index or any view file, it will be submit_Date
    public function getSubmitDateAttribute(){
      return $this->created_at->diffForHumans();
    }

    public function getTitleAttribute(){
      return Str::title($this->attributes['title']);
    }

    //Function to get URL and change. return id is default(primary key)
    public function getRouteKeyName(){

      //post is post id
      $post_param = request()->route()->parameter('post');

      return is_numeric($post_param) ? 'id' : 'slug';
    }

    public function scopePublished($query){
      return $query->where('published',1);
    }

    public function scopeDraft($query){
      return $query->where('published',0);
    }

    public function getCoverImageUrlAttribute(){
      return $this->attributes['cover_img'] ? url('/storage/'.$this->attributes['cover_img']) : 'https://placehold.it/900x300';
    }

    //Relationship with catehories, many-many
    public function categories(){
      return $this->belongsToMany(Category::class);
    }

    //Relationship with comments
    public function comments(){
      //Morph many because the comment has many model, image, text, video.
      return $this->morphMany(Comment::class,'commentable')->whereNull('parent_id');
    }
}
