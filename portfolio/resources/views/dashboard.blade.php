<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Project Management Systeem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-xl font-bold text-gray-900">Huidige projecten op de website</h1>
                    <a href="{{ route('project-upload') }}" class="bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        + Project toevoegen
                    </a>
                </div>

                <!-- Project Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($projects as $project)
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <!-- Titel -->
                            <h2 class="text-lg font-semibold text-gray-800">{{ $project->title }}</h2>
                            <p class="text-sm text-gray-600 mb-4">{{ $project->introduction }}</p>

                            <!-- Afbeelding (eerste geüploade afbeelding tonen als thumbnail) -->
                            @if ($project->thumbnail)
                                <img src="{{ asset('storage/' . $project->thumbnail) }}" class="w-40 h-40 object-cover rounded-lg">
                            @endif

                            <!-- Actieknoppen -->
                            <div class="flex space-x-2">
                                <a href="{{ route('projects.show', $project->id) }}" class="bg-blue-500 px-3 py-1 rounded-md text-sm hover:bg-blue-600 transition">
                                    Bekijk
                                </a>
                                <a href="{{ route('projects.edit', $project->id) }}" class="bg-yellow-500 px-3 py-1 rounded-md text-sm hover:bg-yellow-600 transition">
                                    Bewerk
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit project wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 px-3 py-1 rounded-md text-sm hover:bg-red-600 transition">
                                        Verwijder
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Geen projecten melding -->
                @if ($projects->isEmpty())
                    <p class="text-gray-500 mt-6 text-center">Er zijn nog geen projecten toegevoegd.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
