<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dodavanje novog kursa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.courses.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Semestar</label>
                        <input type="text" name="semestar"
                               class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('semestar') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Šifra</label>
                        <input type="text" name="sifra"
                               class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('sifra') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Profesor</label>
                        <input type="text" name="profesor"
                               class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('profesor') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Opis</label>
                        <textarea name="opis"
                                  class="w-full mt-1 rounded border-gray-300">{{ old('opis') }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Sačuvaj
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>