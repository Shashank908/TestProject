<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function index()
    {
    	//dd(Auth::guard('api')->check());
        $posts = Post::all();

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'body' => 'required'
        ]);
        //dd($request->all());
        $posts = Post::create([
        	'title' => $request->title,
        	'subtitle' => $request->subtitle,
        	'body' => $request->body,
        	'user_id' => $request->user_id
        ]);

        return response()->json([
            'message' => 'Great success! New post created',
            'task' => $posts
        ]);
    }

    public function show(Post $posts)
    {
        return $posts;
    }

    public function update(Request $request, Post $posts)
    {
        $request->validate([
           'title'       => 'nullable',
           'description' => 'nullable'
        ]);

        $posts->update($request->all());

        return response()->json([
            'message' => 'Great success! Task updated',
            'task' => $posts
        ]);
    }

    public function destory1($id)
    {
        $posts = Post::where('id',$id)->delete();

        return response()->json([
            'message' => 'Successfully deleted task!'
        ]);
    }

    public function destroyall()
    {
    	$post = Post::query()->delete();

    	return response()->json([
    		'message' => 'Successfully deleted all posts'
    	]);
    }
}
