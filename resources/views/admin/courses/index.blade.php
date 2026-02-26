<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista kurseva
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('admin.courses.create') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Dodaj kurs
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">Opis</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Profesor</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Akcije</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($courses as $course)
                            <tr>
                                <td class="px-6 py-4">{{ $course->opis }}</td>
                                <td class="px-6 py-4">{{ $course->profesor }}</td>
                                <td class="px-6 py-4 space-x-2">
                                      <a href="{{ route('admin.courses.show', $course->id) }}"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                            Dodela kursa
                                        </a>
                                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                                       class="text-blue-600 hover:underline">
                                        Izmeni
                                    </a>

                                    <form action="{{ route('admin.courses.destroy', $course->id) }}"
                                          method="POST"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:underline">
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