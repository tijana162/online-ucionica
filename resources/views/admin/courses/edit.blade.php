<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Izmena kursa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.courses.update', $course) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Semestar</label>
                        <input type="text" name="semestar"
                               class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('semestar', $course->semestar) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Šifra</label>
                        <input type="text" name="sifra"
                               class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('sifra', $course->sifra) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Profesor</label>
                        <input type="text" name="profesor"
                               class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('profesor', $course->profesor) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Opis</label>
                        <textarea name="opis"
                                  class="w-full mt-1 rounded border-gray-300">{{ old('opis', $course->opis) }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Ažuriraj
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>