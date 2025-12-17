<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#003f82] leading-tight">
            Pembayaran E-Paper
        </h2>
    </x-slot>

    <div class="py-8 bg-[#f3f6fb]">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-xl p-6 sm:p-8">
                <h3 class="text-lg font-semibold text-[#003f82] mb-4">
                    Paket: {{ $plan->name }}
                </h3>
                <p class="text-sm text-gray-600 mb-4">
                    Harga:
                    <span class="font-semibold text-[#0050A4]">
                        Rp {{ number_format($plan->price, 0, ',', '.') }}
                    </span>
                    &middot; Durasi: {{ $plan->duration_in_days }} hari
                </p>

                <p class="text-sm text-gray-600 mb-4">
                    Nama: <span class="font-semibold">{{ $transaction->customer_name }}</span><br>
                    No HP: <span class="font-semibold">{{ $transaction->phone }}</span><br>
                    Kota: <span class="font-semibold">{{ $transaction->city }}</span>
                </p>

                <p class="text-xs text-gray-500 mb-6">
                    Order ID: {{ $transaction->order_id }}
                </p>

                <button id="pay-button"
                    class="inline-flex justify-center px-6 py-2.5 bg-[#FF7A00] text-white font-semibold rounded-full shadow hover:bg-[#e56b00]">
                    Bayar Sekarang
                </button>

                <p id="status-text" class="text-sm text-gray-500 mt-4"></p>
            </div>
        </div>
    </div>

    {{-- Script Snap (SANDBOX) --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ $midtransClientKey }}"></script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay(@json($snapToken), {
                onSuccess: function (result) {
                    document.getElementById('status-text').innerText =
                        'Pembayaran berhasil. Langganan akan segera aktif.';
                    // optional: redirect ke halaman success
                    window.location.href = "{{ route('subscriptions.success') }}";
                },
                onPending: function (result) {
                    document.getElementById('status-text').innerText =
                        'Pembayaran masih pending. Silakan selesaikan pembayaran.';
                    console.log(result);
                },
                onError: function (result) {
                    document.getElementById('status-text').innerText =
                        'Terjadi kesalahan pembayaran.';
                    console.error(result);
                },
                onClose: function () {
                    document.getElementById('status-text').innerText =
                        'Popup ditutup sebelum pembayaran selesai.';
                }
            });
        });
    </script>
</x-app-layout>
