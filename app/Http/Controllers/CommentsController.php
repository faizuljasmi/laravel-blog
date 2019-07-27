<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Comment;
use App\Post;
//include this after setting validation rules at CommentRequest
use App\Http\Requests\CommentRequest as Request;

class CommentsController extends Controller
{
    public function store(Request $request, Post $post){

      //$message = 'hello'
      $message = $request->get('message');

      // compact('message') contains "'message' => 'hello'"
      $comment = Comment::create(compact('message'));

      $comment->user()->associate(auth()->user());
      $post->comments()->save($comment);

      return redirect()->route('blog_post', $post);
      //or
      //return back();
    }

    public function reply(Request $request, Post $post){

      $message = $request->get('message');
      $comment = Comment::create(compact('message'));

      // $comment->parent_id = $request->get('comment_id');
      // $comment->save();
      $parent_comment = Comment::find($request->get('comment_id'));
      $parent_comment->replies()->save($comment);

      $comment->user()->associate(auth()->user());
      $post->comments()->save($comment);

      return redirect()->route('blog_post', $post);
    }

    public function delete(Comment $comment){

      if($comment->replies){
        $comment->replies()->delete();
      }
      $comment->delete();
      return back();
    }
}
