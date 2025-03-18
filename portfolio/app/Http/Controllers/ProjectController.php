<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Technology;


class ProjectController extends Controller
{
    public function index(Request $request)
        {
            // Haal alle unieke technologieën uit de database
            $technologies = Technology::orderBy('name')->get();

            // Haal de geselecteerde technologieën op
            $selectedTechs = $request->query('technologies', []);

            // Query projecten: filter alleen als er technologieën zijn geselecteerd
            $projects = Project::when(!empty($selectedTechs), function ($query) use ($selectedTechs) {
                return $query->whereHas('technologies', function ($techQuery) use ($selectedTechs) {
                    $techQuery->whereIn('name', $selectedTechs);
                });
            })->orderBy('created_at', 'desc')->get();

            return view('projects.index', compact('projects', 'technologies', 'selectedTechs'));
        }


    public function create()
    {
        return view('projects.create');
    }

    public function edit($id) {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'introduction' => 'required|string|max:500',
            'body' => 'required|string',
            'url' => 'nullable|url',
            'github' => 'nullable|url',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'technologies' => 'array',
            'technologies.*' => 'string|max:50',
        ]);

        $project->update([
            'title' => $request->title,
            'introduction' => $request->introduction,
            'body' => $request->body,
            'url' => $request->url ?: null,
            'github' => $request->github ?: null,
        ]);

        // ✅ Thumbnail updaten
        if ($request->hasFile('thumbnail')) {
            // Oude thumbnail verwijderen
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            // Nieuwe thumbnail opslaan
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailPath = $thumbnailFile->storeAs("projects/{$project->id}", $thumbnailFile->getClientOriginalName(), 'public');
            $project->update(['thumbnail' => $thumbnailPath]);
        }

        // ✅ Extra afbeeldingen updaten
        if ($request->hasFile('images')) {
            // Oude afbeeldingen verwijderen
            foreach ($project->images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }

            // Nieuwe afbeeldingen opslaan
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->storeAs("projects/{$project->id}", $imageFile->getClientOriginalName(), 'public');

                Image::create([
                    'path' => $imagePath,
                    'project_id' => $project->id,
                ]);
            }
        }

        // ✅ Technologieën bijwerken
        if ($request->has('technologies')) {
            $techIds = [];
            foreach ($request->technologies as $tech) {
                $technology = Technology::firstOrCreate(['name' => $tech]);
                $techIds[] = $technology->id;
            }
            $project->technologies()->sync($techIds);
        } else {
            $project->technologies()->detach(); // Verwijder alles als geen nieuwe gekozen zijn
        }

        return redirect()->route('dashboard')->with('success', 'Project succesvol bijgewerkt met afbeeldingen en technologieën!');
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
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'technologies' => 'array',
            'technologies.*' => 'string|max:50',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'introduction' => $request->introduction,
            'body' => $request->body,
            'url' => $request->url ?: null,
            'github' => $request->github ?: null,
            'user_id' => auth()->id(),
        ]);

        // ✅ Thumbnail opslaan
        if ($request->hasFile('thumbnail')) {
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailPath = $thumbnailFile->storeAs("projects/{$project->id}", $thumbnailFile->getClientOriginalName(), 'public');
            $project->update(['thumbnail' => $thumbnailPath]);
        }

        // ✅ Extra afbeeldingen opslaan
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->storeAs("projects/{$project->id}", $imageFile->getClientOriginalName(), 'public');

                Image::create([
                    'path' => $imagePath,
                    'project_id' => $project->id,
                ]);
            }
        }

        // ✅ Koppel technologieën
        if ($request->has('technologies')) {
            $techIds = [];
            foreach ($request->technologies as $tech) {
                $technology = Technology::firstOrCreate(['name' => $tech]);
                $techIds[] = $technology->id;
            }
            $project->technologies()->sync($techIds);
        }

        return redirect()->route('dashboard')->with('success', 'Project succesvol toegevoegd met afbeeldingen en technologieën!');
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

public function toggleFeatured(Request $request, $id)
{
    $project = Project::findOrFail($id);

    // Check hoeveel projecten al uitgelicht zijn
    $featuredCount = Project::where('featured', true)->count();

    // Als de checkbox wordt uitgevinkt, zet de featured-status uit
    if (!$request->has('featured')) {
        $project->update(['featured' => false]);
        return back()->with('success', 'Project is niet meer uitgelicht.');
    }

    // Als er al 3 uitgelichte projecten zijn, stop hier
    if ($featuredCount >= 3) {
        return back()->with('error', 'Je kunt maximaal 3 uitgelichte projecten hebben.');
    }

    // Markeer project als uitgelicht
    $project->update(['featured' => true]);

    return back()->with('success', 'Project is nu uitgelicht.');
}

public function welcome()
{
    $featuredProjects = Project::where('featured', 1)->limit(3)->get();
    return view('welcome', compact('featuredProjects'));
}

}
