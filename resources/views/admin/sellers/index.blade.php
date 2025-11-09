@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Persetujuan Seller</h1>

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100 text-left text-gray-600">
                <th class="p-3">Nama</th>
                <th class="p-3">Email</th>
                <th class="p-3">Status</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sellers as $seller)
                <tr class="border-b">
                    <td class="p-3">{{ $seller->name }}</td>
                    <td class="p-3">{{ $seller->email }}</td>
                    <td class="p-3 capitalize">{{ $seller->seller_status }}</td>
                    <td class="p-3 flex gap-2">
                        <form action="{{ route('admin.sellers.approve', $seller->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Setujui</button>
                        </form>
                        <form action="{{ route('admin.sellers.reject', $seller->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Tolak</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
