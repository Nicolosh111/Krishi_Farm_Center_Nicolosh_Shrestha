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

    <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-md">

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

        <h2 class="text-xl font-bold text-center mb-6">Register your account</h2>

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <!-- Full Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Your password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Enter password again</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>

            <!-- Role Selection -->
            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700">Register As</label>
                <select id="role" name="role" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                    <option value="farmer" selected>Farmer</option>
                    <option value="expert">Expert</option>
                </select>
                @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Register Button -->
            <button type="submit"
                class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition">
                Register
            </button>
        </form>

        <!-- Login Link -->
        <div class="mt-4 text-center text-sm">
            I already have an account.
            <a href="{{ route('login') }}" class="text-green-600 hover:underline">Login</a>
        </div>
    </div>

    <script>
document.addEventListener("DOMContentLoaded", function() {
    const flash = document.getElementById('flash-message');

    function fadeOut(el) {
        el.style.transition = "opacity 0.5s ease";
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 500);
    }

    if(flash) setTimeout(() => fadeOut(flash), 5000);

    window.dismissFlash = () => { if(flash) fadeOut(flash); }

    // Inline validation
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input, select');

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

    // Remove error on typing/selecting
    inputs.forEach(input => {
        input.addEventListener('input', () => { clearError(input); if(flash) fadeOut(flash); });
        input.addEventListener('change', () => { if(flash) fadeOut(flash); });
    });

    // Validate on submit
    form.addEventListener('submit', function(e) {
        let valid = true;
        const password = form.querySelector('#password').value;

        inputs.forEach(input => {
            if(input.value.trim() === '') {
                showError(input, 'This field is required');
                valid = false;
            } else {
                clearError(input);
            }

            if(input.type === 'email' && input.value.trim() !== '') {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if(!re.test(input.value.trim())) {
                    showError(input, 'Enter a valid email');
                    valid = false;
                }
            }

            if(input.name === 'password_confirmation' && input.value !== password) {
                showError(input, 'Passwords do not match');
                valid = false;
            }
        });

        if(!valid) e.preventDefault();
    });
});
</script>

</x-guest-layout>
