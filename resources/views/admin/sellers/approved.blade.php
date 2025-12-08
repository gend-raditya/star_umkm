@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Seller Disetujui</h1>

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100 text-left text-gray-600">
                <th class="p-3">Nama Seller</th>
                <th class="p-3">Email</th>
                <th class="p-3">Nomor HP</th>
                <th class="p-3">No Rek</th>
                <th class="p-3">Tgl Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sellers as $seller)
                <tr class="border-b">
                    <td class="p-3">{{ $seller->nama_seller }}</td>
                    <td class="p-3">{{ $seller->user->email }}</td>
                    <td class="p-3">{{ $seller->nomor_hp }}</td>
                    <td class="p-3">{{ $seller->nomor_rekening }}</td>
                    <td class="p-3">{{ $seller->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
