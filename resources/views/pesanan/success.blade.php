@extends('layouts.app')

@section('content')
<section class="py-10 relative">

        <div class="max-w-5xl mx-auto">

            <div class="text-center mb-10 animate-fade-in-down">
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-emerald-100 mb-6">
                    <svg class="h-12 w-12 text-emerald-600 animate-check" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">
                    Pembayaran Berhasil! 🎉
                </h1>
                <p class="text-lg text-gray-500 max-w-2xl mx-auto">
                    Terima kasih telah berbelanja di Star UMKM. Pesanan Anda telah kami terima dan sedang diproses, ditunggu pesanan selanjutnya😊.
                </p>
            </div>

            <div class="bg-white rounded-3xl mb-12 shadow-xl border border-gray-100 overflow-hidden animate-fade-in-up">

                @if($pesanan->count() > 0)
                    <div class="px-0 py-0 mt-12 mb-0 ml-12 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            Riwayat Transaksi Terbaru
                        </h3>
                        <span class="text-sm text-gray-500 bg-white mr-16 px-5 py-1 rounded-full border border-gray-200 shadow-sm">
                            {{ $pesanan->count() }} Pesanan
                        </span>
                    </div>

                    <div class="overflow-x-auto p-12">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/80 text-xs uppercase tracking-wider text-gray-500 font-semibold border-b border-gray-100">
                                    <th class="px-6 py-4 rounded-tl-lg">Invoice</th>
                                    <th class="px-6 py-4">Nama Pelanggan</th>
                                    <th class="px-6 py-4">Kontak</th>
                                    <th class="px-6 py-4 text-right">Total</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4 text-right rounded-tr-lg">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($pesanan as $p)
                                    <tr class="group hover:bg-emerald-50/30 transition-colors duration-200">

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                                <span class="font-mono text-sm font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md border border-emerald-100">
                                                    {{ $p->invoice }}
                                                </span>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <p class="text-sm font-semibold text-gray-800">{{ $p->nama }}</p>
                                        </td>

                                        <td class="px-6 py-4">
                                            <p class="text-sm text-gray-500">{{ $p->no_hp }}</p>
                                        </td>

                                        <td class="px-6 py-4 text-right">
                                            <span class="text-sm font-bold text-gray-900">
                                                Rp {{ number_format($p->total, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            @if($p->status == 'Diproses' || $p->status == 'diproses')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200 shadow-sm">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-1.5 animate-pulse"></span>
                                                    Diproses
                                                </span>
                                            @elseif($p->status == 'Dikirim' || $p->status == 'dikirim')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200 shadow-sm">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                                    Dikirim
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-sm">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    {{ ucfirst($p->status) }}
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-right">
                                            <span class="text-xs text-gray-500 font-medium">
                                                {{ $p->created_at->format('d M Y') }}
                                                <br>
                                                <span class="text-gray-400 text-[10px]">{{ $p->created_at->format('H:i') }} WIB</span>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="relative w-40 h-40 mx-auto mb-4">
                            <div class="absolute inset-0 bg-gray-100 rounded-full animate-pulse"></div>
                            <svg class="relative w-full h-full text-gray-300 p-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada pesanan</h3>
                        <p class="text-gray-500 mt-1">Transaksi Anda akan muncul di sini.</p>
                    </div>
                @endif
            </div>

            <div class="mt-10 text-center animate-fade-in-up delay-100">
                <a href="{{ url('/') }}"
                   class="inline-flex items-center px-8 py-4 border border-transparent text-base font-bold rounded-2xl text-white bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 shadow-lg hover:shadow-emerald-500/30 transform hover:-translate-y-1 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Kembali ke Beranda
                </a>
            </div>

        </div>

    </section>

    <style>
        .animate-check { animation: checkPop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
        .animate-fade-in-down { animation: fadeInDown 0.8s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }

        @keyframes checkPop {
            0% { transform: scale(0); opacity: 0; }
            80% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection
