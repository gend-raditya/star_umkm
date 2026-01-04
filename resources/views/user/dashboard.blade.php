@extends('layouts.app')

@section('content')
    <div class="flex min-h-screen font-sans">

        {{-- Side Bar --}}
        @include('layouts.sidebar.user-sidebar')

        {{-- Main Content --}}
        <main class="flex-1 p-6 lg:p-10 transition-all duration-300">

            {{-- Notifikasi Sukses (Modern Floating Toast) --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="fixed top-6 right-6 z-50 flex items-center w-full max-w-sm p-4 text-emerald-700 bg-emerald-50 rounded-xl shadow-lg border border-emerald-100" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-emerald-500 bg-emerald-100 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="ml-3 text-sm font-semibold">{{ session('success') }}</div>
                </div>
            @endif

            <div class="mb-10 animate-fade-in-down">
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                    Selamat Datang, <span class="bg-gradient-to-r from-emerald-500 to-teal-500 bg-clip-text text-transparent">{{ $user->name }}</span> 👋
                </h1>
                <p class="text-gray-500 mt-2">Ini ringkasan aktivitas belanja dan akun Anda hari ini.</p>
            </div>

            @php
                $pendingOrdersCount = \App\Models\Pesanan::where('user_id', $user->id)
                    ->whereIn('status', ['diproses', 'dikirim'])
                    ->count();
            @endphp

            @if ($pendingOrdersCount > 0 && !session('hide_pending_notif'))
                <div x-data="{ show: true }" x-show="show"
                     class="relative bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-100 rounded-2xl p-6 mb-10 shadow-sm animate-fade-in-up">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-amber-100 text-amber-600 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Pesanan Dalam Proses</h4>
                            <p class="text-gray-600 mt-1">Anda memiliki <strong class="text-amber-600">{{ $pendingOrdersCount }} pesanan</strong> yang sedang diproses atau dikirim. Cek statusnya sekarang.</p>
                            <a href="{{ route('pesanan.saya') }}" class="inline-flex items-center mt-3 text-sm font-semibold text-amber-600 hover:text-amber-700">
                                Lihat Detail <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                    <button @click="show = false; fetch('{{ route('notif.hidePending') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 animate-fade-in-up delay-100">

                <a href="{{ route('pesanan.saya') }}" class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-purple-50 rounded-full transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-purple-100 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2 py-1 rounded-lg">Semua Waktu</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800">{{ \App\Models\Pesanan::where('user_id', $user->id)->count() }}</h3>
                        <p class="text-sm text-gray-500 mt-1 group-hover:text-purple-600 transition-colors">Total Pesanan</p>
                    </div>
                </a>

                <a href="{{ route('seller.dashboard') }}" class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-50 rounded-full transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-blue-100 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            @if($user->seller_status == 'approved')
                                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif</span>
                            @else
                                <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2 py-1 rounded-lg">Info</span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 truncate">{{ ucfirst($user->seller_status ?? 'Belum Daftar') }}</h3>
                        <p class="text-sm text-gray-500 mt-1 group-hover:text-blue-600 transition-colors">Status Toko</p>
                    </div>
                </a>

                {{-- Card 3: Pesanan Selesai Milik User --}}
    <a href="{{ route('user.riwayat.pesanan') }}" class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 overflow-hidden">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-emerald-50 rounded-full transition-transform group-hover:scale-110"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-emerald-100 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">Sukses</span>
            </div>
            {{-- FILTER USER ID DI SINI --}}
            <h3 class="text-3xl font-bold text-gray-800">
                {{ \App\Models\Pesanan::where('user_id', Auth::id())->where('status', 'Selesai')->count() }}
            </h3>
            <p class="text-sm text-gray-500 mt-1 group-hover:text-emerald-600 transition-colors">Pesanan Selesai</p>
        </div>
    </a>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 animate-fade-in-up delay-200 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Statistik Belanja Bulanan</h3>
                        <p class="text-sm text-gray-500">Tren jumlah pesanan Anda tahun ini.</p>
                    </div>
                    <div class="p-2 bg-gray-50 rounded-lg border border-gray-200">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    </div>
                </div>
                <div class="h-80 w-full">
                    <canvas id="orderChart"></canvas>
                </div>
            </div>

        </main>
    </div>

    {{-- Data untuk Chart --}}
@php
    // FILTER USER ID DI DALAM QUERY CHART
    $monthlyOrders = \App\Models\Pesanan::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->where('user_id', Auth::id())
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->pluck('count', 'month')
        ->toArray();

    $chartData = [];
    for ($i = 1; $i <= 12; $i++) {
        $chartData[] = $monthlyOrders[$i] ?? 0;
    }
@endphp

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('orderChart').getContext('2d');

        // Gradient untuk grafik
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(139, 92, 246, 0.5)'); // Purple start
        gradient.addColorStop(1, 'rgba(139, 92, 246, 0.0)'); // Purple end

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: @json($chartData), // Data dinamis dari backend
                    borderColor: '#8b5cf6',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    tension: 0.4, // Membuat garis melengkung (smooth)
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#8b5cf6',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' Pesanan';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6',
                            borderDash: [5, 5]
                        },
                        ticks: {
                            precision: 0, // Agar tidak ada desimal (pesanan pasti bulat)
                            color: '#9ca3af',
                            font: { family: "'Inter', sans-serif" }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: '#9ca3af',
                            font: { family: "'Inter', sans-serif" }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });
    </script>

    <style>
        .animate-fade-in-down { animation: fadeInDown 0.8s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
@endsection
