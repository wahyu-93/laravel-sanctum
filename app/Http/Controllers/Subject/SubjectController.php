<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostCollection;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return Subject::get(['id', 'name']);
    }
    
    public function show(Subject $subject)
    {
        // dd($subject);
        $posts = $subject->posts()->latest()->paginate(request('perPage'));
        return (new PostCollection($posts))->additional(['subject' => $subject]);
    }
}
