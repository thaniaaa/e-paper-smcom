{{-- resources/views/epapers/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
    </x-slot>

    <div class="py-8 bg-[#ffff]">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- teks instruksi di atas grid --}}
            <p class="text-sm text-gray-600 mb-6">
                Pilih edisi E-Paper yang ingin Anda baca. Akses penuh tersedia untuk akun dengan langganan aktif.
            </p>

            {{-- grid kartu e-paper --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($epapers as $epaper)
                    @php
                        // nomor edisi: terbaru = angka terbesar
                        // $editionNumber = $epapers->count() - $loop->index;
                        $editionDate = optional($epaper->created_at)->format('d M Y');
                    @endphp

                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-150">
                        {{-- cover (sementara pakai 1 gambar statis) --}}
                        <div class="bg-white">
                            <img
                                src="{{ asset('images/poto_dashboard.png') }}"
                                alt="Cover {{ $epaper->title }}"
                                class="w-full h-60 object-cover object-top">
                        </div>

                        {{-- info bawah dengan latar biru muda --}}
                        <div class="bg-[#e7f0ff] px-4 py-3 space-y-2">

                            {{-- badge Digital / PDF --}}
                            <div class="flex items-center gap-2 text-[11px] font-semibold">
                                <span class="px-2 py-0.5 rounded-full bg-blue-600/90 text-white">
                                    Digital
                                </span>
                                <span class="px-2 py-0.5 rounded-full bg-green-500/90 text-white">
                                    PDF
                                </span>
                            </div>

                            {{-- judul kecil + nomor edisi --}}
                            <div class="mt-1">
                                <p class="text-[11px] text-gray-500 leading-tight">
                                    E-Paper
                                </p>
                                {{-- <p class="text-xs font-semibold text-gray-800">
                                    {{ $editionNumber }}
                                </p> --}}
                            </div>

                            {{-- nama & edisi --}}
                            <div class="mt-1">
                                <p class="text-sm font-semibold text-gray-900 leading-snug">
                                    {{ $epaper->title }}
                                </p>
                                @if ($editionDate)
                                    <p class="text-xs text-gray-600">
                                        Edisi {{ $editionDate }}
                                    </p>
                                @endif
                            </div>

                            {{-- tombol aksi --}}
                            <div class="mt-3">
                                <a
                                    href="{{ route('epapers.show', $epaper) }}"
                                    class="block w-full text-center text-sm font-semibold text-white bg-[#0b3c8c] hover:bg-[#082f6a] rounded-full py-2 transition-colors duration-150"
                                >
                                    Klik untuk membaca →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600 text-sm">
                        Belum ada E-Paper yang tersedia.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
