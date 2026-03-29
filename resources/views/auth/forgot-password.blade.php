<x-guest-layout>

    <!-- NAVBAR -->
    <nav>
        <div class="logo">
            <img src="{{ asset('images/gardener.png') }}">
            <span>Krishi Farm Center</span>
        </div>

        <!-- Main links -->
        {{-- <ul class="nav-links">
            <li><a href="#hero">Home</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#why">Why Us</a></li>
            <li><a href="#gallery">Gallery</a></li>
        </ul> --}}

        <!-- Auth links -->
        <ul class="nav-auth">
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        </ul>

        <div class="hamburger" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>
    </nav>

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
                {{-- <img src="{{ asset('images/gardener.png') }}" alt="Krishi Logo" class="mx-auto mb-2 w-12 h-12"> --}}
                <span class="text-green-600">Krishi Farm Center</span>
            </a>
            <p class="text-sm text-gray-500 mt-1">
                Reset your account password
            </p>
        </div>

        <h2 class="text-xl font-bold text-center mb-6">
            Forgot your password?
        </h2>

        <p class="text-gray-600 text-sm text-center mb-6">
            Enter your email address and we’ll send you a password reset link.
        </p>

        <form method="POST" action="{{ route('password.email') }}" novalidate>
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">
                    Email address
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                           focus:ring-green-500 focus:border-green-500">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Reset Button -->
            <button type="submit"
                class="w-full bg-green-600 text-white py-2 px-4 rounded-md
                       hover:bg-green-700 transition">
                Send Password Reset Link
            </button>
        </form>

        <!-- Login Link -->
        <div class="mt-4 text-center text-sm">
            Remember your password?
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
            const emailInput = form.querySelector('input[name="email"]');

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

            emailInput.addEventListener('input', () => {
                clearError(emailInput);
                if(flash) flash.remove();
            });

            form.addEventListener('submit', function(e) {
                let valid = true;
                const value = emailInput.value.trim();

                if(value === '') {
                    showError(emailInput, 'This field is required');
                    valid = false;
                } else {
                    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if(!re.test(value)) {
                        showError(emailInput, 'Enter a valid email');
                        valid = false;
                    }
                }

                if(!valid) e.preventDefault();
            });
        });
    </script>

</x-guest-layout>
