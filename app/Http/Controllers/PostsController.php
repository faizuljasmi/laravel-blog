<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\PostRequest as Request;
//include file post in app
use App\Post;
use App\Events\PostCreated;
use App\Category;

class PostsController extends Controller
{
    //Retrieve
    public function index(){

      //Current user
      $user = auth()->user();
      //Fetch Datab
      //Eloquent ORM
      //Changed get() to paginate([no item per page]), by default 15 item will be displayed
      $posts = $user->posts()->orderBy('created_at','DESC')->paginate(config('app.paginate'));

      //To test
      //dd($posts);

      //posts.index. dot is directory/sub folder
      return view('posts.index')->with(['posts' => $posts]);
    }

    //Display create form
    public function create(){

      $categories = $this->getAllCategories();
      return view('posts.create')->with(compact('categories'));
    }
    //Store data into database
    public function store(Request $request){

      //Request is an object
      // $title = $request->get('title');
      // $body =  $request->get('body');
      //
      // //Store data into Database
      // $p = new Post();
      // //$variable->column_name = $value
      // $p->title = $title;
      // $p->body = $body;
      // $p->save();

      //This is an alternative to do everythin that is also done above
      $user = auth()->user();
      //No slug, refer to new post form
      $post = $user->posts()->create($request->only('title','body','published'));
      //dd($post);

      //Upload image
      if($request->hasFile('cover_img')){
        $cover_img = $request->file('cover_img');
        $uploaded_file = $cover_img->store('public');

        //Pecahkan
        $paths = explode('/',$uploaded_file);
        $filename = $paths[1];
        //dd($uploaded_file);
        //Save filename into Database
        $post->update(['cover_img' => $filename]);
      }

      //Save Categories
      $post->categories()->sync($request->get('categories'));

      //Trigger event to create slug
      //db:seed wont trigger this
      //event(new PostCreated($post));

      return redirect()->route('posts_index')->with(['alert' => 'New Post has been added!']);
    }

    //Need to have argument to fetch/catch data that will be passed
    //Display edit form
    public function edit(Post $post){
      //dd($post);
      //return view('posts.edit')->with(['post' => $post]);
      $categories = $this->getAllCategories();
      return view('posts.edit')->with(compact('post','categories'));
    }

    //Same with create, but added argument of post because it is already exist
    //Update post
    public function update(Request $request, Post $post){

      //update is passed with array
      $post->update($request->only('title','body','slug','published'));

      //Upload image
      if($request->hasFile('cover_img')){
        $cover_img = $request->file('cover_img');
        $uploaded_file = $cover_img->store('public');

        //Pecahkan
        $paths = explode('/',$uploaded_file);
        $filename = $paths[1];
        //dd($uploaded_file);
        //Save filename into Database
        $post->update(['cover_img' => $filename]);
      }

      //Save Categories
      $post->categories()->sync($request->get('categories'));

      return redirect()->route('posts_index')->with(['alert' => 'Post has been updated!']);
    }

    //Remove post from DB
    public function delete(Post $post){
      $post->delete();
      return redirect()->route('posts_index');
    }

    //Getting all list of categories
    protected function getAllCategories(){
      //Pluck to get paired id and name
      return Category::orderBy('name')->get()->pluck('name','id');
    }

}
