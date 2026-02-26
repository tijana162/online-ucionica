<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista admina
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('admin.admins.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Dodaj novog admina
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">Korisničko ime</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($admins as $admin)
                            <tr>
                                <td class="px-6 py-4">{{ $admin->korisnicko_ime }}</td>
                                <td class="px-6 py-4">{{ $admin->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>