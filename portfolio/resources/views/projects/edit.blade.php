<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Project Bewerken
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <h1 class="text-xl font-bold text-gray-900 mb-4">Bewerk project: {{ $project->title }}</h1>

                <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Titel -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Titel:</label>
                        <input type="text" name="title" value="{{ $project->title }}" class="w-full p-2 border rounded-md">
                    </div>

                    <!-- Inleiding -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Inleiding:</label>
                        <textarea name="introduction" class="w-full p-2 border rounded-md">{{ $project->introduction }}</textarea>
                    </div>

                    <!-- Body -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Body:</label>
                        <textarea name="body" class="w-full p-2 border rounded-md">{{ $project->body }}</textarea>
                    </div>

                    <!-- URL -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Website URL:</label>
                        <input type="url" name="url" value="{{ $project->url }}" class="w-full p-2 border rounded-md">
                    </div>

                    <!-- GitHub -->
                    <div class="mb-4">
                        <label class="block text-gray-700">GitHub:</label>
                        <input type="url" name="github" value="{{ $project->github }}" class="w-full p-2 border rounded-md">
                    </div>

                    <label class="block mt-4 mb-2 font-semibold text-lg text-gray-700">🛠 Technologieën</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 bg-gray-100 p-4 rounded-lg shadow">

                        @php
                            $categories = [
                                'Frameworks' => ['Laravel', 'Symfony', 'ExpressionEngine', 'WordPress'],
                                'Programmeertalen' => ['PHP', 'JavaScript', 'React', 'Vite', 'CSS', 'TailwindCSS', 'HTML'],
                                'Tools' => ['XAMPP', 'Docker', 'MySQL', 'Live Server'],
                            ];
                        @endphp

                        @foreach ($categories as $category => $technologies)
                            <div class="bg-white p-4 rounded-lg shadow-md border border-gray-300">
                                <h3 class="text-md font-semibold text-purple-700 mb-3">{{ $category }}</h3>
                                <div class="flex flex-wrap flex-col gap-2">
                                    @foreach ($technologies as $tech)
                                        <label class="flex items-center gap-2 bg-gray-200 px-3 py-2 rounded-lg cursor-pointer hover:bg-gray-300 transition">
                                            <input type="checkbox" name="technologies[]" value="{{ $tech }}"
                                                {{ isset($project) && $project->technologies->contains('name', $tech) ? 'checked' : '' }}
                                                class="accent-purple-600">
                                            <span class="text-gray-800">{{ $tech }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <div class="mb-4">
                        <label class="block text-gray-700">Huidige thumbnail:</label>
                        @if ($project->thumbnail)
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" class="h-20 w-20 object-cover rounded-md">
                        @else
                            <p class="text-gray-500">Geen thumbnail geselecteerd</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Nieuwe thumbnail uploaden:</label>
                        <input type="file" name="thumbnail" class="w-full p-2 border rounded-md">
                    </div>

                    <!-- Afbeeldingen -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Huidige afbeeldingen:</label>
                        <div class="flex space-x-2">
                            @foreach($project->images as $image)
                                <img src="{{ asset('storage/' . $image->path) }}" class="h-20 w-20 object-cover rounded-md">
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Nieuwe afbeeldingen uploaden:</label>
                        <input type="file" name="images[]" multiple class="w-full p-2 border rounded-md">
                    </div>

                    <button type="submit" class="bg-blue-500 px-4 py-2 rounded-md hover:bg-blue-600">
                        Opslaan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
