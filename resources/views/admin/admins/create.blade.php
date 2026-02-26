<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dodavanje novog administratora
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.admins.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Ime</label>
                        <input type="text" name="ime"
                               class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('ime') }}">
                        @error('ime') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Prezime</label>
                        <input type="text" name="prezime"
                               class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('prezime') }}">
                        @error('prezime') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Korisničko ime</label>
                        <input type="text" name="korisnicko_ime"
                               class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('korisnicko_ime') }}">
                        @error('korisnicko_ime') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email"
                               class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('email') }}">
                        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Password</label>
                        <input type="password" name="password"
                               class="w-full mt-1 rounded border-gray-300">
                        @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            Sačuvaj
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>