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

    <!-- LOGIN FORM -->
    <div class="max-w-md mx-auto mt-24 p-6 bg-white shadow-md rounded-md">

        <!-- Flash Message Popup -->
        @if(session('success') || session('error'))
            <div id="flash-message"
                class="mb-4 px-4 py-2 rounded shadow-md font-medium transition-opacity duration-500
                {{ session('success') ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300' }}">
                {{ session('success') ?? session('error') }}
            </div>
        @endif

        <a href="/" class="text-2xl font-bold text-green-600 block text-center mb-6">
            Krishi Farm Center
        </a>

        <h2 class="text-xl font-bold text-center mb-6">Login to your account</h2>

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Your password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>

            <!-- Remember Me -->
            <div class="mb-4 flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
            </div>

             <!-- Forgot Password Link -->
            <div class="mb-4 text-right">
                <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">
                    Forgot your password?
                </a>
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition">
                Login
            </button>
        </form>

        <!-- Register Link -->
        <div class="mt-4 text-center text-sm">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-green-600 hover:underline">Register</a>
        </div>
    </div>

    <!-- JS for flash messages and inline validation -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Flash message fade-out
        const flash = document.getElementById('flash-message');
        if(flash) setTimeout(() => fadeOut(flash), 5000);

        window.dismissFlash = () => { if(flash) fadeOut(flash); }

        function fadeOut(el) {
            el.style.transition = "opacity 0.5s ease";
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        }

        // Inline validation
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input');

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

        // Remove errors on typing
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                clearError(input);
                if(flash) fadeOut(flash);
            });
        });

        // Validate on submit
        form.addEventListener('submit', function(e) {
            let valid = true;

            inputs.forEach(input => {
                if(input.value.trim() === '') {
                    showError(input, 'This field is required');
                    valid = false;
                }

                if(input.type === 'email' && input.value.trim() !== '') {
                    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if(!re.test(input.value.trim())) {
                        showError(input, 'Enter a valid email');
                        valid = false;
                    }
                }
            });

            if(!valid) e.preventDefault();
        });
    });
    </script>
</x-guest-layout>
