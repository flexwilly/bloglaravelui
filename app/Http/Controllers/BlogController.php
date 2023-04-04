<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class BlogController extends Controller
{
    //number of posts to show
    protected $limit = 3; 

    public function index(){
        //die('blog index');
      
        $posts = Post::with('user')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);
        return view('blog.index',compact('posts'));
    }

    //show post with categories
    public function show(Post $post){
      
       return view("blog.show", compact('post'));
    }
    // category method
    public function category(Category $category){
        //die('blog index');
        $categoryName = $category->title;

        
        //more precise query
        $posts =$category->posts()
                        ->with('user')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate($this->limit);

        return view('blog.index',compact('posts','categoryName'));
    }


}
