<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- ===================
                 KIRI: LOGO + MENU
               =================== --}}
            <div class="flex items-center gap-10">

                {{-- Logo
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <x-application-logo class="block h-8 w-auto text-gray-800" />
                </a> --}}

                {{-- Menu Desktop --}}
                <div class="hidden md:flex items-center space-x-6">

                    {{-- Home --}}
                    <a href="{{ route('dashboard') }}"
                       class="text-sm font-semibold {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                        Home
                    </a>

                    {{-- Langganan --}}
                    <a href="{{ route('subscriptions.plans') }}"
                       class="text-sm font-semibold {{ request()->routeIs('subscriptions.plans') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                        Langganan
                    </a>

                    {{-- E-Papers (untuk user berlangganan; route sudah pakai middleware) --}}
                    <a href="{{ route('epapers.index') }}"
                       class="text-sm font-semibold {{ request()->routeIs('epapers.index') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                        E-Papers
                    </a>

                </div>

            </div>

            {{-- ===================
                 KANAN: DROPDOWN AKUN
               =================== --}}
            <div class="hidden md:flex items-center">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        {{-- =====================
                             ADMIN MENUS (DESKTOP)
                           ===================== --}}
                        @if (Auth::user()->role === 'admin')
                            <x-dropdown-link :href="route('epapers.create')">
                                📄 Upload E-Paper
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('epapers.manage')">
                                🗂 Kelola E-Paper
                            </x-dropdown-link>
                        @endif

                        {{-- Profile --}}
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>
            </div>

            {{-- ===================
                 HAMBURGER (MOBILE)
               =================== --}}
            <div class="md:hidden flex items-center">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- ===================
         MOBILE MENU
       =================== --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1 px-4">

            {{-- Home --}}
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Home
            </x-responsive-nav-link>

            {{-- Langganan --}}
            <x-responsive-nav-link :href="route('subscriptions.plans')" :active="request()->routeIs('subscriptions.plans')">
                Langganan
            </x-responsive-nav-link>

            {{-- E-Papers --}}
            <x-responsive-nav-link :href="route('epapers.index')" :active="request()->routeIs('epapers.index')">
                E-Papers
            </x-responsive-nav-link>

        </div>

        {{-- USER + ADMIN MOBILE --}}
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-4">

                {{-- ADMIN MENUS (MOBILE) --}}
                @if (Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('epapers.create')">
                        📄 Upload E-Paper
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('epapers.manage')">
                        🗂 Kelola E-Paper
                    </x-responsive-nav-link>
                @endif

                {{-- Profile --}}
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
