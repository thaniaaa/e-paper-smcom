<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola E-Paper
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('epapers.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Tambah E-Paper
                </a>
            </div>

            @forelse ($epapers as $epaper)
                <div class="bg-white shadow-sm rounded-lg p-4 mb-3 flex items-start justify-between">
                    <div>
                        <h3 class="font-semibold text-lg">{{ $epaper->title }}</h3>
                        <p class="text-gray-600 text-sm mb-1">
                            {{ $epaper->description }}
                        </p>
                        <p class="text-xs text-gray-400">
                            Dibuat: {{ $epaper->created_at->format('d M Y H:i') }}
                        </p>
                        <p class="text-xs text-gray-500">
                            File: {{ $epaper->file_path }}
                        </p>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('epapers.edit', $epaper) }}"
                           class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Edit
                        </a>

                        <form action="{{ route('epapers.destroy', $epaper) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus e-paper ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p>Belum ada e-paper.</p>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
