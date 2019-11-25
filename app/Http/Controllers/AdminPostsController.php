<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $posts = Post::all();
        $posts = Post::paginate(3);
//        return $posts;
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        //return $request->all();

        $user = Auth::user();
        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }

        $user->posts()->create($input);
        //dd($user->posts);

        return redirect('/admin/posts');

        //ANOTHER METHOD TO DO THIS
//        $input = $request->all();
//        $user = Auth::user();
//        $input['user_id'] = $user->id;
//        /* File Stuff */
//        Post::create($input);
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

        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
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
        //return $request->all();

        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }

        // The method below is used because we only want to edit the posts of the currently logged in user.
        Auth::user()->posts()->whereId($id)->first()->update($input);
        return redirect('/admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        unlink(public_path() . $post->photo->file); //This will also remove the photo of the post from the images directory.
        $post->delete();

        Session::flash('deleted_post', 'The post: ' . $post->title . ' has been deleted.');
        return redirect('/admin/posts');
    }

    public function post($slug){
        //return "it works";
//        $post = Post::findOrFail($id);
        $post = Post::findBySlugOrFail($slug);
        $categories = Category::all();

        $comments = $post->comments()->where('isActive', 1)->get();
        //return $post;
        return view('post', compact('post', 'categories', 'comments'));
    }
}
