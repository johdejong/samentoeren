<x-guest-layout>
    <a href="/" class="flex justify-center items-center">
        {{-- <x-application-logo class="w-20 h-20 text-gray-500 fill-current"/> --}}
        <img src="{{ asset('storage/icons/logo samen toeren.svg') }}" width="80" class="img-fluid" alt="samen toeren">
    </a>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('dutch.Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('dutch.A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-button class="w-full">
                    {{ __('dutch.Resend Verification Email') }}
                </x-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-button class="w-full">
                {{ __('dutch.Log Out') }}
            </x-button>
        </form>
    </div>
</x-guest-layout>
