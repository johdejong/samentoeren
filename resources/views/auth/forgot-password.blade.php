<x-guest-layout>
    <a href="/" class="flex justify-center items-center mb-4">
        {{-- <x-application-logo class="w-10 h-10 fill-current text-gray-500"/> --}}
        <img src="{{ asset('storage/icons/logo samen toeren.svg') }}" width="80" class="img-fluid" alt="samen toeren">
    </a>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('dutch.Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <x-label for="email" :value="__('dutch.Email')"/>
        <x-input type="email"
                 name="email"
                 id="email"
                 value="{{ old('email') }}"
                 required
                 autofocus
        />

        <div class="flex items-center justify-end mt-4">
            <x-button class="w-full">
                {{ __('dutch.Email Password Reset Link') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
