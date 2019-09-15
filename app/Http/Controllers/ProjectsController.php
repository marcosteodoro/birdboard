<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        return view('projects.index', [
            'projects' => auth()->user()->projects
        ]);
    }

    public function store()
    {
        return redirect(auth()->user()->projects()->create($this->validateRequest())->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', [
            'project' => $project
        ]);
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        return redirect($request->save()->path());
    }

    public function create()
    {
        return view('projects.create');
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', [
            'project' => $project
        ]);
    }

    /**
     * @return array
     */
    public function validateRequest()
    {
        return request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
        ]);
    }
}
