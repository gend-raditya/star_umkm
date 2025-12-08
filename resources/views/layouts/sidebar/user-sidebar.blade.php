 {{-- Sidebar --}}
 <aside class="w-64 bg-white shadow-md p-6">
     <div class="flex flex-col items-center">
         <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/default.png') }}"
             class="w-20 h-20 rounded-full mb-3 object-cover">
         <h2 class="font-bold text-lg">{{ $user->name }}</h2>
         <p class="text-sm text-gray-500 mb-6">{{ $user->email }}</p>
     </div>

     <nav class="space-y-2">
         <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded hover:bg-purple-100">
             ⚙️ Akun Saya
         </a>
         <a href="{{ route('pesanan.saya') }}" class="block px-4 py-2 rounded hover:bg-purple-100">
             📦 Pesanan Saya
         </a>

         @if (!$user->is_seller)
             {{-- Tombol buka modal pendaftaran seller --}}
             <button @click="openSellerModal = true"
                 class="w-full text-left px-4 py-2 rounded hover:bg-purple-100 text-blue-600">
                 💼 Ajukan Jadi Seller
             </button>
         @elseif($user->seller_status === 'pending')
             <p class="px-4 py-2 text-yellow-600">⏳ Menunggu Persetujuan</p>
         @elseif($user->seller_status === 'approved')
             <a href="{{ route('seller.dashboard') }}"
                 class="block px-4 py-2 rounded hover:bg-purple-100 text-green-600">
                 🏪 Dashboard Seller
             </a>
         @endif

         <form method="POST" action="{{ route('logout') }}">
             @csrf
             <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600">
                 🚪 Logout
             </button>
         </form>
     </nav>
 </aside>
