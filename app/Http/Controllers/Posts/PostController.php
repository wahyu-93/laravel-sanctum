<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostCollection;
use App\Http\Resources\Posts\PostResource;
use App\Models\Post;
use App\Models\Subject;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user','subject')->latest()->paginate(10);
        // return PostResource::collection($posts);
        return new PostCollection($posts);
    }

    public function show(Subject $subject, Post $post)
    {
        return new PostResource($post);
    }
}
