<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalji kursa: {{ $course->sifra }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 text-green-500">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Detalji kursa -->
                <div class="mb-4">
                    <strong>Semestar:</strong> {{ $course->semestar }}
                </div>
                <div class="mb-4">
                    <strong>Šifra:</strong> {{ $course->sifra }}
                </div>
                <div class="mb-4">
                    <strong>Profesor:</strong> {{ $course->profesor }}
                </div>
                <div class="mb-4">
                    <strong>Opis:</strong> {{ $course->opis }}
                </div>

                <hr class="my-4">

                <!-- Lista studenata na kursu -->
                <h3 class="text-lg font-semibold mb-2">Studenti na kursu</h3>
                @if($course->students->count() > 0)
                    <table class="min-w-full mb-4 border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">Ime</th>
                                <th class="px-4 py-2 border">Prezime</th>
                                <th class="px-4 py-2 border">Email</th>
                                <th class="px-4 py-2 border">Akcija</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course->students as $student)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $student->ime }}</td>
                                    <td class="px-4 py-2 border">{{ $student->prezime }}</td>
                                    <td class="px-4 py-2 border">{{ $student->email }}</td>
                                    <td class="px-4 py-2 border">
                                        <form method="POST" action="{{ route('admin.courses.detachStudent', [$course->id, $student->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                                Ukloni sa kursa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mb-4">Trenutno nema prijavljenih studenata.</p>
                @endif

                <hr class="my-4">

                <!-- Dodavanje studenta na kurs -->
                <h3 class="text-lg font-semibold mb-2">Dodaj studenta na kurs</h3>
                <form method="POST" action="{{ route('admin.courses.attachStudent', $course->id) }}">
                    @csrf
                    <select name="student_id" class="border px-2 py-1 mb-2 w-full">
                        <option value="">-- Izaberi studenta --</option>
                        @foreach($allStudents as $student)
                            @if(!$course->students->contains($student->id))
                                <option value="{{ $student->id }}">{{ $student->ime }} {{ $student->prezime }} ({{ $student->email }})</option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Dodaj studenta
                    </button>
                </form>

                <div class="mt-6">
                    <a href="{{ route('admin.courses.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                        Nazad na kurseve
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>