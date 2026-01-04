@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-4 px-4 sm:px-6 lg:px-8 font-sans mt-16">
        <div class="max-w-2xl mx-auto">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 animate-fade-in-down gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Kelola Kategori</h1>
                    <p class="mt-1 text-gray-500">Atur kategori produk untuk memudahkan pencarian pelanggan.</p>
                </div>

                <a href="{{ route('admin.kategori.create') }}"
                   class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg hover:shadow-indigo-500/30 transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Kategori
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-in-up delay-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                                <th class="px-6 py-4 w-20 text-center">No</th>
                                <th class="px-6 py-4">Nama Kategori</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($kategoris as $index => $kategori)
                                <tr class="group hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 text-center text-gray-400 font-medium">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-lg">
                                                {{ substr($kategori->nama, 0, 1) }}
                                            </div>
                                            <span class="font-semibold text-gray-800">{{ $kategori->nama }}</span>
                                        </div>
                                    </td>


                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                                               class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>

                                            <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')"
                                                    class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($kategoris->isEmpty())
                    <div class="p-12 text-center">
                        <div class="inline-block p-4 rounded-full bg-gray-50 mb-4">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada kategori</h3>
                        <p class="text-gray-500 mt-1">Tambahkan kategori baru untuk mulai mengelompokkan produk.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
@endsection
