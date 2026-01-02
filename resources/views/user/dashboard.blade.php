@extends('layouts.app')


@section('content')
    <div class="flex min-h-screen bg-gray-100">

        {{-- Side Bar --}}
        @include('layouts.sidebar.user-sidebar')

        {{-- Main Content --}}
        <main class="flex-1 p-8">
            @if (session('success'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 3000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl shadow-sm flex items-center gap-2">

            <div class="bg-emerald-100 p-1 rounded-full">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif
            <h1 class="text-2xl font-bold mb-6">Selamat Datang, {{ $user->name }} 👋</h1>

            {{-- Notifikasi Pesanan Aktif --}}
            @php
                $pendingOrdersCount = \App\Models\Pesanan::where('user_id', $user->id)
                    ->whereIn('status', ['diproses', 'dikirim'])
                    ->count();
            @endphp

            @if ($pendingOrdersCount > 0 && !$hidePendingNotif)
                <div x-data="{ show: true }" x-show="show"
                    class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded mb-6 relative transition">
                    🚚 Kamu masih punya <strong>{{ $pendingOrdersCount }}</strong> pesanan yang belum selesai.

                    <button
                        @click="
                show = false;
                fetch('{{ route('notif.hidePending') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                });
            "
                        class="absolute top-1 right-2 text-yellow-700 hover:text-yellow-900 font-extrabold text-2xl leading-none">
                        ×
                    </button>
                </div>
            @endif



            {{-- Statistik Ringkas --}}
            <div class="grid md:grid-cols-3 gap-6">
                <a href="{{ route('pesanan.saya') }}"
                    class="bg-white p-4 rounded shadow text-center block hover:bg-purple-50 transition">
                    <p class="text-gray-500">Total Pesanan</p>
                    <h2 class="text-2xl font-bold text-purple-700">
                        {{ \App\Models\Pesanan::where('user_id', $user->id)->count() }}
                    </h2>
                </a>

                <a href="{{ route('seller.dashboard') }}"
                    class="bg-white p-4 rounded shadow text-center block hover:bg-blue-50 transition">
                    <p class="text-gray-500">Status Seller</p>
                    <h2 class="text-2xl font-bold text-blue-700">
                        {{ ucfirst($user->seller_status ?? 'Belum') }}
                    </h2>
                </a>


                <a href="{{ route('user.riwayat.pesanan') }}"
                    class="bg-white p-4 rounded shadow text-center block hover:bg-green-50 transition">
                    <p class="text-gray-500">Lihat</p>
                    <h2 class="text-2xl font-bold text-green-700">
                        Riwayat Pesanan
                    </h2>
                </a>


            </div>

            {{-- Aktivitas Terbaru --}}
            @php
                $recentOrders = \App\Models\Pesanan::where('user_id', $user->id)->latest()->take(5)->get();
            @endphp



            {{-- Grafik Pesanan Bulanan --}}
            <div class="mt-10 bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Statistik Pesanan Bulanan</h2>
                <canvas id="orderChart" height="100"></canvas>
            </div>
        </main>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('orderChart');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: [3, 5, 2, 8, 6, 9], // Dummy data
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#8b5cf6'
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
