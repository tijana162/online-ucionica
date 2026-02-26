<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dodaj studenta
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                <form action="{{ route('admin.students.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label>Ime</label>
                        <input type="text" name="ime" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Prezime</label>
                        <input type="text" name="prezime" class="w-full border p-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="broj_indeksa" class="block text-gray-700">Broj indeksa:</label>
                        <input type="text" name="broj_indeksa" id="broj_indeksa" class="border rounded px-3 py-2 w-full" required>
                        @error('broj_indeksa')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Korisničko ime</label>
                        <input type="text" name="korisnicko_ime" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Email</label>
                        <input type="email" name="email" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Lozinka</label>
                        <input type="password" name="password" class="w-full border p-2" required>
                    </div>

                    <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded">
                        Sačuvaj
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>