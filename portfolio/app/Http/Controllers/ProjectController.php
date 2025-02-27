<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', auth()->id())->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'text' => 'required|text',
            'url' => 'required',
            'github' => 'required',
        ]);

        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->text = $request->text;
        $project->url = $request->url;
        $project->github = $request->github;
        $project->user_id = auth()->id();
        $project->save();

        return redirect()->route('projects.index');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $projects = Project::where('user_id', auth()->id())->get();
        $images = Image::all();

        return view('projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'text' => 'required',
            'url' => 'required',
            'github' => 'required',
        ]);

        $project = Project::findOrFail($id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->text = $request->text;
        $project->url = $request->url;
        $project->github = $request->github;
        $project->save();

        return redirect()->route('projects.index');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index');
    }
}
