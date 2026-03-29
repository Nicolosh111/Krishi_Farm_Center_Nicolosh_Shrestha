<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Krishi Farm Center Expert Dashboard</title>
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
    {{-- <a href="#" data-section="inventory" class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
      <i class="fas fa-tractor mr-2"></i> Farmers
    </a>
    <a href="#" data-section="orders" class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
      <i class="fas fa-user-tie mr-2"></i> Experts
    </a> --}}

     <a href="#" data-section="crops"
        class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-seedling mr-2"></i> Manage Crops
    </a>

    <a href="#" data-section="diseases"
        class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-virus mr-2"></i> Manage Diseases
    </a>
    <a href="#" data-section="diagnosis"
        class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-upload mr-2"></i> Pending Diagnoses
    </a>
    {{-- <a href="#" data-section="crops" class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-file-medical mr-2"></i> Disease Reports
    </a>
    <a href="#" data-section="stories" class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-question-circle mr-2"></i> Questions
    </a> --}}
    <a href="#" data-section="knowledge-hub" class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-book-open mr-2"></i> Knowledge Hub
    </a>
 <a href="#" data-section="expert-stories"
   class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
    <i class="fas fa-trophy mr-2"></i> Success Stories
</a>
<a href="#" data-section="expert-consultations"
   class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
    <i class="fas fa-comments mr-2"></i> Expert Consultations
