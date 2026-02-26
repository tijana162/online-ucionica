<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Izmeni studenta
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Ime</label>
                        <input type="text" name="ime" value="{{ $student->ime }}" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Prezime</label>
                        <input type="text" name="prezime" value="{{ $student->prezime }}" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="broj_indeksa" class="block text-gray-700">Broj indeksa:</label>
                        <input type="text" name="broj_indeksa" id="broj_indeksa" class="border rounded px-3 py-2 w-full" value="{{ old('broj_indeksa', $student->broj_indeksa) }}" required>
                        @error('broj_indeksa')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Korisničko ime</label>
                        <input type="text" name="korisnicko_ime" value="{{ $student->korisnicko_ime }}" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $student->email }}" class="w-full border p-2" required>
                    </div>

                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded">
                        Ažuriraj
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>