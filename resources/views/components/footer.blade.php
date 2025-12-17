{{-- <footer class="bg-white border-t mt-10"> --}}
<footer class="bg-gray-100 border-t mt-10"> 
    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- LOGO + ALAMAT --}}
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">

            {{-- KIRI: LOGO & INFO --}}
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-3">
                    <img src="{{ asset('images/logo.png') }}" class="h-10" alt="SuaraMerdeka">
                </div>

                <p class="text-gray-700 font-medium">PT Media Merdeka Network</p>
                <p class="text-gray-700">Jalan Pandanaran No 30 Semarang</p>

                <div class="mt-3 flex items-center gap-2 text-gray-700">
                    <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 5l7 7-7 7M10 5l7 7-7 7" />
                    </svg>
                    <p>081325714681, 08122851775</p>
                </div>

                <div class="mt-1 flex items-center gap-2 text-gray-700">
                    <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16 12a4 4 0 00-8 0v1H5a2 2 0 100 4h14a2 2 0 100-4h-3v-1z" />
                    </svg>
                    <p>rep@suaramerdeka.com, iklan@suaramerdeka.com</p>
                </div>
            </div>

            {{-- KANAN: SERTIFIKASI --}}
            <div class="flex-1 md:max-w-md">
                {{-- <div class="bg-gray-200 p-4 rounded-lg flex items-start gap-3 shadow-sm"> --}}
                    {{-- <div>
                        <svg class="h-8 w-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414L9 13.414l4.707-4.707z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div> --}}

                    {{-- {{-- <div>
                        {{-- <p class="font-bold text-gray-900">Suara Merdeka</p>
                        <p class="text-gray-800">Telah diverifikasi oleh Dewan Pers</p>
                        <p class="font-semibold text-gray-900">
                            Sertifikat Nomor 247/DP-Verifikasi/K/V/2018
                        </p> 
                    </div>  
                </div> --}}
            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="text-center text-gray-600 text-sm mt-8">
            © {{ date('Y') }} SuaraMerdeka.com — All Rights Reserved
        </div>

    </div>
</footer>
