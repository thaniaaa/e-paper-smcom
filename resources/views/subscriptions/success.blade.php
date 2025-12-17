<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#003f82] leading-tight">
            Pembayaran Berhasil
        </h2>
    </x-slot>

    <div class="py-8 bg-[#f3f6fb]">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-xl p-6 sm:p-8 text-center">
                <p class="text-lg font-semibold text-green-600 mb-2">
                    Terima kasih!
                </p>
                <p class="text-sm text-gray-600 mb-4">
                    Jika pembayaran sudah terverifikasi oleh sistem Midtrans,
                    langganan e-paper Anda akan otomatis aktif.
                </p>

                <a href="{{ route('subscriptions.my') }}"
                   class="inline-flex justify-center px-6 py-2.5 bg-[#0050A4] text-white text-sm font-semibold rounded-full shadow hover:bg-[#003f82]">
                    Lihat Status Langganan Saya
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
