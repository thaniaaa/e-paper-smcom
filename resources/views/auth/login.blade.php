<x-guest-layout>

<style>
    body {
        background: #f5f7fb;
    }
    .auth-card {
        width: 420px;
        margin: 40px auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        padding: 30px 35px;
    }
    .auth-logo {
        background: #fff;
        padding: 20px;
        text-align: center;
        border-radius: 10px 10px 0 0;
        margin: -30px -35px 20px -35px;
    }
    .auth-logo img {
        height: 45px;
    }
    .auth-title {
        font-size: 22px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 25px;
    }
    .auth-btn {
        width: 100%;
        background: #0a3d91;
        color: white;
        padding: 10px;
        border-radius: 7px;
        font-weight: bold;
        margin-top: 10px;
        transition: 0.2s;
    }
    .auth-btn:hover {
        opacity: 0.85;
    }
    .auth-link {
        text-align: center;
        margin-top: 18px;
        font-size: 14px;
    }
    .auth-link a {
        color: #0a3d91;
        font-weight: 600;
    }
    .forgot-link {
        text-align: right;
        margin-top: 6px;
        font-size: 14px;
    }
    .forgot-link a {
        color: #0a3d91;
        font-weight: 500;
    }
</style>

{{-- <div class="auth-card">

     <div class="auth-logo">
        <img src="images/logo.png">
    </div>  --}}

    <!-- Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <div class="auth-title">Login</div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" :value="old('email')" required autofocus>
            </x-text-input>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" required>
            </x-text-input>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Lupa Kata Sandi -->
            @if (Route::has('password.request'))
            <div class="forgot-link">
                <a href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            </div>
            @endif
        </div>

        <button class="auth-btn">Login</button>

        <div class="auth-link">
            Belum punya akun? <a href="{{ route('register') }}">Register</a>
        </div>
    </form>
</div>

</x-guest-layout>