</a>
<a href="#" data-section="expert-queries"
   class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
    <i class="fas fa-question-circle mr-2"></i> Queries
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
        <h1 class="text-xl font-semibold">Expert Dashboard</h1>
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

 <section id="dashboard">
    <h2 class="text-xl font-semibold mb-4">Dashboard Overview</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">

        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
            <div>
                <h3 class="text-gray-500 text-sm">Manage Crops</h3>
                <p class="text-2xl font-bold text-green-700">{{ $totalCrops }}</p>
            </div>
            <i class="fas fa-seedling text-green-500 text-2xl"></i>
        </div>

        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
            <div>
                <h3 class="text-gray-500 text-sm">Manage Diseases</h3>
                <p class="text-2xl font-bold text-green-700">{{ $totalDiseases }}</p>
            </div>
            <i class="fas fa-virus text-blue-500 text-2xl"></i>
        </div>

        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
            <div>
                <h3 class="text-gray-500 text-sm">Pending Diagnoses</h3>
                <p class="text-2xl font-bold text-green-700">{{ $pendingDiagnoses }}</p>
            </div>
            <i class="fas fa-upload text-purple-500 text-2xl"></i>
        </div>

        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
            <div>
                <h3 class="text-gray-500 text-sm">Knowledge Hub</h3>
                <p class="text-2xl font-bold text-green-700">{{ $knowledgeArticles }}</p>
            </div>
            <i class="fas fa-book-open text-yellow-500 text-2xl"></i>
        </div>

        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
            <div>
                <h3 class="text-gray-500 text-sm">Success Stories</h3>
                <p class="text-2xl font-bold text-green-700">{{ $expertStories }}</p>
            </div>
            <i class="fas fa-users text-green-500 text-2xl"></i>
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
    {{-- <section id="users" class="hidden">
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

  <!-- Manage Crops Section -->
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
<div id="create-crop-form" class="{{ $errors->any() ? '' : 'hidden' }} mb-6">
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

        <!-- Soil Type -->
        <div>
            <label for="soil_type" class="block text-sm font-medium text-gray-700">Soil Type</label>
            <select name="soil_type" id="soil_type"
                    class="block w-full border border-gray-300 rounded p-2">
                <option value="">Select Soil Type</option>
                <option value="Clay Loam" {{ old('soil_type') == 'Clay Loam' ? 'selected' : '' }}>Clay Loam</option>
                <option value="Sandy Loam" {{ old('soil_type') == 'Sandy Loam' ? 'selected' : '' }}>Sandy Loam</option>
                <option value="Silt" {{ old('soil_type') == 'Silt' ? 'selected' : '' }}>Silt</option>
                <option value="Peat" {{ old('soil_type') == 'Peat' ? 'selected' : '' }}>Peat</option>
                <option value="Chalky" {{ old('soil_type') == 'Chalky' ? 'selected' : '' }}>Chalky</option>
                <option value="Loam" {{ old('soil_type') == 'Loam' ? 'selected' : '' }}>Loam</option>
            </select>
            @error('soil_type')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Cultivation Practices -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Cultivation Practices</label>
            <textarea name="cultivation_practices" rows="4"
                    class="block w-full border border-gray-300 rounded p-2"
                    placeholder="Enter cultivation practices">{{ old('cultivation_practices') }}</textarea>
            @error('cultivation_practices')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Yield Potential -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Yield Potential (tons/ha)</label>
            <input type="number" step="0.01" name="yield_potential"
                value="{{ old('yield_potential') }}"
                class="block w-full border border-gray-300 rounded p-2"
                placeholder="Enter yield potential">
            @error('yield_potential')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

       <!-- Resource File Upload -->
<div>
    <label class="block text-sm font-medium text-gray-700">Upload Resource</label>
    <input type="file" name="resources[]" multiple
           class="block w-full border border-gray-300 rounded p-2">
    @error('resources')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror

    <!-- Resource File Title -->
    <input type="text" name="resource_file_titles[]"
           class="block w-full border border-gray-300 rounded p-2 mt-2"
           placeholder="Enter resource title (e.g. Irrigation Demo Video)">
</div>

<!-- OR Resource Link -->
<div>
    <label class="block text-sm font-medium text-gray-700">Resource Link</label>
    <input type="url" name="resource_links[]"
           class="block w-full border border-gray-300 rounded p-2"
           placeholder="https://example.com/guide.pdf">
    @error('resource_links')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror

    <!-- Resource Link Title -->
    <input type="text" name="resource_link_titles[]"
           class="block w-full border border-gray-300 rounded p-2 mt-2"
           placeholder="Enter resource title (e.g. Wheat Guide PDF)">
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

                    <!-- Soil Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Soil Type</label>
                        <select name="soil_type" class="block w-full border border-gray-300 rounded p-2">
                            <option value="">Select Soil Type</option>
                            <option value="Clay Loam" {{ old('soil_type', $crop->soil_type) == 'Clay Loam' ? 'selected' : '' }}>Clay Loam</option>
                            <option value="Sandy Loam" {{ old('soil_type', $crop->soil_type) == 'Sandy Loam' ? 'selected' : '' }}>Sandy Loam</option>
                            <option value="Silt" {{ old('soil_type', $crop->soil_type) == 'Silt' ? 'selected' : '' }}>Silt</option>
                            <option value="Peat" {{ old('soil_type', $crop->soil_type) == 'Peat' ? 'selected' : '' }}>Peat</option>
                            <option value="Chalky" {{ old('soil_type', $crop->soil_type) == 'Chalky' ? 'selected' : '' }}>Chalky</option>
                            <option value="Loam" {{ old('soil_type', $crop->soil_type) == 'Loam' ? 'selected' : '' }}>Loam</option>
                        </select>
                        @error('soil_type')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cultivation Practices -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cultivation Practices</label>
                        <textarea name="cultivation_practices" rows="4"
                                class="block w-full border border-gray-300 rounded p-2"
                                placeholder="Enter cultivation practices">{{ old('cultivation_practices', $crop->cultivation_practices) }}</textarea>
                        @error('cultivation_practices')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Yield Potential -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Yield Potential (t/ha)</label>
                        <input type="number" step="0.01" name="yield_potential"
                            value="{{ old('yield_potential', $crop->yield_potential) }}"
                            class="block w-full border border-gray-300 rounded p-2"
                            placeholder="e.g. 8.5">
                        @error('yield_potential')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Resource File Upload -->
                    <div>
                        <label>Upload New Resources</label>
                        <input type="file" name="resources[]" multiple
                            class="block w-full border border-gray-300 rounded p-2">
                    </div>

                <!-- Resource Links -->
                <div>
                    <label>Resource Links</label>
                    <input type="url" name="resource_links[]" multiple
                        class="block w-full border border-gray-300 rounded p-2"
                        placeholder="https://example.com/guide.pdf">
                </div>

                <!-- Existing Resources -->
                <div class="mt-4">
                    <h3 class="font-semibold">Existing Resources</h3>
                    <ul>
                        @foreach($crop->resources as $resource)
                            <li>
                                @if($resource->type === 'link')
                                    <a href="{{ $resource->file }}" target="_blank">{{ $resource->title }}</a>
                                @else
                                    <a href="{{ asset('storage/' . $resource->file) }}" target="_blank">{{ $resource->title }}</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
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
</section>

    <!-- Toggle Script -->
    <script>
    function toggleCropForm() {
        document.getElementById('create-crop-form').classList.toggle('hidden');
    }
    </script>

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

                <!-- Disease Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Disease Type</label>
                    <input type="text" name="type" value="{{ old('type') }}"
                        class="block w-full border border-gray-300 rounded p-2"
                        placeholder="e.g. Fungal, Bacterial">
                    @error('type') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
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
                    <label class="block text-sm font-medium text-gray-700">Causes</label>
                    <textarea name="cause" rows="2"
                            class="w-full border rounded px-3 py-2">{{ old('cause') }}</textarea>
                </div>

                <!-- Prevention -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Prevention</label>
                    <textarea name="prevention" rows="2"
                            class="w-full border rounded px-3 py-2">{{ old('prevention') }}</textarea>
                </div>

                <!-- Treatment -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Treatment</label>
                    <textarea name="treatment" rows="2"
                            class="w-full border rounded px-3 py-2">{{ old('treatment') }}</textarea>
                </div>

                <!-- Treatment Images -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Upload Treatment Images</label>

                    <input type="file" id="treatment_images" name="treatment_images[]" multiple accept="image/*"
                        class="block w-full border border-gray-300 rounded p-2">

                    <!-- Titles will be generated here -->
                    <div id="titles-wrapper" class="mt-3 space-y-2"></div>

                    <p class="text-xs text-gray-500 mt-1">You can upload multiple images. Titles are optional.</p>
                </div>

                <script>
                document.getElementById('treatment_images').addEventListener('change', function(event) {
                    const wrapper = document.getElementById('titles-wrapper');
                    wrapper.innerHTML = ''; // clear old titles

                    Array.from(event.target.files).forEach((file, index) => {
                        const div = document.createElement('div');
                        div.innerHTML = `
                            <input type="text" name="treatment_image_titles[]"
                                placeholder="Title for ${file.name} (optional)"
                                class="block w-full border border-gray-300 rounded px-3 py-2">
                        `;
                        wrapper.appendChild(div);
                    });
                });
                </script>

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

                <!-- Verified -->
                {{-- <div>
                    <label class="block text-sm font-medium text-gray-700">Verified by Expert?</label>
                    <select name="verified" class="block w-full border border-gray-300 rounded p-2">
                        <option value="0" {{ old('verified') == '0' ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('verified') == '1' ? 'selected' : '' }}>Yes</option>
                    </select>
                </div> --}}

                <!-- Resources -->
                {{-- <div>
                    <label class="block text-sm font-medium text-gray-700">Resources</label>
                    <input type="file" name="resources[]" multiple
                        class="block w-full border border-gray-300 rounded p-2">
                    <p class="text-sm text-gray-500">Upload PDF, DOCX, or images</p>
                </div> --}}

               <!-- Resource Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Resource Title</label>
                    <input type="text" name="resource_title" value="{{ old('resource_title') }}"
                        class="block w-full border border-gray-300 rounded p-2"
                        placeholder="e.g. Guide to Fungal Diseases">
                </div>

                <!-- Upload Resources -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Upload Resources</label>
                    <input type="file" name="resources[]" multiple
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.mp4,.mov,.avi"
                        class="block w-full border border-gray-300 rounded p-2">
                    <p class="text-sm text-gray-500">Upload PDF, DOCX, images, or videos (max 50 MB each)</p>
                </div>

                <!-- External Resource Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">External Resource Title</label>
                    <input type="text" name="resource_title" value="{{ old('resource_title') }}"
                        class="block w-full border border-gray-300 rounded p-2"
                        placeholder="e.g. Crop Disease Guide Link">
                </div>

                <!-- External Resource Link -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">External Resource Link</label>
                    <input type="url" name="resource_link" value="{{ old('resource_link') }}"
                        class="block w-full border border-gray-300 rounded p-2"
                        placeholder="https://example.com/guide">
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
                    <th class="px-4 py-2">Type</th>
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
                    <td class="px-4 py-2">{{ $disease->type ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $disease->crop->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2 capitalize">{{ $disease->severity }}</td>
                    <td class="px-4 py-2 {{ $disease->status === 'active' ? 'text-green-600' : 'text-yellow-600' }}">
                        {{ ucfirst($disease->status) }}
                    </td>

                     <!-- Verified -->
                    {{-- <td class="px-4 py-2">
                        @if($disease->verified)
                            <i class="fas fa-check-circle text-green-600"></i>
                        @else
                            <span class="text-gray-500">No</span>
                        @endif
                    </td> --}}

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

                            {{-- @if($disease->treatmentImages->count())
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Current Treatment Images</label>
                                    <div class="flex gap-6 flex-wrap mt-2">
                                        @foreach($disease->treatmentImages as $image)
                                            <div class="text-center">
                                                <img src="{{ asset('storage/' . $image->file) }}"
                                                    class="w-24 h-24 object-cover border rounded">
                                                <div class="mt-2">
                                                    <label class="text-xs">
                                                        <input type="checkbox" name="delete_treatment_images[]" value="{{ $image->id }}">
                                                        Delete
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Upload new treatment images -->
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Upload New Treatment Images</label>
                                <input type="file" name="treatment_images[]" multiple accept="image/*"
                                    class="block w-full border border-gray-300 rounded p-2">
                            </div> --}}

                            <!-- Existing Treatment Images -->
@if($disease->treatmentImages->count())
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Existing Treatment Images</label>
    <div class="space-y-4">
        @foreach($disease->treatmentImages as $image)
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/' . $image->file) }}" alt="Treatment Image"
                     class="w-24 h-24 object-cover rounded border">

                <!-- Editable title -->
                <input type="text" name="existing_treatment_image_titles[{{ $image->id }}]"
                       value="{{ $image->title }}"
                       placeholder="Optional title"
                       class="flex-1 border border-gray-300 rounded px-3 py-2">

                <!-- Delete checkbox -->
                <label class="flex items-center gap-2 text-sm text-red-600">
                    <input type="checkbox" name="delete_treatment_images[]" value="{{ $image->id }}">
                    Delete
                </label>
            </div>
        @endforeach
    </div>
</div>
@endif

<!-- Add New Treatment Images -->
<div>
    <label class="block text-sm font-medium text-gray-700">Upload New Treatment Images</label>
    <input type="file" id="treatment_images" name="treatment_images[]" multiple accept="image/*"
           class="block w-full border border-gray-300 rounded p-2">

    <div id="titles-wrapper" class="mt-3 space-y-2"></div>
</div>

<script>
document.getElementById('treatment_images').addEventListener('change', function(event) {
    const wrapper = document.getElementById('titles-wrapper');
    wrapper.innerHTML = ''; // clear old titles

    Array.from(event.target.files).forEach((file, index) => {
        const div = document.createElement('div');
        div.innerHTML = `
            <input type="text" name="treatment_image_titles[]"
                   placeholder="Title for ${file.name} (optional)"
                   class="block w-full border border-gray-300 rounded px-3 py-2">
        `;
        wrapper.appendChild(div);
    });
});
</script>

                            <!-- Severity -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Severity</label>
                                <select name="severity" class="block w-full border border-gray-300 rounded p-2">
                                    <option value="low" {{ old('severity', $disease->severity) == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('severity', $disease->severity) == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('severity', $disease->severity) == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>

                            <!-- Resource Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Resource Title</label>
                <input type="text" name="resource_title" value="{{ old('resource_title') }}"
                    class="block w-full border border-gray-300 rounded p-2"
                    placeholder="e.g. Updated Treatment Video">
            </div>

            <!-- Upload New Resources -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Upload New Resources</label>
                <input type="file" name="resources[]" multiple
                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.mp4,.mov,.avi"
                    class="block w-full border border-gray-300 rounded p-2">
                <p class="text-sm text-gray-500">Upload PDF, DOCX, images, or videos (max 50 MB each)</p>
            </div>

            <!-- External Resource Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700">External Resource Title</label>
                <input type="text" name="resource_title" value="{{ old('resource_title') }}"
                    class="block w-full border border-gray-300 rounded p-2"
                    placeholder="e.g. Updated Treatment Video Link">
            </div>

            <!-- External Resource Link -->
            <div>
                <label class="block text-sm font-medium text-gray-700">External Resource Link</label>
                <input type="url" name="resource_link" value="{{ old('resource_link') }}"
                    class="block w-full border border-gray-300 rounded p-2"
                    placeholder="https://example.com/resource">
            </div>

            <!-- Existing Resources -->
            @if($disease->resources->count())
                <div>
                    <label class="block text-sm font-medium text-gray-700">Existing Resources</label>
                    <ul class="list-disc pl-5">
                        @foreach($disease->resources as $resource)
                            <li class="flex items-center justify-between">
                                <span>{{ $resource->title }}</span>
                                <a href="{{ asset('storage/'.$resource->file) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                                <!-- Optional delete button -->
                                {{-- <form method="POST" action="{{ route('resources.destroy', $resource->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                                </form> --}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

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

<!-- Knowledge Hub Section -->
<section id="knowledge-hub" class="hidden">
    <div class="bg-white shadow rounded-lg p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Manage Knowledge Hub</h2>
            <button onclick="toggleResourceForm()"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition flex items-center">
                <i class="fas fa-plus mr-2"></i> Upload New Resource
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

        <!-- Upload Resource Form -->
<div id="create-resource-form" class="{{ $errors->any() ? '' : 'hidden' }} mb-6">
    <form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Resource Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" class="block w-full border border-gray-300 rounded p-2"
                   placeholder="Enter resource title" required>
        </div>

        <!-- Resource Type -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Type</label>
            <select id="resource-type" name="type" class="block w-full border border-gray-300 rounded p-2" required>
                <option value="" disabled selected>Select Type</option>
                <option value="pdf">PDF</option>
                <option value="video">Video</option>
                <option value="link">Link</option>
            </select>
        </div>

        <!-- File Upload -->
        <div id="file-upload" class="hidden">
            <label class="block text-sm font-medium text-gray-700">Upload File</label>
            <input type="file" name="file" id="file-input" class="block w-full border border-gray-300 rounded p-2">
            <p id="file-preview" class="text-sm text-gray-600 mt-1"></p>
        </div>

        <!-- Resource Link -->
        <div id="link-input" class="hidden">
            <label class="block text-sm font-medium text-gray-700">Resource Link</label>
            <input type="url" name="link" id="link-field" class="block w-full border border-gray-300 rounded p-2"
                   placeholder="https://example.com/guide.pdf">
            <p id="link-preview" class="text-sm text-gray-600 mt-1"></p>
        </div>

        <!-- Buttons -->
        <div class="flex gap-2">
            <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition flex items-center">
                <i class="fas fa-save mr-2"></i> Save Resource
            </button>
            <button type="button" onclick="toggleResourceForm()"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition flex items-center">
                <i class="fas fa-times mr-2"></i> Cancel
            </button>
        </div>
    </form>
</div>

        <!-- Resources Table -->
        <table class="min-w-full border border-gray-200 rounded-lg text-sm md:text-base">
            <thead class="bg-gray-100">
    <tr>
        <th class="px-4 py-2">Title</th>
        <th class="px-4 py-2">Type</th>
        <th class="px-4 py-2">Action</th>
    </tr>
</thead>

<tbody>
    @foreach($resources as $resource)
    <tr class="border-t hover:bg-gray-50">
        <td class="px-4 py-2">{{ $resource->title }}</td>
        <td class="px-4 py-2">{{ ucfirst($resource->type) }}</td>
        <td class="px-4 py-2 flex gap-2">
            {{-- View button logic --}}
            @if($resource->type === 'link' && $resource->link)
                <a href="{{ $resource->link }}" target="_blank"
                   class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">View</a>
            @elseif($resource->file)
                <a href="{{ asset('storage/' . $resource->file) }}" target="_blank"
                   class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">View</a>
            @else
                <span class="text-gray-500 italic">No resource available</span>
            @endif

            <button type="button" onclick="toggleEditForm({{ $resource->id }})"
                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Edit</button>

            <form action="{{ route('resources.destroy', $resource->id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit"
                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
            </form>
        </td>

                </tr>

           <!-- Inline Edit Form -->
<tr id="edit-form-{{ $resource->id }}" class="hidden bg-gray-50">
    <td colspan="3" class="p-4">
        <form method="POST" action="{{ route('resources.update', $resource->id) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $resource->title) }}"
                    class="block w-full border border-gray-300 rounded p-2" required>
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" class="block w-full border border-gray-300 rounded p-2" required>
                    <option value="pdf" {{ $resource->type == 'pdf' ? 'selected' : '' }}>PDF</option>
                    <option value="video" {{ $resource->type == 'video' ? 'selected' : '' }}>Video</option>
                    <option value="link" {{ $resource->type == 'link' ? 'selected' : '' }}>Link</option>
                </select>
            </div>

            <!-- File Upload -->
            <div id="file-upload-{{ $resource->id }}" class="{{ $resource->type == 'pdf' || $resource->type == 'video' ? '' : 'hidden' }}">
                <label class="block text-sm font-medium text-gray-700">Upload New File (optional)</label>
                <input type="file" name="file" class="block w-full border border-gray-300 rounded p-2">
                @if($resource->file)
                    <p class="text-sm text-gray-600 mt-1">Current file: {{ $resource->file }}</p>
                @endif
            </div>

            <!-- Link -->
            <div id="link-input-{{ $resource->id }}" class="{{ $resource->type == 'link' ? '' : 'hidden' }}">
                <label class="block text-sm font-medium text-gray-700">Resource Link (optional)</label>
                <input type="url" name="link" value="{{ old('link', $resource->link) }}"
                    class="block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Buttons -->
            <div class="flex gap-2">
                <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition flex items-center">
                    <i class="fas fa-save mr-2"></i> Update Resource
                </button>
                <button type="button" onclick="toggleEditForm({{ $resource->id }})"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition flex items-center">
                    Cancel
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
    function toggleResourceForm() {
        const form = document.getElementById('create-resource-form');
        form.classList.toggle('hidden');
    }

    function toggleEditForm(id) {
        const formRow = document.getElementById('edit-form-' + id);
        formRow.classList.toggle('hidden');
    }

    // Show/hide inputs based on type
    document.getElementById('resource-type').addEventListener('change', function() {
        const fileUpload = document.getElementById('file-upload');
        const linkInput = document.getElementById('link-input');

        if (this.value === 'pdf' || this.value === 'video') {
            fileUpload.classList.remove('hidden');
            linkInput.classList.add('hidden');
        } else if (this.value === 'link') {
            linkInput.classList.remove('hidden');
            fileUpload.classList.add('hidden');
        } else {
            fileUpload.classList.add('hidden');
            linkInput.classList.add('hidden');
        }
    });

    // File preview
    document.getElementById('file-input').addEventListener('change', function() {
        const preview = document.getElementById('file-preview');
        if (this.files.length > 0) {
            preview.textContent = "Selected file: " + this.files[0].name;
        } else {
            preview.textContent = "";
        }
    });

    // Link preview
    document.getElementById('link-field').addEventListener('input', function() {
        const preview = document.getElementById('link-preview');
        if (this.value.trim() !== "") {
            preview.textContent = "Entered link: " + this.value;
        } else {
            preview.textContent = "";
        }
    });
</script>

<!-- Expert Profile Section -->
<section id="profile">
    <h2 class="text-2xl font-semibold mb-6">Expert Profile</h2>

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

    <!-- Profile Card -->
    <div class="bg-white shadow rounded p-6 mb-6 flex items-center space-x-6">
        <!-- Profile Image -->
        <div>
            @if(Auth::user()->expertProfile?->profile_image)
                <img src="{{ asset('storage/' . Auth::user()->expertProfile->profile_image) }}"
                     class="w-28 h-28 rounded-full object-cover">
            @else
                <div class="w-28 h-28 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-4xl">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif
        </div>

        <!-- Profile Details -->
        <div>
            <p class="mb-2">Name: {{ Auth::user()->name }}</p>
            <p class="mb-2">Email: {{ Auth::user()->email }}</p>
            <p class="mb-2">Phone: {{ Auth::user()->expertProfile->phone ?? 'N/A' }}</p>
            <p class="mb-2">Specialization: {{ Auth::user()->expertProfile->specialization ?? 'N/A' }}</p>
            <p class="mb-2">Qualification: {{ Auth::user()->expertProfile->qualification ?? 'N/A' }}</p>
            <p class="mb-2">Experience:
                {{ Auth::user()->expertProfile->experience_years ? Auth::user()->expertProfile->experience_years . ' years' : 'N/A' }}
            </p>
            <p class="mb-2">Consultation Fee:
                {{ Auth::user()->expertProfile->consultation_fee ? 'Rs. ' . Auth::user()->expertProfile->consultation_fee : 'N/A' }}
            </p>
            <p class="mb-2">Bio: {{ Auth::user()->expertProfile->bio ?? 'N/A' }}</p>

            <!-- Edit Button -->
            <button onclick="document.getElementById('edit-form').classList.toggle('hidden')"
                    class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Edit Profile
            </button>
        </div>
    </div>

    <!-- Edit Profile Form (Initially Hidden) -->
    <form id="edit-form" method="POST"
          action="{{ route('expert.profile.update') }}"
          enctype="multipart/form-data"
          class="bg-white shadow rounded p-6 hidden">

        @csrf
        @method('PUT')

        <!-- BASIC INFO -->
        <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-medium mb-1">Name</label>
                <input type="text" name="name"
                       value="{{ old('name', Auth::user()->name) }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" name="email"
                       value="{{ old('email', Auth::user()->email) }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Phone</label>
                <input type="text" name="phone"
                       value="{{ old('phone', Auth::user()->expertProfile->phone ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <!-- EXPERT INFORMATION -->
        <h3 class="text-lg font-semibold mb-4">Expert Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-medium mb-1">Specialization</label>
                <input type="text" name="specialization"
                       value="{{ old('specialization', Auth::user()->expertProfile->specialization ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Qualification</label>
                <input type="text" name="qualification"
                       value="{{ old('qualification', Auth::user()->expertProfile->qualification ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Experience (years)</label>
                <input type="number" name="experience_years"
                       value="{{ old('experience_years', Auth::user()->expertProfile->experience_years ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Consultation Fee (Rs.)</label>
                <input type="number" step="0.01" name="consultation_fee"
                       value="{{ old('consultation_fee', Auth::user()->expertProfile->consultation_fee ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <!-- Profile Image -->
        <div class="mb-6">
            <label class="block font-medium mb-1">Profile Image</label>
            <input type="file" name="profile_image"
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Bio -->
        <div class="mb-6">
            <label class="block font-medium mb-1">Bio</label>
            <textarea name="bio" rows="4"
                      class="w-full border rounded px-3 py-2">{{ old('bio', Auth::user()->expertProfile->bio ?? '') }}</textarea>
        </div>

        <!-- PASSWORD -->
        <h3 class="text-lg font-semibold mb-4">Change Password</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-medium mb-1">New Password</label>
                <input type="password" name="password"
                       class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="flex gap-3">
            <button type="submit"
                    class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">
                Update Profile
            </button>
            <button type="button"
                    onclick="document.getElementById('edit-form').classList.add('hidden')"
                    class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                Cancel
            </button>
        </div>
    </form>
</section>

<section id="diagnosis" class="hidden">
    <div class="bg-white shadow rounded-lg p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Pending Plant Images</h2>
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

        <!-- Table -->
        <table class="min-w-full border border-gray-200 rounded-lg text-sm md:text-base">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Farmer</th>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Uploaded At</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plantImages as $image)
                    @if($image->diagnoses->isEmpty())
                        <tr class="border-t hover:bg-gray-50">
                            <!-- Farmer -->
                            <td class="px-4 py-2 font-medium">
                                {{ $image->user->name ?? 'Unknown' }}
                            </td>

                            <!-- Image Thumbnail -->
                            <td class="px-4 py-2">
                                <img src="{{ asset('storage/' . $image->file_path) }}"
                                     alt="{{ $image->original_name }}"
                                     class="h-16 w-16 object-cover rounded cursor-pointer"
                                     onclick="openModal('{{ asset('storage/' . $image->file_path) }}')">
                            </td>

                            <!-- Uploaded At -->
                            <td class="px-4 py-2">
                                {{ $image->created_at->format('d M Y, h:i A') }}
                            </td>

                            <!-- Status -->
                            <td class="px-4 py-2 text-yellow-600 font-semibold">
                                Pending
                            </td>

                            <!-- Action -->
                            <td class="px-4 py-2">
                                <form method="POST" action="{{ route('expert.diagnose', $image->id) }}">
                                    @csrf
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 space-y-2 sm:space-y-0">
                                        <!-- Dropdown of diseases -->
                                        <select name="disease_id" class="border rounded p-2" required>
                                            <option value=""> Select Disease </option>
                                            @foreach($diseases as $disease)
                                                <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit"
                                                class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                            Save Diagnosis
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- Modal for Enlarged Image -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-4 max-w-3xl relative">
        <img id="modalImage" src="" alt="Full Image" class="max-h-[80vh] object-contain rounded">
        <!-- Close Button with X Icon -->
        <button onclick="closeModal()"
                class="absolute top-2 right-2 bg-red-600 text-white p-2 rounded-full hover:bg-red-700">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<script>
    function openModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
        document.getElementById('imageModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.remove('flex');
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>

<section id="expert-stories" class="bg-white shadow rounded-lg p-6">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold">Agro Success Stories</h2>
        <p class="text-gray-600">Review pending submissions from farmers</p>
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

    <!-- Pending Stories List -->
    @forelse($stories as $story)
        <div class="border rounded p-4 mb-3">
            <h4 class="font-bold text-green-700">{{ $story->title }}</h4>
            <p class="text-gray-600">{{ $story->description }}</p>
            <p class="text-sm text-gray-500 mt-2">
                Submitted by: {{ $story->user->name ?? $story->farmer_name }} ({{ $story->location }})
            </p>

            <!-- Image -->
            <div class="mt-2">
                @if($story->image_url)
                    <img src="{{ asset('storage/' . $story->image_url) }}"
                         alt="{{ $story->title }}"
                         class="h-24 w-24 object-cover rounded">
                @else
                    <img src="{{ asset('images/placeholder.png') }}"
                         alt="No image available"
                         class="h-24 w-24 object-cover rounded bg-gray-200">
                @endif
            </div>

            <!-- Like Count -->
            {{-- <p class="text-sm text-gray-600 mt-2">
                <i class="fas fa-thumbs-up text-green-600 mr-1"></i>
                {{ $story->likes()->count() }} likes
            </p> --}}

            <!-- Status Badge -->
            <span class="inline-block mt-3 px-3 py-1 text-sm rounded
                @if($story->status === 'pending') bg-yellow-200 text-yellow-800
                @elseif($story->status === 'approved') bg-green-200 text-green-800
                @else bg-red-200 text-red-800 @endif">
                {{ ucfirst($story->status) }}
            </span>

            <!-- Approve / Reject Buttons -->
            <div class="mt-4 flex space-x-2">
                <form action="{{ route('expert.stories.approve', $story->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded">
                        Approve
                    </button>
                </form>

                <form action="{{ route('expert.stories.reject', $story->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-red-600 text-white px-4 py-1 rounded">
                        Reject
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No pending stories right now.</p>
    @endforelse

    <!-- Pagination -->
    <div class="mt-4">
        {{ $stories->links() }}
    </div>
</section>
{{--
<section id="expert-consultations" class="mt-10 p-6 bg-gray-50 rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2 mb-4">
        My Consultations
    </h2>

    @if($consultations->isEmpty())
        <p class="text-gray-500">No consultations scheduled.</p>
    @else
        <div class="space-y-4">
            @foreach($consultations as $consultation)
                <div class="bg-white shadow rounded p-4 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-green-700">
                            Farmer: {{ $consultation->farmer->name ?? 'Unknown' }}
                        </h3>
                        <p class="text-gray-500">
                            Date: {{ \Carbon\Carbon::parse($consultation->date)->format('M d, Y') }}
                            | Time: {{ \Carbon\Carbon::parse($consultation->time)->format('h:i A') }}
                        </p>
                        <p class="text-gray-500">Fee: Rs. {{ $consultation->fee }}</p>
                    </div>

                    <div>
                        @php
                            $consultationDateTime = \Carbon\Carbon::createFromFormat(
                                'Y-m-d H:i:s',
                                $consultation->date . ' ' . date('H:i:s', strtotime($consultation->time)),
                                'Asia/Kathmandu'
                            );
                            $consultationEndTime = $consultationDateTime->copy()->addMinutes(($consultation->duration ?? 0) + 5);
                        @endphp

                        <div id="expert-chat-{{ $consultation->id }}">
                            @if(now('Asia/Kathmandu')->lessThan($consultationDateTime))
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Chat unlocks at {{ $consultationDateTime->format('M d, Y h:i A') }}
                                </span>
                            @elseif(now('Asia/Kathmandu')->between($consultationDateTime, $consultationEndTime))
                                <button
                                    onclick="openChat('{{ route('chatify') }}?id={{ $consultation->farmer->id }}')"
                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                    Live Chat
                                </button>
                            @else
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Chat closed
                                </span>
                            @endif
                        </div>

                        <script>
                            (function() {
                                const unlockTime = new Date("{{ $consultationDateTime->format('Y-m-d H:i:s') }}").getTime();
                                const endTime = new Date("{{ $consultationEndTime->format('Y-m-d H:i:s') }}").getTime();
                                const chatDiv = document.getElementById("expert-chat-{{ $consultation->id }}");

                                function updateChatStatus() {
                                    const now = new Date().getTime();
                                    if (now >= unlockTime && now <= endTime) {
                                        chatDiv.innerHTML = `<button
                                            onclick="openChat('{{ route('chatify') }}?id={{ $consultation->farmer->id }}')"
                                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                            Live Chat
                                        </button>`;
                                    } else if (now < unlockTime) {
                                        chatDiv.innerHTML = `<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                            Chat unlocks at {{ $consultationDateTime->format('M d, Y h:i A') }}
                                        </span>`;
                                    } else {
                                        chatDiv.innerHTML = `<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                            Chat closed
                                        </span>`;
                                    }
                                }

                                setInterval(updateChatStatus, 1000);
                                updateChatStatus();
                            })();
                        </script>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section> --}}
{{--
@if($consultations->isNotEmpty())
<section id="expert-consultations" class="mt-10 p-6 bg-gray-50 rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2 mb-4">
        My Consultations
    </h2>

    <div class="space-y-4">
        @foreach($consultations as $consultation)
            <div class="bg-white shadow rounded p-4 flex justify-between items-center">
                <div>
                    <!-- Farmer Name -->
                    <h3 class="text-lg font-semibold text-green-700">
                        Farmer: {{ $consultation->farmer->name ?? 'Unknown' }}
                    </h3>

                    <!-- Date & Time -->
                    <p class="text-gray-500">
                        Date: {{ \Carbon\Carbon::parse($consultation->date)->format('M d, Y') }}
                        | Time: {{ \Carbon\Carbon::parse($consultation->time)->format('h:i A') }}
                    </p>

                    <!-- Fee -->
                    @if($consultation->expert && $consultation->expert->expertProfile)
                        <p class="text-gray-500">
                            Fee: Rs. {{ $consultation->expert->expertProfile->consultation_fee }}
                        </p>
                    @endif
                </div>

                <div>
                    @php
                        $consultationDateTime = \Carbon\Carbon::createFromFormat(
                            'Y-m-d H:i:s',
                            $consultation->date . ' ' . date('H:i:s', strtotime($consultation->time)),
                            'Asia/Kathmandu'
                        );
                        $consultationEndTime = $consultationDateTime->copy()->addMinutes(($consultation->duration ?? 0) + 5);
                    @endphp

                    <!-- Live Chat Control -->
                    <div id="expert-chat-{{ $consultation->id }}">
                        @if(now('Asia/Kathmandu')->lessThan($consultationDateTime))
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                Chat unlocks at {{ $consultationDateTime->format('M d, Y h:i A') }}
                            </span>
                        @elseif(now('Asia/Kathmandu')->between($consultationDateTime, $consultationEndTime))
                            <button
                                onclick="openChat('{{ route('chatify') }}?id={{ $consultation->farmer->id }}')"
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                Live Chat
                            </button>
                        @else
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                Chat closed
                            </span>
                        @endif
                    </div>

                    <!-- Auto-update script -->
                    <script>
                        (function() {
                            const unlockTime = new Date("{{ $consultationDateTime->format('Y-m-d H:i:s') }}").getTime();
                            const endTime = new Date("{{ $consultationEndTime->format('Y-m-d H:i:s') }}").getTime();
                            const chatDiv = document.getElementById("expert-chat-{{ $consultation->id }}");

                            function updateChatStatus() {
                                const now = new Date().getTime();
                                if (now >= unlockTime && now <= endTime) {
                                    chatDiv.innerHTML = `<button
                                        onclick="openChat('{{ route('chatify') }}?id={{ $consultation->farmer->id }}')"
                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                        Live Chat
                                    </button>`;
                                } else if (now < unlockTime) {
                                    chatDiv.innerHTML = `<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        Chat unlocks at {{ $consultationDateTime->format('M d, Y h:i A') }}
                                    </span>`;
                                } else {
                                    chatDiv.innerHTML = `<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        Chat closed
                                    </span>`;
                                }
                            }

                            setInterval(updateChatStatus, 1000);
                            updateChatStatus();
                        })();
                    </script>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif --}}

@if($consultations->isNotEmpty())
<section id="expert-consultations" class="mt-10 p-6 bg-gray-50 rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2 mb-4">
        My Consultations
    </h2>

    <div class="space-y-4">
        @foreach($consultations as $consultation)
            <div class="bg-white shadow rounded p-4 flex justify-between items-center">
                <div>
                    <!-- Farmer Name -->
                    <h3 class="text-lg font-semibold text-green-700">
                        Farmer: {{ $consultation->farmer->name ?? 'Unknown' }}
                    </h3>

                    <!-- Date & Time -->
                    <p class="text-gray-500">
                        Date: {{ \Carbon\Carbon::parse($consultation->date)->format('M d, Y') }}
                        | Time: {{ \Carbon\Carbon::parse($consultation->time)->format('h:i A') }}
                    </p>

                    <!-- Fee -->
                    @if($consultation->expert && $consultation->expert->expertProfile)
                        <p class="text-gray-500">
                            Fee: Rs. {{ $consultation->expert->expertProfile->consultation_fee }}
                        </p>
                    @endif
                </div>

                <div>
                    @php
                        $consultationDateTime = \Carbon\Carbon::createFromFormat(
                            'Y-m-d H:i:s',
                            $consultation->date . ' ' . date('H:i:s', strtotime($consultation->time)),
                            'Asia/Kathmandu'
                        );
                        $consultationEndTime = $consultationDateTime->copy()->addMinutes(($consultation->duration ?? 0) + 5);
                    @endphp

                    <!-- Live Chat Control -->
                    <div id="expert-chat-{{ $consultation->id }}">
                        @if(now('Asia/Kathmandu')->lessThan($consultationDateTime))
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                Chat unlocks at {{ $consultationDateTime->format('M d, Y h:i A') }}
                            </span>
                        @elseif(now('Asia/Kathmandu')->between($consultationDateTime, $consultationEndTime))
                            <button
                                onclick="openChat('{{ route('chatify') }}?id={{ $consultation->farmer->id }}')"
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                Live Chat
                            </button>
                        @else
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                Chat closed
                            </span>
                        @endif
                    </div>

                    <!-- Auto-update script -->
                    <script>
                        (function() {
                            const unlockTime = new Date("{{ $consultationDateTime->format('Y-m-d H:i:s') }}").getTime();
                            const endTime = new Date("{{ $consultationEndTime->format('Y-m-d H:i:s') }}").getTime();
                            const chatDiv = document.getElementById("expert-chat-{{ $consultation->id }}");

                            function updateChatStatus() {
                                const now = new Date().getTime();
                                if (now >= unlockTime && now <= endTime) {
                                    chatDiv.innerHTML = `<button
                                        onclick="openChat('{{ route('chatify') }}?id={{ $consultation->farmer->id }}')"
                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                        Live Chat
                                    </button>`;
                                } else if (now < unlockTime) {
                                    chatDiv.innerHTML = `<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        Chat unlocks at {{ $consultationDateTime->format('M d, Y h:i A') }}
                                    </span>`;
                                } else {
                                    chatDiv.innerHTML = `<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        Chat closed
                                    </span>`;
                                }
                            }

                            setInterval(updateChatStatus, 1000);
                            updateChatStatus();
                        })();
                    </script>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

<!-- Hidden Chat Section -->
<div id="chat-section" class="hidden mt-10 p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Live Chat</h2>
        <button onclick="backToConsultations()"
                class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 text-sm">
            Back to Consultations
        </button>
    </div>
    <iframe id="chat-frame" src="" class="w-full h-[600px] border-0 rounded"></iframe>
</div>

<script>
function openChat(url) {
    document.getElementById('expert-consultations').classList.add('hidden');
    document.getElementById('chat-section').classList.remove('hidden');
    document.getElementById('chat-frame').src = url;
}

function backToConsultations() {
    document.getElementById('chat-section').classList.add('hidden');
    document.getElementById('expert-consultations').classList.remove('hidden');
    document.getElementById('chat-frame').src = "";
}
</script>@if($consultations->isNotEmpty())
<section id="expert-consultations" class="mt-10 p-6 bg-gray-50 rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2 mb-4">
        My Consultations
    </h2>

    <div class="space-y-4">
        @foreach($consultations as $consultation)
            <div class="bg-white shadow rounded p-4 flex justify-between items-center">
                <div>
                    <!-- Farmer Name -->
                    <h3 class="text-lg font-semibold text-green-700">
                        Farmer: {{ $consultation->farmer->name ?? 'Unknown' }}
                    </h3>

                    <!-- Date & Time -->
                    <p class="text-gray-500">
                        Date: {{ \Carbon\Carbon::parse($consultation->date)->format('M d, Y') }}
                        | Time: {{ \Carbon\Carbon::parse($consultation->time)->format('h:i A') }}
                    </p>

                    <!-- Fee -->
                    @if($consultation->expert && $consultation->expert->expertProfile)
                        <p class="text-gray-500">
                            Fee: Rs. {{ $consultation->expert->expertProfile->consultation_fee }}
                        </p>
                    @endif
                </div>

                <div>
                    @php
                        $consultationDateTime = \Carbon\Carbon::createFromFormat(
                            'Y-m-d H:i:s',
                            $consultation->date . ' ' . date('H:i:s', strtotime($consultation->time)),
                            'Asia/Kathmandu'
                        );
                        $consultationEndTime = $consultationDateTime->copy()->addMinutes(($consultation->duration ?? 0) + 5);
                    @endphp

                    <!-- Live Chat Control -->
                    <div id="expert-chat-{{ $consultation->id }}">
                        @if(now('Asia/Kathmandu')->lessThan($consultationDateTime))
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                Chat unlocks at {{ $consultationDateTime->format('M d, Y h:i A') }}
                            </span>
                        @elseif(now('Asia/Kathmandu')->between($consultationDateTime, $consultationEndTime))
                            <button
                                onclick="openChat('{{ route('chatify') }}?id={{ $consultation->farmer->id }}')"
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                Live Chat
                            </button>
                        @else
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                Chat closed
                            </span>
                        @endif
                    </div>

                    <!-- Auto-update script -->
                    <script>
                        (function() {
                            const unlockTime = new Date("{{ $consultationDateTime->format('Y-m-d H:i:s') }}").getTime();
                            const endTime = new Date("{{ $consultationEndTime->format('Y-m-d H:i:s') }}").getTime();
                            const chatDiv = document.getElementById("expert-chat-{{ $consultation->id }}");

                            function updateChatStatus() {
                                const now = new Date().getTime();
                                if (now >= unlockTime && now <= endTime) {
                                    chatDiv.innerHTML = `<button
                                        onclick="openChat('{{ route('chatify') }}?id={{ $consultation->farmer->id }}')"
                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                        Live Chat
                                    </button>`;
                                } else if (now < unlockTime) {
                                    chatDiv.innerHTML = `<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        Chat unlocks at {{ $consultationDateTime->format('M d, Y h:i A') }}
                                    </span>`;
                                } else {
                                    chatDiv.innerHTML = `<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        Chat closed
                                    </span>`;
                                }
                            }

                            setInterval(updateChatStatus, 1000);
                            updateChatStatus();
                        })();
                    </script>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

<!-- Hidden Chat Section -->
<div id="chat-section" class="hidden mt-10 p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Live Chat</h2>
        <button onclick="backToConsultations()"
                class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 text-sm">
            Back to Consultations
        </button>
    </div>
    <iframe id="chat-frame" src="" class="w-full h-[600px] border-0 rounded"></iframe>
</div>

<script>
function openChat(url) {
    document.getElementById('expert-consultations').classList.add('hidden');
    document.getElementById('chat-section').classList.remove('hidden');
    document.getElementById('chat-frame').src = url;
}

function backToConsultations() {
    document.getElementById('chat-section').classList.add('hidden');
    document.getElementById('expert-consultations').classList.remove('hidden');
    document.getElementById('chat-frame').src = "";
}
</script>
{{--
<section id="expert-queries" class="mt-10 p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-black border-b pb-2 mb-4">
        Farmer Queries
    </h2>

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

    @if($queries->count())
        @foreach($queries as $query)
            <div class="border-b py-5">
                <!-- Query -->
                <p class="font-medium text-gray-900">{{ $query->question }}</p>

                <!-- Asked by -->
                <small class="block text-gray-700 mt-1">
                    Asked by <span class="font-semibold">{{ $query->user->name }}</span>
                </small>

                <!-- Crop/Disease + Date -->
                <small class="block text-gray-500 mt-1">
                    @if($query->crop) Crop: {{ $query->crop->name }} @endif
                    @if($query->disease) • Disease: {{ $query->disease->name }} @endif
                    • {{ $query->created_at->format('d M Y') }}
                </small>

                <!-- Replies -->
                <div class="mt-3 pl-4 border-l-4 border-green-200">
                    @forelse($query->replies as $reply)
                        <p class="text-sm text-gray-700">{{ $reply->reply }}</p>
                        <small class="text-gray-500">
                            By <span class="font-semibold">{{ $reply->expert->name }}</span>
                            • {{ $reply->created_at->format('d M Y') }}
                        </small>
                    @empty
                        <p class="text-sm text-gray-500 italic">No replies yet.</p>
                    @endforelse
                </div>

                <!-- Reply Form -->
                <form action="{{ route('queries.reply', $query->id) }}" method="POST" class="mt-4">
                    @csrf
                    <label class="block text-sm font-medium text-gray-700 mb-2">Write your reply:</label>
                    <textarea name="reply" rows="3"
                              class="w-full border rounded-lg p-3 mb-3 focus:ring-2 focus:ring-green-400 focus:outline-none"
                              placeholder="Type your helpful answer..."></textarea>
                    <button type="submit"
                            class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition font-semibold">
                        Submit Reply
                    </button>
                </form>
            </div>
        @endforeach
    @else
        <p class="text-gray-500">No queries yet.</p>
    @endif
</section> --}}

<section id="expert-queries" class="mt-10 p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-black border-b pb-2 mb-4">
        Farmer Queries
    </h2>

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

    <!-- Container for queries -->
    <div id="expert-queries-container">
        @include('expert.partials.queries', ['queries' => $queries])
    </div>
</section>

<script>
function loadQueries() {
    fetch("{{ route('expert.queries') }}")
        .then(response => response.text())
        .then(html => {
            document.getElementById('expert-queries-container').innerHTML = html;
        });
}

// Poll every 5 seconds
setInterval(loadQueries, 5000);
</script>

</main>
</div>

<!-- JS -->
<script src="{{asset('js/admin-dash.js')}}"></script>
</body>
</html>
