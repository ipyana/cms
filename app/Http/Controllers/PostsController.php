<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostsRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('posts.index')->with ('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        // upload image to storage
       // dd($request -> image ->store('posts'));

    //    return dd(request());
       $image = $request -> image ->store('posts');
         //
        // Create a post
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image
        ]);

        // flash a  
        session()->flash('success','Post created successful');

        //redirect user
            return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed()) { $post->forceDelete(); } else { $post->delete(); }

        session()->flash('success', 'Post deleted successful');
        return redirect()->route('posts.index');
    }



    /**
     *Display list if all Trashed posts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function trashed()
    {
        $trashed = Post::withTrashed()->get(); //Search / get all trashed from model Post

        return view('posts.index')->withPosts($trashed); //withpost - special function 
       // return view('posts.index')->with('posts', $trashed);

    }
}
