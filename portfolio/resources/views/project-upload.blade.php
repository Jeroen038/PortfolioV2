<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Nieuw Project Toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Titel -->
                    <label class="block mb-2 font-semibold">Titel</label>
                    <input type="text" name="title" class="border border-gray-300 p-2 rounded w-full" required>

                    <!-- Inleiding -->
                    <label class="block mt-4 mb-2 font-semibold">Inleiding</label>
                    <textarea name="introduction" class="border border-gray-300 p-2 rounded w-full" required></textarea>

                    <!-- Paragraph (Body) -->
                    <label class="block mt-4 mb-2 font-semibold">Hoofdtekst</label>
                    <textarea name="body" class="border border-gray-300 p-2 rounded w-full" rows="5" required></textarea>

                    <!-- URL -->
                    <label class="block mt-4 mb-2 font-semibold">Live URL (optioneel)</label>
                    <input type="url" name="url" class="border border-gray-300 p-2 rounded w-full">

                    <!-- GitHub Link -->
                    <label class="block mt-4 mb-2 font-semibold">GitHub Repo (optioneel)</label>
                    <input type="url" name="github" class="border border-gray-300 p-2 rounded w-full">

                    <div class="mt-4">
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


                    <!-- Thumbnail -->
                    <label class="block mt-4 mb-2 font-semibold">Thumbnail</label>
                    <input type="file" name="thumbnail" class="border border-gray-300 p-2 rounded w-full">

                    <!-- ✅ Afbeeldingen Uploaden -->
                    <label class="block mt-4 mb-2 font-semibold">Afbeeldingen (Meerdere toegestaan)</label>
                    <input type="file" name="images[]" multiple class="border border-gray-300 p-2 rounded w-full">

                    <!-- Submit -->
                    <button type="submit" class="bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 transition mt-4">
                        Project Opslaan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
