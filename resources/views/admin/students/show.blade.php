<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalji studenta
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <p><strong>Broj indeksa:</strong> {{ $student->broj_indeksa }}</p>
                <p><strong>Ime:</strong> {{ $student->ime }}</p>
                <p><strong>Prezime:</strong> {{ $student->prezime }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Korisničko ime:</strong> {{ $student->korisnicko_ime }}</p>

            </div>
        </div>
    </div>
</x-app-layout>