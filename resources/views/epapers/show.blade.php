<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $epaper->title }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded p-4 mb-4">
            <p class="text-gray-700 mb-2">
                {{ $epaper->description }}
            </p>

            <a href="{{ $fileUrl }}" target="_blank" class="text-blue-600 underline text-sm">
                Buka di tab baru
            </a>
        </div>

        {{-- Viewer PDF --}}
        <div class="bg-white shadow-sm rounded overflow-hidden" style="height: 80vh;">
            <iframe
                src="{{ $fileUrl }}"
                style="width: 100%; height: 100%; border: none;"
            ></iframe>
        </div>
    </div>
</x-app-layout>
