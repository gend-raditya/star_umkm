@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card Form Update Profil -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-xl p-6 hover:shadow-2xl transition duration-300">
                <h3 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-200">Edit Profil</h3>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <!-- Nama -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text"
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700"
                            value="{{ old('name', $user->name) }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email"
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700"
                            value="{{ old('email', $user->email) }}" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Foto Profil -->
                    <div>
                        <x-input-label for="foto" :value="__('Foto Profil')" />
                        <input id="foto" name="foto" type="file"
                            class="mt-1 block w-full text-gray-700 dark:text-gray-200" accept="image/*">
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />

                        @if ($user->foto)
                            <div class="mt-3 flex items-center space-x-4">
                                <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil"
                                    class="w-24 h-24 object-cover rounded-full border-2 border-indigo-500 shadow-md">
                                <span class="text-gray-600 dark:text-gray-300">Foto saat ini</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 mt-4">
                        <x-primary-button
                            class="bg-indigo-600 hover:bg-indigo-700 transition">{{ __('Simpan Profil') }}</x-primary-button>
                    </div>
                </form>

                <!-- Tombol Update Password -->
                <div class="mt-6 border-t border-gray-200 dark:border-gray-600 pt-4 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('profile.password') }}"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-medium transition">
                        Update Password
                    </a>


                    {{-- Tombol Delete Account (optional) --}}
                    {{-- <a href="{{ route('profile.delete') }}"
                   class="flex-1 bg-red-600 hover:bg-red-700 text-white text-center py-3 rounded-lg font-medium transition">
                   Delete Account
                </a> --}}
                </div>
            </div>

        </div>
    </div>
@endsection
