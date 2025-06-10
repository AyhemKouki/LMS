<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8 space-y-6">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800">Welcome back</h1>
            <p class="mt-2 text-gray-600">Sign in to your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email address')" class="text-gray-700 font-medium" />
                <x-text-input
                    id="email"
                    class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-sm" />
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-800 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>
                <x-text-input
                    id="password"
                    class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-sm" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                    {{ __('Remember me') }}
                </label>
            </div>

            <div>
                <x-primary-button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    {{ __('Sign in') }}
                </x-primary-button>
            </div>
        </form>

        <div class="text-center text-sm text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 hover:underline">
                Sign up
            </a>
        </div>
    </div>
</x-guest-layout>
