<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

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

    public function edit($id) {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'introduction' => 'required|string|max:500',
            'body' => 'required|string',
            'url' => 'nullable|url',
            'github' => 'nullable|url',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $project = Project::findOrFail($id);

        $project->update([
            'title' => $request->title,
            'introduction' => $request->introduction,
            'body' => $request->body,
            'url' => $request->url ?: null,
            'github' => $request->github ?: null,
        ]);


        if ($request->hasFile('images')) {

            $existingImages = $project->images;
            foreach ($existingImages as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }

            foreach ($request->file('images') as $imageFile) {
                $fileName = time() . '-' . $imageFile->getClientOriginalName();
                $path = $imageFile->storeAs("projects/{$project->id}", $fileName, 'public');

                Image::create([
                    'path' => $path,
                    'project_id' => $project->id,
                ]);

            }
        }

        return redirect()->route('dashboard')->with('success', 'Project en afbeeldingen succesvol bijgewerkt!');
    }

    public function dashboard()
    {
        $projects = Project::where('user_id', auth()->id())->latest()->get();
        return view('dashboard', compact('projects'));
    }


    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'introduction' => 'required|string|max:500',
        'body' => 'required|string',
        'url' => 'nullable|url',
        'github' => 'nullable|url',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $project = Project::create([
        'title' => $request->title,
        'introduction' => $request->introduction,
        'body' => $request->body,
        'url' => $request->url ?: null,
        'github' => $request->github ?: null,
        'user_id' => auth()->id(),
    ]);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $imageFile) {
            $fileName = time() . '-' . $imageFile->getClientOriginalName();

            $path = $imageFile->storeAs("projects/{$project->id}", $fileName, 'public');

            Image::create([
                'path' => $path,
                'project_id' => $project->id,
            ]);
        }
    }
    return redirect()->route('dashboard')->with('success', 'Project en afbeeldingen toegevoegd!');
}

public function destroy($id)
{
    $project = Project::findOrFail($id);
    $images = $project->images;
    foreach ($images as $image) {
        Storage::disk('public')->delete($image->path);
        $image->delete();
    }
    $project->delete();
    return redirect()->route('dashboard')->with('success', 'Project en afbeeldingen succesvol verwijderd!');
}

}
