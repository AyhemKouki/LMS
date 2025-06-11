<x-guest-layout>
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden flex">
        <!-- Image Section -->
        <div class="hidden md:block md:w-1/2 bg-gray-100">
            <img
                src="{{asset('images/register2.png')}}"
                alt="Registration illustration"
                class="w-full h-full object-cover"
            >
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-8 space-y-6">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-800">Create your account</h1>
                <p class="mt-1 text-gray-600">Join us today</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div class="space-y-2">
                    <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-medium" />
                    <x-text-input
                        id="name"
                        class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Mejri Ahmed" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-600 text-sm" />
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium" />
                    <x-text-input
                        id="email"
                        class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="email"
                        placeholder="example@gmail.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-sm" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <x-text-input
                        id="password"
                        class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-sm" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
                    <x-text-input
                        id="password_confirmation"
                        class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-600 text-sm" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                        {{ __('Already have an account?') }}
                    </a>

                    <x-primary-button class="px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
