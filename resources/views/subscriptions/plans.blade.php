{{-- resources/views/subscriptions/plans.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
    </x-slot>

    <div class="bg-gray-50">

        {{-- =========================
             BAGIAN 1 – TATA CARA LANGGANAN
        ========================== --}}
        @if (!session('error'))
        <section class="bg-[#0B3B8C] text-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

                <h1 class="text-3xl sm:text-4xl font-bold text-center mb-10">
                    Tata Cara Berlangganan E-Paper
                </h1>

                <div class="grid md:grid-cols-2 gap-8 items-start">
                    {{-- Kolom kiri: langkah-langkah --}}
                    <div class="space-y-8 text-sm sm:text-base leading-relaxed">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0 w-9 h-9 rounded-full bg-white/10 flex items-center justify-center font-bold">
                                1
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-1">Pilih Paket & Klik Berlangganan</h3>
                                <p>
                                    Pilih paket langganan yang sesuai (1 Bulan, 6 Bulan, atau 1 Tahun),
                                    lalu klik tombol <span class="font-semibold">“Berlangganan”</span>.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <div class="flex-shrink-0 w-9 h-9 rounded-full bg-white/10 flex items-center justify-center font-bold">
                                2
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-1">Isi Data & Pembayaran</h3>
                                <p>
                                    Isi data yang dibutuhkan lalu selesaikan pembayaran melalui metode yang
                                    tersedia (Transfer Bank, E-Wallet, dll).
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <div class="flex-shrink-0 w-9 h-9 rounded-full bg-white/10 flex items-center justify-center font-bold">
                                3
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-1">Konfirmasi & Aktivasi</h3>
                                <p>
                                    Setelah pembayaran berhasil, sistem akan melakukan
                                    konfirmasi otomatis dan akunmu akan diaktifkan.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <div class="flex-shrink-0 w-9 h-9 rounded-full bg-white/10 flex items-center justify-center font-bold">
                                4
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-1">Akses E-Paper</h3>
                                <p>
                                    Jika langganan sudah aktif, kamu bisa langsung membaca
                                    E-Paper melalui menu <span class="font-semibold">E-Papers</span>.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom kanan: mockup / ilustrasi (bisa ganti gambar sendiri) --}}
                    <div class="bg-white/5 rounded-xl border border-white/10 p-6">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="bg-[#0B3B8C] text-white px-4 py-2 text-sm font-semibold">
                                Contoh Tampilan Pembayaran
                            </div>
                            <div class="p-4 space-y-3 text-xs text-gray-700">
                                <div class="h-8 bg-gray-200 rounded-md"></div>
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="h-16 bg-gray-200 rounded-md"></div>
                                    <div class="h-16 bg-gray-200 rounded-md"></div>
                                    <div class="h-16 bg-gray-200 rounded-md"></div>
                                </div>
                                <div class="h-10 bg-blue-500/90 rounded-md mt-2"></div>
                            </div>
                        </div>

                        {{-- tombol ajakan --}}
                        <div class="mt-6 text-center">
                            <a href="#pilih-paket"
                               class="inline-flex items-center px-5 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-full shadow-md transition">
                                Lakukan Langganan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        {{-- =========================
             BAGIAN 2 – DAFTAR PAKET
        ========================== --}}
        <section id="pilih-paket" class="py-10">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- pesan error / success dari backend (TETAP, TIDAK DIUBAH) --}}
                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- info wajib punya langganan --}}
                <div class="mb-6 p-4 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded-lg text-sm sm:text-base">
                    Untuk mengakses <span class="font-semibold">E-Paper</span>, Anda harus memiliki langganan aktif.
                </div>

                {{-- kartu paket langganan (dari $plans) --}}
                {{-- kartu paket langganan (dari $plans) --}}
<div class="grid md:grid-cols-3 gap-6">
    @foreach ($plans as $plan)
        <div class="bg-white rounded-xl shadow-md border border-gray-100 flex flex-col">
            <div class="px-6 pt-6 pb-4 text-center bg-[#0B3B8C] text-white rounded-t-xl">
                <p class="text-xs tracking-wide">PAKET</p>
                <h3 class="text-xl font-bold uppercase mt-1">
                    {{ $plan->name }}
                </h3>
            </div>

            <div class="px-6 py-6 flex-1 flex flex-col">
                <p class="text-2xl font-extrabold text-center mb-2">
                    Rp {{ number_format($plan->price, 0, ',', '.') }}
                </p>
                <p class="text-center text-gray-600 mb-4 text-sm">
                    Durasi: {{ $plan->duration_in_days }} hari
                </p>

                <ul class="text-sm text-gray-700 space-y-2 mb-6">
                    <li>• Akses penuh semua E-Paper</li>
                    <li>• Tanpa iklan</li>
                    <li>• Bisa diakses kapan saja</li>
                </ul>

                {{-- tombol berlangganan: langsung ke form payment untuk paket ini --}}
                <a href="{{ route('subscriptions.payment', $plan->id) }}"
                   class="mt-auto w-full inline-flex justify-center px-4 py-2 bg-[#0050A4] text-white font-semibold rounded-lg hover:bg-[#003f82] transition">
                    Berlangganan
                </a>
            </div>
        </div>
    @endforeach
</div>


                {{-- tombol cek status langganan --}}
                <div class="mt-8 flex justify-center">
                    <a href="{{ route('subscriptions.my') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-blue-600 text-blue-600 font-semibold hover:bg-blue-600 hover:text-white transition">
                        <span>Lihat Status Langganan Saya</span>
                    </a>
                </div>
            </div>
        </section>

    </div>
</x-app-layout>
