<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::all()
        ]); 
    }

    public function store()
    {
        $attributes = request()->validate(['title' => 'required', 'description' => 'required']);

        Project::create($attributes);
        return redirect('/projects');
    }
}
