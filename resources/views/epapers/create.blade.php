<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Upload E-Paper</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form action="{{ route('epapers.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 shadow rounded">
            @csrf

            <div class="mb-4">
                <label class="font-bold">Judul</label>
                <input type="text" name="title" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="font-bold">Deskripsi</label>
                <textarea name="description" class="w-full border rounded p-2"></textarea>
            </div>

            <div class="mb-4">
                <label class="font-bold">File PDF</label>
                <input type="file" name="file" accept="application/pdf">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Upload
            </button>
        </form>
    </div>
</x-app-layout>
