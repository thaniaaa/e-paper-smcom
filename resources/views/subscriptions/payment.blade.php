<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#003f82] leading-tight">
            Form Pembayaran E-Paper
        </h2>
    </x-slot>

    <div class="py-8 bg-[#f3f6fb]">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-md rounded-xl p-6 sm:p-8">
                <h3 class="text-lg font-semibold text-[#003f82] mb-4">
                    Paket: {{ $plan->name }}
                </h3>
                <p class="text-sm text-gray-600 mb-6">
                    Harga: <span class="font-semibold text-[#0050A4]">
                        Rp {{ number_format($plan->price, 0, ',', '.') }}
                    </span>
                    &middot; Durasi: {{ $plan->duration_in_days }} hari
                </p>

                <form action="{{ route('subscriptions.subscribe', $plan->id) }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap
                        </label>
                        <input type="text" name="customer_name"
                               value="{{ old('customer_name', $user->name) }}"
                               class="w-full rounded-lg border-gray-300 focus:border-[#0050A4] focus:ring-[#0050A4]"
                               required>
                        @error('customer_name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- No HP --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            No. HP / WhatsApp
                        </label>
                        <input type="text" name="phone"
                               value="{{ old('phone') }}"
                               class="w-full rounded-lg border-gray-300 focus:border-[#0050A4] focus:ring-[#0050A4]"
                               required>
                        @error('phone')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kota --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Kota
                        </label>
                        <input type="text" name="city"
                               value="{{ old('city') }}"
                               class="w-full rounded-lg border-gray-300 focus:border-[#0050A4] focus:ring-[#0050A4]"
                               required>
                        @error('city')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Metode Pembayaran --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Metode Pembayaran
                        </label>
                        <select name="payment_method"
                                class="w-full rounded-lg border-gray-300 focus:border-[#0050A4] focus:ring-[#0050A4]"
                                required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>
                                Transfer Bank
                            </option>
                            <option value="ewallet" {{ old('payment_method') == 'ewallet' ? 'selected' : '' }}>
                                E-Wallet (OVO, GoPay, dll)
                            </option>
                            <option value="virtual_account" {{ old('payment_method') == 'virtual_account' ? 'selected' : '' }}>
                                Virtual Account
                            </option>
                        </select>
                        @error('payment_method')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex justify-between items-center">
                        <a href="{{ route('subscriptions.plans') }}"
                           class="text-sm text-gray-500 hover:text-gray-700">
                            &larr; Kembali ke daftar paket
                        </a>

                        <button type="submit"
                                class="inline-flex justify-center px-6 py-2.5 bg-[#FF7A00] text-white font-semibold rounded-full shadow hover:bg-[#e56b00]">
                            Lanjutkan & Aktifkan Langganan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
