<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Krishi Farm Center Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">
  <aside class="hidden md:flex w-64 bg-green-800 text-white flex-col">
  <div class="p-6 text-2xl font-bold">
    Krishi<span class="text-yellow-400">Center</span>
  </div>
  <nav class="flex-1 px-4 space-y-2">
    <a href="#" data-section="dashboard" class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
      <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
    </a>
    <a href="#" data-section="users"
        class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-users mr-2"></i> Users
    </a>

    {{-- <a href="#" data-section="crops"
        class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-seedling mr-2"></i> Manage Crops
    </a>

    <a href="#" data-section="diseases"
        class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-virus mr-2"></i> Manage Diseases
    </a> --}}

    <a href="#" data-section="stories"
        class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-book-reader mr-2"></i> Agro Stories
    </a>

  </nav>

  <div class="p-4 border-t border-green-700">
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit"
            class="flex items-center p-2 rounded hover:bg-red-600 hover:text-white transition-colors duration-300 ease-in-out w-full text-left">
      <i class="fas fa-sign-out-alt mr-2"></i> Logout
    </button>
  </form>
</div>
</aside>

  <!-- Main content -->
  <main class="flex-1 p-6">
    <!-- Topbar -->
    <div class="flex justify-between items-center bg-white shadow rounded p-4 mb-6">
    <button id="menuBtn" class="md:hidden text-gray-700 text-2xl">
        <i class="fas fa-bars"></i>
    </button>

    <div>
        <h1 class="text-xl font-semibold">Admin Dashboard</h1>
        <!-- Welcome message -->
        <p class="text-sm text-green-700 mt-1 flex items-center">
        <i class="fas fa-user-shield mr-2 text-green-600"></i>
        Welcome, {{ Auth::user()->name }}
        </p>
    </div>

    <div class="relative">
        <button id="profileBtn" class="flex items-center space-x-2 bg-gray-100 px-3 py-2 rounded hover:bg-gray-200">
        <i class="fas fa-user-circle text-gray-700 text-xl"></i>
        <span class="text-gray-700">{{ Auth::user()->name }}</span>
        <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
        </button>
        <!-- Dropdown -->
        <ul id="profileMenu" class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded hidden">
        <li>
        <a href="#" id="profileLink" data-section="profile" class="nav-link block px-4 py-2 hover:bg-yellow-500 hover:text-white">
            <i class="fas fa-id-badge mr-2"></i> Profile
        </a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left block px-4 py-2 hover:bg-yellow-500 hover:text-white">
                <i class="fas fa-right-from-bracket mr-2"></i> Logout
            </button>
            </form>
        </li>
        </ul>
    </div>
    </div>

    <!-- Dashboard Section -->
    <section id="dashboard">
    {{-- <section id="dashboard" class="{{ request('section') ? 'hidden' : '' }}"> --}}

    <h2 class="text-xl font-semibold mb-4">Dashboard Overview</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
        <div>
            <h3 class="text-gray-500 text-sm">Total Farmers</h3>
            <p class="text-2xl font-bold text-green-700"></p>
        </div>
        <i class="fas fa-tractor text-green-500 text-2xl"></i>
        </div>
        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
        <div>
            <h3 class="text-gray-500 text-sm">Experts</h3>
            <p class="text-2xl font-bold text-green-700"></p>
        </div>
        <i class="fas fa-user-tie text-blue-500 text-2xl"></i>
        </div>
        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
        <div>
            <h3 class="text-gray-500 text-sm">Users</h3>
            <p class="text-2xl font-bold text-green-700"></p>
        </div>
        <i class="fas fa-users text-purple-500 text-2xl"></i>
        </div>
        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
        <div>
            <h3 class="text-gray-500 text-sm">Agro Stories</h3>
            <p class="text-2xl font-bold text-green-700"></p>
        </div>
        <i class="fas fa-book-open text-yellow-500 text-2xl"></i>
        </div>
    </div>
    </section>

    {{-- <section id="inventory" class="hidden">
  <div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Farmers</h2>

    <!-- Search Bar -->
    <div class="flex items-center mb-4">
      <input type="text" id="farmerSearch" placeholder="Search farmers..."
             class="flex-1 px-3 py-2 border rounded-l focus:outline-none focus:ring-2 focus:ring-yellow-500"/>
      <button class="bg-yellow-500 text-white px-4 py-2 rounded-r hover:bg-yellow-600">
        <i class="fas fa-search"></i>
      </button>
    </div>

    <!-- Farmers Table -->
    <table class="min-w-full border border-gray-200 rounded-lg text-sm md:text-base">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Crop</th>
          <th class="px-4 py-2">Location</th>
          <th class="px-4 py-2">Status</th>
        </tr>
      </thead>
      <tbody id="farmerTable">
        <tr class="border-t hover:bg-gray-50">
          <td class="px-4 py-2">Ram Koirala</td>
          <td class="px-4 py-2">Wheat</td>
          <td class="px-4 py-2">Biratnagar</td>
          <td class="px-4 py-2 text-green-600">Active</td>
        </tr>
        <tr class="border-t hover:bg-gray-50">
          <td class="px-4 py-2">Sita Sharma</td>
          <td class="px-4 py-2">Rice</td>
          <td class="px-4 py-2">Dharan</td>
          <td class="px-4 py-2 text-yellow-600">Pending</td>
        </tr>
      </tbody>
    </table>
  </div>
</section> --}}

    <!-- Farmers Section -->
    {{-- <section id="inventory" class="hidden">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Farmers</h2>
        <table class="min-w-full border border-gray-200 rounded-lg text-sm md:text-base">
        <thead class="bg-gray-100">
            <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Crop</th>
            <th class="px-4 py-2">Location</th>
            <th class="px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t hover:bg-gray-50">
            <td class="px-4 py-2">Ram Koirala</td>
            <td class="px-4 py-2">Wheat</td>
            <td class="px-4 py-2">Biratnagar</td>
            <td class="px-4 py-2 text-green-600">Active</td>
            </tr>
            <tr class="border-t hover:bg-gray-50">
            <td class="px-4 py-2">Sita Sharma</td>
            <td class="px-4 py-2">Rice</td>
            <td class="px-4 py-2">Dharan</td>
            <td class="px-4 py-2 text-yellow-600">Pending</td>
            </tr>
        </tbody>
        </table>
    </div>
    </section> --}}

    {{-- <section id="orders" class="hidden">
  <div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Experts</h2>

    <!-- Search Bar -->
    <div class="flex items-center mb-4">
      <input type="text" id="expertSearch" placeholder="Search experts..."
             class="flex-1 px-3 py-2 border rounded-l focus:outline-none focus:ring-2 focus:ring-yellow-500"/>
      <button class="bg-yellow-500 text-white px-4 py-2 rounded-r hover:bg-yellow-600">
        <i class="fas fa-search"></i>
      </button>
    </div>

    <!-- Expert Cards -->
    <div id="expertList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div class="p-4 border rounded bg-green-50">
        <h3 class="font-semibold">Dr. Hari Prasad</h3>
        <p>Specialization: Soil Science</p>
        <p>Status: <span class="text-green-600">Available</span></p>
      </div>
      <div class="p-4 border rounded bg-yellow-50">
        <h3 class="font-semibold">Anita KC</h3>
        <p>Specialization: Crop Management</p>
        <p>Status: <span class="text-yellow-600">Busy</span></p>
      </div>
    </div>
  </div>
</section> --}}

    {{-- <!-- Experts Section -->
    <section id="orders" class="hidden">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Experts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="p-4 border rounded bg-green-50">
            <h3 class="font-semibold">Dr. Hari Prasad</h3>
            <p>Specialization: Soil Science</p>
            <p>Status: <span class="text-green-600">Available</span></p>
        </div>
        <div class="p-4 border rounded bg-yellow-50">
            <h3 class="font-semibold">Anita KC</h3>
            <p>Specialization: Crop Management</p>
            <p>Status: <span class="text-yellow-600">Busy</span></p>
        </div>
        </div>
    </div>
    </section> --}}

        <!-- Users Section -->
    <section id="users" class="hidden">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Users</h2>
        <table class="min-w-full border border-gray-200 rounded-lg text-sm md:text-base">

           @if(session('success'))
            <div id="success-msg" class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                const msg = document.getElementById('success-msg');
                if (msg) {
                    msg.remove();
                }
                }, 3000); // msg disappears after 3 seconds
            </script>
        @endif

        <thead class="bg-gray-100">
            <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Role</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">{{ ucfirst($user->role) }}</td>
                <td class="px-4 py-2 {{ $user->is_approved ? 'text-green-600' : 'text-yellow-600' }}">
                    {{ $user->is_approved ? 'Approved' : 'Pending' }}
                </td>
                <td class="px-4 py-2">
                    @if($user->role === 'expert' && !$user->is_approved)
                    <form method="POST" action="{{ route('admin.experts.approve', $user->id) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                    </form>

                    <form method="POST" action="{{ route('admin.experts.reject', $user->id) }}" class="inline ml-2">
                        @csrf
                        @method('PATCH')
                        <button class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                    </form>
                    @endif
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline ml-2">
                        @csrf @method('DELETE')
                        <button class="bg-gray-500 text-white px-2 py-1 rounded">Delete</button>
                    </form>
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </section>

    {{-- <!-- Manage Crops Section -->
    <section id="crops" class="hidden">

    <div class="bg-white shadow rounded-lg p-6">

        <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Manage Crops</h2>
        <button onclick="toggleCropForm()"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition flex items-center">
            <i class="fas fa-plus mr-2"></i> Create New Crop
        </button>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div id="success-msg" class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
            const msg = document.getElementById('success-msg');
            if (msg) { msg.remove(); }
            }, 3000);
        </script>
        @endif


