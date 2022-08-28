<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostCollection;
use App\Http\Resources\Posts\PostResource;
use App\Models\Post;
use App\Models\Subject;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user','subject')->latest()->paginate(request('perPage'));
        // return PostResource::collection($posts);
        return new PostCollection($posts);
    }

    public function show(Subject $subject, Post $post)
    {
        return new PostResource($post);
    }

    public function store()
    {
        auth()->loginUsingId(1);    
        
        request()->validate([
            'name' => 'required|min:6',
            'body' => 'required',
            'subject' => 'required'
        ]);

        $post = auth()->user()->posts()->create([
            'name' => request('name'),
            'slug' => Str::slug(request('name')) . '-' . Str::random(6),
            'body' => request('body'),
            'subject_id' => request('subject')
        ]);

        return response()->json([
            'data'  => $post,
            'message' => 'post was created'
        ]);
    }

    public function edit(Post $post)
    {
        request()->validate([
            'name' => 'required|min:6',
            'body' => 'required',
            'subject' => 'required'
        ]);

        $post->update([
            'name' => request('name'),
            'body' => request('body'),
            'subject_id' => request('subject')
        ]);

        return response()->json([
            'data'  => $post,
            'message' => 'post was Edited'
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'post was deleted'
        ]);
    }
}
