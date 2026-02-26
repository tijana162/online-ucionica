<x-app-layout>

    <h2 class="text-xl font-bold mb-4">Svi kursevi</h2>

    @if(session('success'))
        <div class="mb-4 text-green-500">{{ session('success') }}</div>
    @endif

    <ul class="space-y-4">
        @foreach($courses as $course)
            <li class="border p-4 rounded-md">
                <strong>{{ $course->sifra }}</strong> - {{ $course->profesor }} ({{ $course->semestar }})
                <p>{{ $course->opis }}</p>

                @if($enrolledCourses->contains($course->id))
                    <form method="POST" action="{{ route('student.courses.unenroll', $course->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="mt-2 bg-red-500 text-white px-4 py-1 rounded">Odjavi se</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('student.courses.enroll', $course->id) }}">
                        @csrf
                        <button class="mt-2 bg-green-500 text-white px-4 py-1 rounded">Prijavi se</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
</x-app-layout>