{{-- <div id="create-crop-form" class="hidden mb-6"> --}}

<!-- Create Crop Form (hidden by default) -->
{{-- <div id="create-crop-form" class="{{ $errors->any() ? '' : 'hidden' }} mb-6">
    <form method="POST" action="{{ route('crops.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Crop Image -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Crop Image</label>
            <input type="file" name="image" class="block w-full border border-gray-300 rounded p-2">
            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Crop Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Crop Name</label>
            <input type="text" name="name"
                   value="{{ old('name') }}"
                   class="block w-full border border-gray-300 rounded p-2"
                   placeholder="Enter crop name">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Crop Description -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" rows="4"
                        class="w-full border rounded px-3 py-2 @error('description') border-red-500 @enderror"
                        placeholder="Enter crop details...">{{ old('description') }}</textarea>
            @error('description')
                <p class="error-msg text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Region -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Region</label>
            <select name="region" class="block w-full border border-gray-300 rounded p-2">
                <option value="">Select Region</option>
                <option value="everest" {{ old('region') == 'everest' ? 'selected' : '' }}>Everest Region</option>
                <option value="terai" {{ old('region') == 'terai' ? 'selected' : '' }}>Terai</option>
                <option value="hills" {{ old('region') == 'hills' ? 'selected' : '' }}>Hills</option>
            </select>
            @error('region')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Best Season -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Best Season</label>
            <select name="best_season" class="block w-full border border-gray-300 rounded p-2">
                <option value="">Select Season</option>
                <option value="summer" {{ old('best_season') == 'summer' ? 'selected' : '' }}>Summer</option>
                <option value="winter" {{ old('best_season') == 'winter' ? 'selected' : '' }}>Winter</option>
                <option value="spring" {{ old('best_season') == 'spring' ? 'selected' : '' }}>Spring</option>
                <option value="autumn" {{ old('best_season') == 'autumn' ? 'selected' : '' }}>Autumn</option>
            </select>
            @error('best_season')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="block w-full border border-gray-300 rounded p-2">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex gap-2">
            <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition flex items-center">
                <i class="fas fa-save mr-2"></i> Save Crop
            </button>
            <button type="button" onclick="toggleCropForm()"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition flex items-center">
                <i class="fas fa-times mr-2"></i> Cancel
            </button>
        </div>
    </form>
</div>

<script>
document.querySelectorAll('input, select').forEach(field => {
    field.addEventListener('input', () => {
        const errorMsg = field.parentElement.querySelector('.text-red-600');
        if (errorMsg) errorMsg.style.display = 'none';
    });
});
</script>

        <!-- Crops Table -->
<table class="min-w-full border border-gray-200 rounded-lg text-sm md:text-base">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2">Image</th>
            <th class="px-4 py-2">Crop Name</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Region</th>
            <th class="px-4 py-2">Best Season</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($crops as $crop)
        <tr class="border-t hover:bg-gray-50">
            <td class="px-4 py-2">
                <img src="{{ asset('storage/' . $crop->image) }}" alt="{{ $crop->name }}" class="h-16 w-16 object-cover rounded">
            </td>
            <td class="px-4 py-2 font-medium">{{ $crop->name }}</td>
            <td class="px-4 py-2">{{ $crop->description }}</td>
            <td class="px-4 py-2">{{ ucfirst($crop->region) }}</td>
            <td class="px-4 py-2">{{ ucfirst($crop->best_season) }}</td>
            <td class="px-4 py-2 {{ $crop->status === 'active' ? 'text-green-600' : 'text-yellow-600' }}">
                {{ ucfirst($crop->status) }}
            </td>
            <td class="px-4 py-2">
    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 space-y-2 sm:space-y-0">
        <!-- Edit Button -->
        <button onclick="document.getElementById('edit-form-{{ $crop->id }}').classList.toggle('hidden')"
                class="bg-blue-500 text-white px-2 py-1 rounded w-full sm:w-auto text-center">
            Edit
        </button>

        <!-- Delete Button -->
        <form method="POST" action="{{ route('crops.destroy', $crop->id) }}" class="w-full sm:w-auto">
            @csrf @method('DELETE')
            <button class="bg-red-500 text-white px-2 py-1 rounded w-full sm:w-auto text-center">
                Delete
            </button>
        </form>
    </div>
</td>
        </tr>

        <!-- Inline Edit Form (hidden by default) -->
        <tr id="edit-form-{{ $crop->id }}" class="hidden bg-gray-50">
            <td colspan="6" class="p-4">
                <form method="POST" action="{{ route('crops.update', $crop->id) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Current Image -->
                    @if($crop->image)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Current Image</label>
                            <img src="{{ asset('storage/'.$crop->image) }}" alt="Crop Image"
                                 class="w-32 h-32 object-cover mb-2 border rounded">
                        </div>
                    @endif

                    <!-- Upload New Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upload New Image</label>
                        <input type="file" name="image" class="block w-full border border-gray-300 rounded p-2">
                        @error('image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Crop Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Crop Name</label>
                        <input type="text" name="name"
                               value="{{ old('name', $crop->name) }}"
                               class="block w-full border border-gray-300 rounded p-2">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                     <!-- Crop Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                                class="block w-full border border-gray-300 rounded p-2 @error('description') border-red-500 @enderror"
                                placeholder="Enter crop details...">{{ old('description', $crop->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Region -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Region</label>
                        <select name="region" class="block w-full border border-gray-300 rounded p-2">
                            <option value="">Select Region</option>
                            <option value="everest" {{ old('region', $crop->region) == 'everest' ? 'selected' : '' }}>Everest Region</option>
                            <option value="terai" {{ old('region', $crop->region) == 'terai' ? 'selected' : '' }}>Terai</option>
                            <option value="hills" {{ old('region', $crop->region) == 'hills' ? 'selected' : '' }}>Hills</option>
                        </select>
                        @error('region')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Best Season -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Best Season</label>
                        <select name="best_season" class="block w-full border border-gray-300 rounded p-2">
                            <option value="">Select Season</option>
                            <option value="summer" {{ old('best_season', $crop->best_season) == 'summer' ? 'selected' : '' }}>Summer</option>
                            <option value="winter" {{ old('best_season', $crop->best_season) == 'winter' ? 'selected' : '' }}>Winter</option>
                            <option value="spring" {{ old('best_season', $crop->best_season) == 'spring' ? 'selected' : '' }}>Spring</option>
                            <option value="autumn" {{ old('best_season', $crop->best_season) == 'autumn' ? 'selected' : '' }}>Autumn</option>
                        </select>
                        @error('best_season')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="block w-full border border-gray-300 rounded p-2">
                            <option value="active" {{ old('status', $crop->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $crop->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-2">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition flex items-center">
                            <i class="fas fa-save mr-2"></i> Update Crop
                        </button>
                        <button type="button"
                                onclick="document.getElementById('edit-form-{{ $crop->id }}').classList.add('hidden')"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition flex items-center">
                            <i class="fas fa-times mr-2"></i> Cancel
                        </button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
</section> --}}

    <!-- Toggle Script -->
    {{-- <script>
    function toggleCropForm() {
        document.getElementById('create-crop-form').classList.toggle('hidden');
    }
    </script> --}}

{{--
<!-- Manage Diseases Section -->
<section id="diseases" class="hidden">

    <div class="bg-white shadow rounded-lg p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Manage Diseases</h2>
            <button onclick="toggleDiseaseForm()"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition flex items-center">
                <i class="fas fa-plus mr-2"></i> Create New Disease
            </button>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div id="success-msg" class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    const msg = document.getElementById('success-msg');
                    if (msg) { msg.remove(); }
                }, 3000);
            </script>
        @endif

        <!-- Create Disease Form (hidden by default) -->
        <div id="create-disease-form" class="{{ $errors->any() ? '' : 'hidden' }} mb-6">
            <form method="POST" action="{{ route('diseases.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Disease Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Disease Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="block w-full border border-gray-300 rounded p-2"
                           placeholder="Enter disease name">
                    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Related Crop -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Affected Crop</label>
                    <select name="crop_id" class="block w-full border border-gray-300 rounded p-2">
                        <option value="">Select Crop</option>
                        @foreach($crops as $crop)
                            <option value="{{ $crop->id }}" {{ old('crop_id') == $crop->id ? 'selected' : '' }}>
                                {{ $crop->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('crop_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Disease Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Disease Image</label>
                    <input type="file" name="image" class="block w-full border border-gray-300 rounded p-2">
                    @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Symptoms -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Symptoms</label>
                    <textarea name="symptoms" rows="3"
                              class="w-full border rounded px-3 py-2">{{ old('symptoms') }}</textarea>
                    @error('symptoms') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Causes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Causes (optional)</label>
                    <textarea name="cause" rows="2"
                              class="w-full border rounded px-3 py-2">{{ old('cause') }}</textarea>
                </div>

                <!-- Prevention -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Prevention (optional)</label>
                    <textarea name="prevention" rows="2"
                              class="w-full border rounded px-3 py-2">{{ old('prevention') }}</textarea>
                </div>

                <!-- Treatment -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Treatment (optional)</label>
                    <textarea name="treatment" rows="2"
                              class="w-full border rounded px-3 py-2">{{ old('treatment') }}</textarea>
                </div>

                <!-- Severity -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Severity</label>
                    <select name="severity" class="block w-full border border-gray-300 rounded p-2">
                        <option value="low" {{ old('severity') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('severity') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('severity') == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="block w-full border border-gray-300 rounded p-2">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Disease
                    </button>
                    <button type="button" onclick="toggleDiseaseForm()"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition flex items-center">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </button>
                </div>
            </form>
        </div>

        <!-- Diseases Table -->
        <table class="min-w-full border border-gray-200 rounded-lg text-sm md:text-base">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Disease Name</th>
                    <th class="px-4 py-2">Crop</th>
                    <th class="px-4 py-2">Severity</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($diseases as $disease)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">
                        <img src="{{ asset('storage/' . $disease->image) }}" alt="{{ $disease->name }}" class="h-16 w-16 object-cover rounded">
                    </td>
                    <td class="px-4 py-2 font-medium">{{ $disease->name }}</td>
                    <td class="px-4 py-2">{{ $disease->crop->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2 capitalize">{{ $disease->severity }}</td>
                    <td class="px-4 py-2 {{ $disease->status === 'active' ? 'text-green-600' : 'text-yellow-600' }}">
                        {{ ucfirst($disease->status) }}
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 space-y-2 sm:space-y-0">
                            <!-- Edit Button -->
                            <button onclick="document.getElementById('edit-disease-form-{{ $disease->id }}').classList.toggle('hidden')"
                                    class="bg-blue-500 text-white px-2 py-1 rounded w-full sm:w-auto text-center">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <form method="POST" action="{{ route('diseases.destroy', $disease->id) }}" class="w-full sm:w-auto">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-2 py-1 rounded w-full sm:w-auto text-center">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

    <!-- Inline Edit Form (hidden by default) -->
                <tr id="edit-disease-form-{{ $disease->id }}" class="hidden bg-gray-50">
                    <td colspan="6" class="p-4">
                        <form method="POST" action="{{ route('diseases.update', $disease->id) }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <!-- Current Image -->
                            @if($disease->image)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Current Image</label>
                                    <img src="{{ asset('storage/'.$disease->image) }}" alt="Disease Image"
                                        class="w-32 h-32 object-cover mb-2 border rounded">
                                </div>
                            @endif

                            <!-- Upload New Image -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Upload New Image</label>
                                <input type="file" name="image" class="block w-full border border-gray-300 rounded p-2">
                                @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Disease Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Disease Name</label>
                                <input type="text" name="name" value="{{ old('name', $disease->name) }}"
                                    class="block w-full border border-gray-300 rounded p-2">
                                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Related Crop -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Affected Crop</label>
                                <select name="crop_id" class="block w-full border border-gray-300 rounded p-2">
                                    @foreach($crops as $crop)
                                        <option value="{{ $crop->id }}" {{ old('crop_id', $disease->crop_id) == $crop->id ? 'selected' : '' }}>
                                            {{ $crop->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('crop_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Symptoms -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Symptoms</label>
                                <textarea name="symptoms" rows="3"
                                        class="w-full border rounded px-3 py-2">{{ old('symptoms', $disease->symptoms) }}</textarea>
                                @error('symptoms') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Cause -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cause</label>
                                <textarea name="cause" rows="2"
                                        class="w-full border rounded px-3 py-2">{{ old('cause', $disease->cause) }}</textarea>
                            </div>

                            <!-- Prevention -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Prevention</label>
                                <textarea name="prevention" rows="2"
                                        class="w-full border rounded px-3 py-2">{{ old('prevention', $disease->prevention) }}</textarea>
                            </div>

                            <!-- Treatment -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Treatment</label>
                                <textarea name="treatment" rows="2"
                                        class="w-full border rounded px-3 py-2">{{ old('treatment', $disease->treatment) }}</textarea>
                            </div>

                            <!-- Severity -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Severity</label>
                                <select name="severity" class="block w-full border border-gray-300 rounded p-2">
                                    <option value="low" {{ old('severity', $disease->severity) == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('severity', $disease->severity) == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('severity', $disease->severity) == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" class="block w-full border border-gray-300 rounded p-2">
                                    <option value="active" {{ old('status', $disease->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $disease->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-2">
                                <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition flex items-center">
                                    <i class="fas fa-save mr-2"></i> Update Disease
                                </button>
                                <button type="button"
                                        onclick="document.getElementById('edit-disease-form-{{ $disease->id }}').classList.add('hidden')"
                                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition flex items-center">
                                    <i class="fas fa-times mr-2"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</section>

<script>
    function toggleDiseaseForm() {
        const form = document.getElementById('create-disease-form');
        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
        } else {
            form.classList.add('hidden');
        }
    }
</script>

    <!-- Agro Stories Section -->
    <section id="reports" class="hidden">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Agro Stories</h2>
        <div class="space-y-4">
        <div class="p-4 border rounded bg-white hover:shadow">
            <h3 class="font-semibold">Organic Farming in Bandipur</h3>
            <p class="text-gray-600">A success story of farmers adopting organic methods...</p>
        </div>
        <div class="p-4 border rounded bg-white hover:shadow">
            <h3 class="font-semibold">Rice Yield Improvement</h3>
            <p class="text-gray-600">How modern irrigation boosted rice production in Terai...</p>
        </div>
        </div>
    </div>
</section> --}}

<!-- Profile Section -->
<section id="profile" class="hidden">
  <h2 class="text-xl font-semibold mb-4">Admin Profile</h2>

  <!-- Profile Card -->
  <div class="bg-white shadow rounded p-6">
    <p class="mb-2"><i class="fas fa-user mr-2 text-green-600"></i> Name: {{ Auth::user()->name }}</p>
    <p class="mb-2"><i class="fas fa-envelope mr-2 text-green-600"></i> Email: {{ Auth::user()->email }}</p>
    <p class="mb-2"><i class="fas fa-calendar-check mr-2 text-green-600"></i> Logged in at: {{ now()->format('d M Y, h:i A') }}</p>
  </div>


  <!-- Edit Profile Form -->
<form id="adminProfileForm" method="POST" action="{{ route('admin.profile.update') }}"
      class="bg-white shadow rounded p-6 mt-6">
    @csrf
    @method('PUT')

    <!-- Success Message -->
    @if(session('success'))
      <div id="flash-success" class="bg-green-100 text-green-700 p-3 rounded mb-4">
          {{ session('success') }}
      </div>
    @endif

    <!-- Name -->
    <div class="mb-4">
      <label class="block text-gray-700 font-medium mb-2">Name</label>
      <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
             class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" required>
      @error('name')
        <p class="error-msg text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Email -->
    <div class="mb-4">
      <label class="block text-gray-700 font-medium mb-2">Email</label>
      <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
             class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror" required>
      @error('email')
        <p class="error-msg text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Password -->
    <div class="mb-4">
      <label class="block text-gray-700 font-medium mb-2">New Password</label>
      <input type="password" name="password"
             class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror">
      @error('password')
        <p class="error-msg text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Confirm Password</label>
        <input type="password" name="password_confirmation"
                class="w-full border rounded px-3 py-2 @error('password_confirmation') border-red-500 @enderror">
        @error('password_confirmation')
            <p class="error-msg text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit + Cancel -->
    <div class="flex space-x-3">
      <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
        Update Profile
      </button>
      <a href="{{ route('admin.dashboard') }}"
         class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
        Cancel
      </a>
    </div>
</form>
</section>

</main>
</div>

<!-- JS -->
<script src="{{asset('js/admin-dash.js')}}"></script>
</body>
</html>
