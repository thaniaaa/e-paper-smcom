<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">

        {{-- HEADER --}}
        <h1 class="text-2xl font-bold text-[#0d47a1] mb-6">
            Pengaturan Profil
        </h1>

        {{-- PROFILE INFORMATION --}}
        <div class="bg-white rounded-xl shadow-md border border-blue-100 p-6 mb-8">
            <h2 class="text-lg font-semibold text-[#0d47a1] mb-2">Informasi Profil</h2>
            <p class="text-gray-600 mb-4">Perbarui informasi profil dan email Anda.</p>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('patch')

                {{-- NAME --}}
                <div>
                    <label class="text-sm font-medium text-[#0d47a1]">Nama</label>
                    <input
                        name="name"
                        type="text"
                        value="{{ old('name', $user->name) }}"
                        class="mt-1 w-full rounded-lg border border-blue-300 focus:ring-[#0d47a1] focus:border-[#0d47a1]"
                    />
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="text-sm font-medium text-[#0d47a1]">Email</label>
                    <input
                        name="email"
                        type="email"
                        value="{{ old('email', $user->email) }}"
                        class="mt-1 w-full rounded-lg border border-blue-300 focus:ring-[#0d47a1] focus:border-[#0d47a1]"
                    />
                </div>

                <button
                    class="mt-4 px-5 py-2 bg-[#0d47a1] text-white rounded-lg font-semibold hover:bg-[#ef6c00]">
                    Simpan Perubahan
                </button>

            </form>
        </div>


        {{-- UPDATE PASSWORD --}}
        <div class="bg-white rounded-xl shadow-md border border-blue-100 p-6">
            <h2 class="text-lg font-semibold text-[#0d47a1] mb-2">Perbarui Password</h2>
            <p class="text-gray-600 mb-4">
                Pastikan akun Anda aman dengan memperbarui password secara berkala.
            </p>

            <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                @method('put')

                {{-- CURRENT PASSWORD --}}
                <div>
                    <label class="text-sm font-medium text-[#0d47a1]">Password Saat Ini</label>
                    <input
                        name="current_password"
                        type="password"
                        class="mt-1 w-full rounded-lg border border-blue-300 focus:ring-[#0d47a1] focus:border-[#0d47a1]"
                    />
                </div>

                {{-- NEW PASSWORD --}}
                <div>
                    <label class="text-sm font-medium text-[#0d47a1]">Password Baru</label>
                    <input
                        name="password"
                        type="password"
                        class="mt-1 w-full rounded-lg border border-blue-300 focus:ring-[#0d47a1] focus:border-[#0d47a1]"
                    />
                </div>

                {{-- CONFIRM --}}
                <div>
                    <label class="text-sm font-medium text-[#0d47a1]">Konfirmasi Password</label>
                    <input
                        name="password_confirmation"
                        type="password"
                        class="mt-1 w-full rounded-lg border border-blue-300 focus:ring-[#0d47a1] focus:border-[#0d47a1]"
                    />
                </div>

                <button
                    class="mt-4 px-5 py-2 bg-[#0d47a1] text-white rounded-lg font-semibold hover:bg-[#003c8f]">
                    Perbarui Password
                </button>

            </form>
        </div>

    </div>
</x-app-layout>
