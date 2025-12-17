<x-app-layout>
    {{-- Kita nggak pakai header default yang panjang, cukup kecil saja --}}
    <x-slot name="header">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
</x-slot>

   

    <div class="bg-blue-900 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16 lg:py-20">
            <div class="grid md:grid-cols-2 gap-10 items-center">

                {{-- KIRI: teks hero --}}
                <div>
                    <p class="uppercase tracking-wide text-sm text-blue-200 mb-2">
                        E-Paper Suara Merdeka
                    </p>

                    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight mb-4">
                        E-Paper<br>
                        Terupdate
                    </h1>

                    <p class="text-blue-100 text-base sm:text-lg mb-8 max-w-md">
                        Dapatkan berita terbaru dan terlengkap setiap hari.
                        Klik langganan untuk akses penuh ke seluruh e-paper.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        {{-- Tombol utama: menuju halaman paket langganan --}}
                        <a href="{{ route('subscriptions.plans') }}"
                           class="inline-flex items-center justify-center px-6 py-3 rounded-lg
                                  bg-orange-500 hover:bg-orange-600
                                  font-semibold text-white shadow-lg shadow-orange-500/40
                                  transition-colors duration-150">
                            LANGGANAN SEKARANG
                        </a>

                        {{-- Link sekunder opsional --}}
                        {{-- <a href="{{ route('epapers.index') }}"
                           class="text-sm font-semibold text-blue-100 underline decoration-blue-200">
                            Lihat daftar E-Paper
                        </a> --}}
                    </div>
                </div>

                {{-- KANAN: mockup laptop / gambar e-paper --}}
                <div class="flex justify-center">
                    <div
                        class="relative w-full max-w-md bg-slate-900 rounded-3xl shadow-2xl overflow-hidden
                               border border-slate-700">
                        {{-- “Bezel” laptop --}}
                        <div class="bg-slate-800 h-7 flex items-center justify-center">
                            <span class="w-16 h-1.5 bg-slate-700 rounded-full"></span>
                        </div>

                        {{-- Layar: kamu bisa ganti src dengan gambar e-paper kamu sendiri --}}
                        <div class="bg-white">
                            <img
                                src="{{ asset('images\poto_dashboard.png') }}"
                                alt="Preview E-Paper"
                                class="w-full h-64 object-cover object-top">
                        </div>

                        {{-- Bagian bawah laptop --}}
                        <div class="h-5 bg-slate-900 flex items-center justify-center">
                            <div class="w-24 h-1.5 bg-slate-700 rounded-full"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- (Opsional) Section informasi tambahan di bawah hero --}}
    <div class="py-10 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-2">Akses Kapan Saja</h3>
                <p class="text-sm text-gray-600">
                    Baca e-paper melalui laptop atau perangkat mobile di mana pun kamu berada.
                </p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-2">Konten Lengkap</h3>
                <p class="text-sm text-gray-600">
                    Nikmati versi digital yang sama dengan koran fisik, tanpa takut kehabisan.
                </p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-2">Berlangganan Fleksibel</h3>
                <p class="text-sm text-gray-600">
                    Pilih paket 1 bulan, 6 bulan, atau 1 tahun sesuai kebutuhan kamu.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
