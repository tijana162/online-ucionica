<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista studenata
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('admin.students.create') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded">
                    Dodaj studenta
                </a>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6">
                <table class="min-w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">Broj indeksa</th>
                            <th class="border px-4 py-2">Ime</th>
                            <th class="border px-4 py-2">Prezime</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td class="px-4 py-2 border">{{ $student->broj_indeksa }}</td>
                                <td class="border px-4 py-2">{{ $student->ime }}</td>
                                <td class="border px-4 py-2">{{ $student->prezime }}</td>
                                <td class="border px-4 py-2">{{ $student->email }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('admin.students.edit', $student->id) }}"
                                       class="text-blue-500">Izmeni</a>

                                    <form action="{{ route('admin.students.destroy', $student->id) }}"
                                          method="POST"
                                          class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-500"
                                                onclick="return confirm('Da li ste sigurni?')">
                                            Obriši
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>