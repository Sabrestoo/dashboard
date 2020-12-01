<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function index() {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store() {
        //validate data

       $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

    //persist data
        Project::create($attributes);

    //redirect

        return redirect('/projects');
    }

    public function show(Project $project) {

        return view('projects.show', compact('project'));
    }

}

