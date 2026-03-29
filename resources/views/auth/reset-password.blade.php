<x-guest-layout>

    <div class="max-w-md mx-auto mt-24 p-6 bg-white shadow-md rounded-md">

        <!-- Flash Message Popup -->
        @if(session('status') || session('error'))
            <div id="flash-message"
                class="mb-4 px-4 py-2 rounded shadow-md font-medium transition-opacity duration-500
                {{ session('status') ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300' }}">
                {{ session('status') ?? session('error') }}
            </div>
        @endif

        <!-- Logo -->
        <div class="text-center mb-6">
            <a href="/" class="text-2xl font-bold block">
                Krishi Farm Center
            </a>
            <p class="text-sm text-gray-500 mt-1">
                Set a new password for your account
            </p>
        </div>

        <h2 class="text-xl font-bold text-center mb-6">
            Reset Password
        </h2>

        <form method="POST" action="{{ route('password.store') }}" novalidate>
    @csrf

    <!-- Token -->
    <input type="hidden" name="token" value="{{ request()->route('token') }}">

    <!-- Email -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Email address</label>
        <input type="email" name="email" value="{{ old('email', $email) }}" required autofocus
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                   focus:ring-green-500 focus:border-green-500">
        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- New Password -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">New password</label>
        <input type="password" name="password" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                   focus:ring-green-500 focus:border-green-500">
        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Confirm password</label>
        <input type="password" name="password_confirmation" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                   focus:ring-green-500 focus:border-green-500">
    </div>

    <!-- Reset Button -->
    <button type="submit"
        class="w-full bg-green-600 text-white py-2 px-4 rounded-md
               hover:bg-green-700 transition">
        Reset Password
    </button>
</form>

        <!-- Login Link -->
        <div class="mt-4 text-center text-sm">
            Back to
            <a href="{{ route('login') }}" class="text-green-600 hover:underline">
                Login
            </a>
        </div>
    </div>

    <!-- Flash + Inline Validation JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const flash = document.getElementById('flash-message');

            // Fade flash
            if(flash) setTimeout(() => {
                flash.style.transition = "opacity 0.5s ease";
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }, 5000);

            // Inline validation
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input[type="email"], input[type="password"]');

            function showError(input, message) {
                let error = input.nextElementSibling;
                if(!error || !error.classList.contains('text-red-500')) {
                    error = document.createElement('span');
                    error.classList.add('text-red-500', 'text-sm');
                    input.parentNode.appendChild(error);
                }
                error.textContent = message;
                input.classList.add('border-red-500');
            }

            function clearError(input) {
                let error = input.nextElementSibling;
                if(error && error.classList.contains('text-red-500')) error.remove();
                input.classList.remove('border-red-500');
            }

            inputs.forEach(input => {
                input.addEventListener('input', () => {
                    clearError(input);
                    if(flash) flash.remove();
                });
            });

            form.addEventListener('submit', function(e) {
                let valid = true;
                inputs.forEach(input => {
                    const value = input.value.trim();
                    if(value === '') {
                        showError(input, 'This field is required');
                        valid = false;
                    }
                });
                if(!valid) e.preventDefault();
            });
        });
    </script>

</x-guest-layout>
