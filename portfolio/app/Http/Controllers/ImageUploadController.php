<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\Image;



class ImageUploadController extends Controller
{
    public function upload(Request $request, $projectId) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $project = Project::find($projectId);
        if (!$project) {
            return back()->with('error', 'Project niet gevonden!');
        }

        $imageFile = $request->file('image');

        $fileName = time() . '.' . $imageFile->getClientOriginalExtension();


        if (!$imageFile->isValid()) {
            dd("Bestand is ongeldig, Laravel kan het niet verwerken.");
        }


        $path = Storage::disk('public')->putFileAs(
            "projects/{$projectId}",
            $imageFile,
            $fileName
        );

        $dbPath = str_replace("public/", "", $path);

        Image::create([
            'path' => $dbPath,
            'project_id' => $projectId,
        ]);

        return back()->with('success', 'Afbeelding geüpload!');
    }
}
