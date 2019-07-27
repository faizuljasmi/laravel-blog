<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class BlogController extends Controller
{
    //Blog home
    public function index(){

      $posts = Post::orderBy('created_at', 'DESC')->published()->paginate(config('app.paginate'));

      $categories = $this->getAllCategories();
      return view('blog.index')->with(compact('posts','categories'));
    }

    //Blog Post
    public function post(Post $post){

      $categories = $this->getAllCategories();
      return view('blog.post')->with(compact('post','categories'));
    }

    //Blog search
    public function search(Request $request){

      $categories = $this->getAllCategories();
      $keyword = $request->get('keyword');
      //If want to search for author, use User instead of Post
      $posts = Post::where('title', 'LIKE', '%' .$keyword. '%')->orWhere('user_id', 'LIKE', '%'.$keyword.'%')->orderBy('created_at', 'DESC')->paginate();

      return view('blog.index')->with(compact('posts','categories'));
    }

    public function getAllCategories(){
      return Category::orderBy('name')->get()->pluck('name','id');
    }

    //Blog display according to category
    public function categories(Category $category){
      $posts = $category->posts()->paginate(config('app.paginate'));
      $categories = $this->getAllCategories();
      return view('blog.index')->with(compact('posts', 'categories'));
    }
}
