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
