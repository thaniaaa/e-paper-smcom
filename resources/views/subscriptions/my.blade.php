<x-app-layout>
    <x-slot name="header">
       <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
    </x-slot>

    <div class="py-10 bg-[#F5F7FB]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($sub)
                @php
                    $isActive = $today <= $sub->end_date && $sub->status === 'active';
                @endphp

                {{-- KARTU JIKA SUDAH PUNYA LANGGANAN --}}
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                    {{-- Header biru --}}
                    <div class="bg-[#0D3B8A] text-white text-center py-4">
                        <p class="text-xs tracking-[0.25em] uppercase">PAKET</p>
                        <p class="text-2xl font-bold mt-1">
                            {{ strtoupper($sub->plan->name) }}
                        </p>
                    </div>

                    <div class="px-6 py-6 space-y-5">

                        {{-- Status bar kuning --}}
                        <div
                            class="bg-[#FFF6C2] border border-[#F2E08A] rounded-xl px-4 py-3 flex items-center justify-between">
                            <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                STATUS:
                                @if ($isActive)
                                    <span class="text-green-700">AKTIF</span>
                                @else
                                    <span class="text-red-600">TIDAK AKTIF / EXPIRED</span>
                                @endif
                            </span>

                            <span
                                class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full
                                {{ $isActive ? 'bg-green-600 text-white' : 'bg-red-500 text-white' }}">
                                ● {{ $isActive ? 'Active' : 'Non Active' }}
                            </span>
                        </div>

                        {{-- Periode --}}
                        <div class="border-b border-gray-200 pb-3 text-sm text-gray-700">
                            <span class="font-semibold">Periode:</span>
                            <span class="ml-1">
                                {{ $sub->start_date }} s/d {{ $sub->end_date }}
                            </span>
                        </div>

                        {{-- Keuntungan langganan --}}
                        <div class="text-sm text-gray-700 space-y-2">
                            <p class="font-semibold mb-1">Dengan paket ini Anda mendapatkan:</p>

                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                    <span>Akses penuh semua E-Paper</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                    <span>Tanpa iklan yang mengganggu</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                    <span>Bisa diakses kapan saja selama periode aktif</span>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol utama --}}
                        <div class="pt-2">
                            @if ($isActive)
                                <a href="{{ route('epapers.index') }}"
                                   class="block w-full text-center text-white font-semibold py-3 rounded-full
                                          bg-blue-600 hover:bg-blue-700 transition">
                                    Mulai Baca E-Paper
                                </a>
                            @else
                                <a href="{{ route('subscriptions.plans') }}"
                                   class="block w-full text-center text-white font-semibold py-3 rounded-full
                                          bg-blue-600 hover:bg-blue-700 transition">
                                    Perpanjang / Pilih Paket Lagi
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                {{-- KARTU JIKA BELUM BERLANGGANAN --}}
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                    {{-- Header biru --}}
                    <div class="bg-[#0D3B8A] text-white text-center py-4">
                        <p class="text-xs tracking-[0.25em] uppercase">PAKET</p>
                        <p class="text-2xl font-bold mt-1">
                            BELUM BERLANGGANAN
                        </p>
                    </div>

                    <div class="px-6 py-6 space-y-5">

                        {{-- Status bar kuning --}}
                        <div
                            class="bg-[#FFF6C2] border border-[#F2E08A] rounded-xl px-4 py-3 flex items-center justify-between">
                            <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                STATUS: <span class="text-red-600">BELUM AKTIF</span>
                            </span>

                            <span
                                class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-red-500 text-white">
                                ● Not Subscribed
                            </span>
                        </div>

                        {{-- Penjelasan --}}
                        <div class="text-sm text-gray-700 leading-relaxed">
                            Anda belum memiliki langganan aktif untuk mengakses E-Paper.
                            Silakan pilih paket langganan untuk mulai membaca edisi lengkap setiap hari.
                        </div>

                        {{-- Tombol ke halaman paket --}}
                        <div class="pt-2">
                            <a href="{{ route('subscriptions.plans') }}"
                               class="block w-full text-center text-white font-semibold py-3 rounded-full
                                      bg-blue-600 hover:bg-blue-700 transition">
                                Pilih Paket &amp; Berlangganan
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
