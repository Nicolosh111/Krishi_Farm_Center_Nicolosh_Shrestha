<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Krishi Farm Center Farmer Dashboard</title>
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
    {{-- <a href="#" data-section="crops" class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-seedling mr-2"></i> My Crops
    </a> --}}
    <a href="#" data-section="farmer-uploads" class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-upload mr-2"></i> My Uploads
    </a>
    <a href="#" data-section="stories" class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-book mr-2"></i> Agro Stories
    </a>
    {{-- <a href="#" data-section="disease" class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-notes-medical mr-2"></i> Disease Help
    </a> --}}
    <a href="#" data-section="experts"
    class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-user-md mr-2"></i> Consult Experts
    </a>
    <a href="#" data-section="my-consultations"
    class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fas fa-calendar-check mr-2"></i> My Consultations
    </a>
    <a href="#" data-section="payments"
   class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
    <i class="fas fa-credit-card mr-2"></i> Payments
</a>
 <a href="#" data-section="ask-queries"
    class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
        <i class="fa fa-question-circle mr-2"></i> Ask Queries
    </a>
    <a href="#" data-section="my-queries"
   class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
    <i class="fa fa-comments mr-2"></i> My Queries
</a>

<a href="#" data-section="schemes"
   class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
    <i class="fa fa-university mr-2"></i> Government Schemes
</a>

<a href="#" data-section="market"
   class="nav-link flex items-center p-2 rounded hover:bg-yellow-500 hover:text-white transition-colors duration-300 ease-in-out">
    <i class="fa fa-line-chart mr-2"></i> Market Prices
</a>

  </nav>
<div class="p-4 border-t border-green-700">
    <a href="{{ route('home') }}"
       class="flex items-center p-2 rounded hover:bg-red-600 hover:text-white transition-colors duration-300 ease-in-out w-full text-left">
        <i class="fas fa-home mr-2 text-white-600"></i> Back to Home
    </a>
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
        <h1 class="text-xl font-semibold">Farmer Dashboard</h1>
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
    <h2 class="text-xl font-semibold mb-4">Dashboard Overview</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">

        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
            <div>
                <h3 class="text-gray-500 text-sm">My Uploads</h3>
                <p class="text-2xl font-bold text-green-700">{{ $totalUploads }}</p>
            </div>
            <i class="fas fa-upload text-green-500 text-2xl"></i>
        </div>

        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
            <div>
                <h3 class="text-gray-500 text-sm">Agro Stories</h3>
                <p class="text-2xl font-bold text-green-700">{{ $totalStories }}</p>
            </div>
            <i class="fas fa-book-open text-blue-500 text-2xl"></i>
        </div>

        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
            <div>
                <h3 class="text-gray-500 text-sm">Consult Experts</h3>
                <p class="text-2xl font-bold text-green-700">{{ $totalExperts }}</p>
            </div>
            <i class="fas fa-user-md text-purple-500 text-2xl"></i>
        </div>

        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
            <div>
                <h3 class="text-gray-500 text-sm">My Consultations</h3>
                <p class="text-2xl font-bold text-green-700">{{ $totalConsults }}</p>
            </div>
            <i class="fas fa-calendar-check text-yellow-500 text-2xl"></i>
        </div>

        <div class="bg-white shadow rounded p-4 flex justify-between items-center hover:shadow-lg transition-shadow">
            <div>
                <h3 class="text-gray-500 text-sm">Payments</h3>
                <p class="text-2xl font-bold text-green-700">{{ $totalPayments }}</p>
            </div>
            <i class="fas fa-credit-card text-green-500 text-2xl"></i>
        </div>

    </div>


    <!-- Weather Section -->
<div class="bg-white shadow rounded p-6 mb-6">
  <h3 class="text-lg font-semibold text-green-700 mb-4">
    <i class="fas fa-cloud-sun mr-2 text-yellow-500"></i> Weather Forecast
  </h3>
  <p class="text-sm text-gray-600 mb-4">Location: {{ $locationName }}</p>

  {{-- Current Weather --}}
  @if(isset($weather['current']))
    <div class="mb-4">
      <h4 class="font-medium">Now</h4>
      <p><i class="fas fa-thermometer-half text-red-500"></i> Temp: {{ round($weather['current']['temp_c']) }} °C</p>
      <p><i class="fas fa-cloud-sun text-yellow-500"></i> Condition: {{ $weather['current']['condition']['text'] }}</p>
      <p><i class="fas fa-wind text-blue-500"></i> Wind: {{ $weather['current']['wind_kph'] }} kph</p>
      <p><i class="fas fa-tint text-blue-400"></i> Humidity: {{ $weather['current']['humidity'] }}%</p>
    </div>
  @else
    <p class="text-red-600">Current weather unavailable.</p>
  @endif

  {{-- Forecast --}}
  @if(isset($weather['forecast']['forecastday']))
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      @foreach($weather['forecast']['forecastday'] as $day)
        <div class="bg-green-50 rounded p-3 text-center">
          <h5 class="text-green-700 font-semibold">
            {{ \Carbon\Carbon::parse($day['date'])->format('D, M j') }}
          </h5>
          <p><i class="fas fa-temperature-high text-red-500"></i> Max: {{ round($day['day']['maxtemp_c']) }} °C</p>
          <p><i class="fas fa-temperature-low text-blue-500"></i> Min: {{ round($day['day']['mintemp_c']) }} °C</p>
          <p><i class="fas fa-cloud-rain text-blue-400"></i> Rain chance: {{ $day['day']['daily_chance_of_rain'] }}%</p>
          <p><i class="fas fa-cloud-sun text-yellow-500"></i> {{ $day['day']['condition']['text'] }}</p>
        </div>
      @endforeach
    </div>
  @else
    <p class="text-red-600">Forecast unavailable.</p>
  @endif
</div>
    </section>

<section id="experts" class="p-6 bg-gray-50 rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2 mb-4">
        Available Experts
    </h2>

     @if(session('success'))
        <div id="successAlert" class="mb-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif


    <!-- Filter Bar -->
    {{-- <form id="expertSearchForm" method="GET" action="{{ route('experts.index') }}"
          class="flex flex-wrap gap-4 mb-6 items-center">
        <input type="text" name="specialization" placeholder="Specialization" class="flex-1 border rounded px-3 py-2">
        <input type="number" name="min_fee" placeholder="Min Fee" class="w-32 border rounded px-3 py-2">
        <input type="number" name="max_fee" placeholder="Max Fee" class="w-32 border rounded px-3 py-2">
        <input type="number" name="experience_years" placeholder="Min Experience" class="w-40 border rounded px-3 py-2">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Search</button>
    </form> --}}

    <!-- Results container -->
    <div id="expertResults">
        @include('partials.expert-results', ['experts' => $experts])
    </div>
</section>

<!-- Modal -->
<div id="expertModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full p-6 relative">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
        <div id="expertModalContent">
            <!-- Expert details will be loaded here -->
        </div>
    </div>
</div>

<script>
function loadExperts(url) {
    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(res => res.text())
    .then(html => {
        document.getElementById('expertResults').innerHTML = html;
    });
}

document.getElementById('expertSearchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const params = new URLSearchParams(formData);
    loadExperts(this.action + '?' + params);

    // Clear the form fields after search
    this.reset();
});

document.addEventListener('click', function(e) {
    if (e.target.closest('#expertResults .pagination a')) {
        e.preventDefault();
        const url = e.target.getAttribute('href');
        loadExperts(url);
    }
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alert = document.getElementById('successAlert');
        if (alert) {
            setTimeout(() => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }, 4000);
        }
    });
</script>

<section id="my-consultations" class="mt-10 p-6 bg-gray-50 rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2 mb-4">
        My Consultations
    </h2>

    <!-- Success Message -->
    @if(session('success'))
        <div id="success-message" class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($consultations->isEmpty())
        <p class="text-gray-500">You have no consultations.</p>
    @else
        <div class="space-y-4">
            @foreach($consultations as $consultation)
                <div class="bg-white shadow rounded p-4 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-green-700">
                            Expert: {{ $consultation->expert->name }}
                        </h3>
                        <p class="text-gray-600">
                            Specialization: {{ $consultation->expert->expertProfile->specialization ?? 'General Agriculture' }}
                        </p>
                        @if($consultation->notes)
                            <p class="text-gray-500">Notes: {{ $consultation->notes }}</p>
                        @endif
                        @if($consultation->expert->expertProfile?->consultation_fee)
                            <p class="text-gray-500">Fee: Rs. {{ $consultation->expert->expertProfile->consultation_fee }}</p>
                        @endif
                        <p class="text-gray-500">
                            Date: {{ \Carbon\Carbon::parse($consultation->date)->format('M d, Y') }}
                            | Time: {{ \Carbon\Carbon::parse($consultation->time)->format('h:i A') }}
                        </p>
                        @if($consultation->duration)
                            <p class="text-gray-500">Duration: {{ $consultation->duration }} minutes</p>
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Status Badges -->
                        @if($consultation->status === 'upcoming')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">Upcoming</span>
                        @elseif($consultation->status === 'completed')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">Completed</span>
                        @elseif($consultation->status === 'cancelled')
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">Cancelled</span>
                        @endif

                        @if($consultation->payment_status === 'paid')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">Paid</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">Unpaid</span>
                        @endif

                        @if($consultation->refund)
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                @if($consultation->refund->status === 'approved')
                                    bg-green-100 text-green-700
                                @elseif($consultation->refund->status === 'pending')
                                    bg-yellow-100 text-yellow-700
                                @elseif($consultation->refund->status === 'rejected')
                                    bg-red-100 text-red-700
                                @else
                                    bg-gray-100 text-gray-700
                                @endif">
                                Refund {{ ucfirst($consultation->refund->status) }}
                            </span>
                        @endif

                        <!-- Cancel Button -->
                        @if($consultation->status === 'upcoming')
                            <form action="{{ route('consultation.cancel', $consultation->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                                    Cancel
                                </button>
                            </form>
                        @endif

                        <!-- Refund Button -->
                        @if($consultation->status === 'cancelled' && $consultation->payment_status === 'paid' && !$consultation->refund)
                            <form action="{{ route('refund.request', $consultation->id) }}" method="POST">
                                @csrf
                                <textarea name="reason" rows="2" class="border rounded p-2 w-full text-sm mb-2"
                                          placeholder="Enter refund reason..." required></textarea>
                                <button type="submit"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                                    Request Refund
                                </button>
                            </form>
                        @endif

                        <!-- Live Chat Control -->
                        @php
                            $consultationDateTime = \Carbon\Carbon::createFromFormat(
                                'Y-m-d H:i:s',
                                $consultation->date . ' ' . date('H:i:s', strtotime($consultation->time)),
                                'Asia/Kathmandu'
                            );
                            $consultationEndTime = $consultationDateTime->copy()->addMinutes(($consultation->duration ?? 0) + 5);
                        @endphp

                        <div id="chat-control-{{ $consultation->id }}">
                            @if(now('Asia/Kathmandu')->lessThan($consultationDateTime))
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Chat unlocks at {{ $consultationDateTime->format('M d, Y h:i A') }}
                                </span>
                            @elseif(now('Asia/Kathmandu')->between($consultationDateTime, $consultationEndTime))
                                <button
                                    onclick="openChat('{{ route('chatify') }}?id={{ $consultation->expert->id }}')"
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
                                const chatDiv = document.getElementById("chat-control-{{ $consultation->id }}");

                                function updateChatStatus() {
                                    const now = new Date().getTime();
                                    if (now >= unlockTime && now <= endTime) {
                                        chatDiv.innerHTML = `<button
                                            onclick="openChat('{{ route('chatify') }}?id={{ $consultation->expert->id }}')"
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

                                // Check every second
                                setInterval(updateChatStatus, 1000);
                                updateChatStatus();
                            })();
                        </script>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>

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
    document.getElementById('my-consultations').classList.add('hidden');
    document.getElementById('chat-section').classList.remove('hidden');
    document.getElementById('chat-frame').src = url;
}

function backToConsultations() {
    document.getElementById('chat-section').classList.add('hidden');
    document.getElementById('my-consultations').classList.remove('hidden');
    document.getElementById('chat-frame').src = "";
}
</script>

<script>
    // Auto-hide success message after 3 seconds
    setTimeout(() => {
        const successMsg = document.getElementById('success-message');
        if (successMsg) {
            successMsg.style.transition = "opacity 0.5s ease";
            successMsg.style.opacity = "0";
            setTimeout(() => successMsg.remove(), 500);
        }

    }, 3000);

    // Auto-hide error message after 5 seconds
    setTimeout(() => {
        const errorMsg = document.getElementById('error-message');
        if (errorMsg) {
            errorMsg.style.transition = "opacity 0.5s ease";
            errorMsg.style.opacity = "0";
            setTimeout(() => errorMsg.remove(), 500);
        }
    }, 5000);
</script>

<section id="payments" class="p-6 bg-white rounded shadow mt-6">
    <h2 class="text-xl font-bold mb-4">My Payments</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">Date</th>
                <th class="p-2">Expert</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Status</th>
                <th class="p-2">Transaction ID</th>
                <th class="p-2">Refund Status</th>
                <th class="p-2">Refund Reason</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr class="border-b">
                    <td class="p-2">{{ $payment->created_at->format('d M Y') }}</td>
                    <td class="p-2">{{ $payment->expert->name ?? '' }}</td>
                    <td class="p-2">
                        @if($payment->expert && $payment->expert->expertProfile)
                            NPR {{ $payment->expert->expertProfile->consultation_fee }}
                        @endif
                    </td>
                    <td class="p-2">
                        <span class="px-2 py-1 rounded text-sm
                            @if($payment->payment_status === 'paid')
                                bg-green-200 text-green-800
                            @elseif($payment->payment_status === 'unpaid')
                                bg-yellow-200 text-yellow-800
                            @else
                                bg-red-200 text-red-800
                            @endif">
                            {{ ucfirst($payment->payment_status) }}
                        </span>
                    </td>
                    <td class="p-2">{{ $payment->transaction_id ?? '' }}</td>
                    <td class="p-2">
                        @if($payment->refund_status)
                            <span class="px-2 py-1 rounded text-sm
                                @if($payment->refund_status === 'pending')
                                    bg-yellow-200 text-yellow-800
                                @elseif($payment->refund_status === 'approved')
                                    bg-green-200 text-green-800
                                @elseif($payment->refund_status === 'rejected')
                                    bg-red-200 text-red-800
                                @else
                                    bg-gray-200 text-gray-800
                                @endif">
                                {{ ucfirst($payment->refund_status) }}
                            </span>
                        @endif
                    </td>
                    <td class="p-2">
                        @if($payment->refund)
                            {{ $payment->refund->reason }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">
                        No payments found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
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
{{--
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
  <form id="adminProfileForm" method="POST" action="{{ route('admin.profile.update') }}" class="bg-white shadow rounded p-6 mt-6">
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

    <!-- Submit -->
    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
      Update Profile
    </button>
    <a href="{{ route('farmer.dashboard') }}"
         class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
        Cancel
      </a>
  </form>
</section> --}}
{{--
<!-- Farmer Profile Section -->
<section id="profile" class="hidden">
    <h2 class="text-2xl font-semibold mb-6">Farmer Profile</h2>

    <!-- Profile Card -->
    <div class="bg-white shadow rounded p-6 mb-6 flex items-center space-x-6">
        <div>
            @if(Auth::user()->farmerProfile?->profile_image)
                <img src="{{ asset('storage/' . Auth::user()->farmerProfile->profile_image) }}"
                     class="w-28 h-28 rounded-full object-cover">
            @else
                <i class="fas fa-user-circle text-gray-400 text-7xl"></i>
            @endif
        </div>

        <div>
            <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>
            <p class="text-gray-600">{{ Auth::user()->email }}</p>
            <p class="text-sm text-gray-500">Role: Farmer</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Edit Profile Form -->
    <form method="POST"
          action="{{ route('farmer.profile.update') }}"
          enctype="multipart/form-data"
          class="bg-white shadow rounded p-6">

        @csrf
        @method('PUT')

        <!-- BASIC INFO -->
        <h3 class="text-lg font-semibold mb-4">Basic Information</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <!-- Name -->
            <div>
                <label class="block font-medium mb-1">Name</label>
                <input type="text" name="name"
                       value="{{ old('name', Auth::user()->name) }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <!-- Email -->
            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" name="email"
                       value="{{ old('email', Auth::user()->email) }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <!-- Phone -->
            <div>
                <label class="block font-medium mb-1">Phone</label>
                <input type="text" name="phone"
                       value="{{ old('phone', Auth::user()->farmerProfile->phone ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- Location -->
            <div>
                <label class="block font-medium mb-1">Location</label>
                <input type="text" name="location"
                       value="{{ old('location', Auth::user()->farmerProfile->location ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <!-- FARM DETAILS -->
        <h3 class="text-lg font-semibold mb-4">Farm Details</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label class="block font-medium mb-1">Experience (years)</label>
                <input type="number" name="experience"
                       value="{{ old('experience', Auth::user()->farmerProfile->experience ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium mb-1">Farm Size</label>
                <input type="text" name="farm_size"
                       value="{{ old('farm_size', Auth::user()->farmerProfile->farm_size ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium mb-1">Primary Crop</label>
                <input type="text" name="primary_crop"
                       value="{{ old('primary_crop', Auth::user()->farmerProfile->primary_crop ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <!-- EXTRA -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-medium mb-1">Irrigation Type</label>
                <select name="irrigation_type" class="w-full border rounded px-3 py-2">
                    <option value="">Select</option>
                    <option value="Rain-fed" @selected((Auth::user()->farmerProfile->irrigation_type ?? '') === 'Rain-fed')>Rain-fed</option>
                    <option value="Canal" @selected((Auth::user()->farmerProfile->irrigation_type ?? '') === 'Canal')>Canal</option>
                    <option value="Tube well" @selected((Auth::user()->farmerProfile->irrigation_type ?? '') === 'Tube well')>Tube well</option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Profile Image</label>
                <input type="file" name="profile_image"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <!-- BIO -->
        <div class="mb-6">
            <label class="block font-medium mb-1">Bio</label>
            <textarea name="bio"
                      rows="4"
                      class="w-full border rounded px-3 py-2">{{ old('bio', Auth::user()->farmerProfile->bio ?? '') }}</textarea>
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

            <a href="{{ route('farmer.dashboard') }}"
               class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                Cancel
            </a>
        </div>

    </form>
</section> --}}

{{-- <section id="schemes" class="p-6 bg-white rounded shadow mt-6 hidden">
    <h2 class="text-xl font-bold mb-4">Government Schemes</h2>
     <h3 class="text-md font-semibold text-gray-600 mb-4">
        Source: Ministry of Agriculture and Livestock Development (MoALD), Nepal
    </h3>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">Title</th>
                <th class="p-2">Description</th>
                <th class="p-2">Link</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schemes as $scheme)
                <tr class="border-b">
                    <td class="p-2">{{ $scheme->title }}</td>
                    <td class="p-2">{{ $scheme->description }}</td>
                    <td class="p-2">
                        <a href="{{ $scheme->link }}" target="_blank"
                        class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-3 py-1 rounded inline-block">
                            View Notice
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">
                        No schemes available.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section> --}}
{{--
<section id="market" class="p-6 bg-white rounded shadow mt-6 hidden">
    <h2 class="text-xl font-bold mb-4">Market Prices</h2>
    <h3 class="text-md font-semibold text-gray-600 mb-4">
        Source: Kalimati Fruits and Vegetable Market Development Board, Kathmandu
    </h3>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">Crop</th>
                <th class="p-2">Unit</th>
                <th class="p-2">Min Price</th>
                <th class="p-2">Max Price</th>
                <th class="p-2">Average Price</th>
                <th class="p-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prices as $price)
                <tr class="border-b">
                    <td class="p-2">{{ $price->crop_name }}</td>
                    <td class="p-2">{{ $price->location }}</td>
                    <td class="p-2">{{ number_format($price->min_price, 2) }}</td>
                    <td class="p-2">{{ number_format($price->max_price, 2) }}</td>
                    <td class="p-2">{{ number_format($price->price, 2) }}</td>
                    <td class="p-2">{{ $price->date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">
                        No prices available.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section> --}}

{{-- <section id="market" class="p-6 bg-white rounded shadow mt-6">
    <h2 class="text-xl font-bold mb-2 text-green-700">Market Prices</h2>
    <h3 class="text-md font-semibold text-gray-600 mb-4">
        Source: Kalimati Fruits and Vegetable Market Development Board, Kathmandu
    </h3>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">Crop</th>
                <th class="p-2">Unit</th>
                <th class="p-2">Min Price</th>
                <th class="p-2">Max Price</th>
                <th class="p-2">Average Price</th>
                <th class="p-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prices as $price)
                <tr class="border-b">
                    <td class="p-2">{{ $price->crop_name }}</td>
                    <td class="p-2">{{ $price->location }}</td>
                    <td class="p-2">{{ number_format($price->min_price, 2) }}</td>
                    <td class="p-2">{{ number_format($price->max_price, 2) }}</td>
                    <td class="p-2">{{ number_format($price->price, 2) }}</td>
                    <td class="p-2">{{ $price->date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">
                        No prices available.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $prices->links() }}
    </div>
</section>
 --}}

 {{-- <section id="market" class="p-6 bg-white rounded shadow mt-6">
    <h2 class="text-xl font-bold mb-2 text-green-700">Market Prices</h2>
    <h3 class="text-md font-semibold text-gray-600 mb-4">
        Source: Kalimati Fruits and Vegetable Market Development Board, Kathmandu
    </h3>

    <div id="market-table">
        @include('farmer.partials.market_prices_table', ['prices' => $prices])
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const marketTable = document.querySelector('#market-table');

    marketTable.addEventListener('click', function (e) {
        if (e.target.tagName === 'A' && e.target.closest('.pagination')) {
            e.preventDefault();
            const url = e.target.getAttribute('href');

            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(response => response.text())
                .then(html => {
                    marketTable.innerHTML = html;
                });
        }
    });
});
</script> --}}

{{-- <section id="schemes" class="p-6 bg-white rounded shadow mt-6">
    <h2 class="text-xl font-bold mb-2 text-green-700">Government Schemes</h2>
    <h3 class="text-md font-semibold text-gray-600 mb-4">
        Source: Ministry of Agriculture and Livestock Development (MoALD), Nepal
    </h3>

    <div id="schemes-table">
        @include('farmer.partials.schemes_table', ['schemes' => $schemes])
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const schemesTable = document.querySelector('#schemes-table');

    schemesTable.addEventListener('click', function (e) {
        const link = e.target.closest('a');
        if (!link) return;

        const url = link.getAttribute('href');
        if (!url || !url.includes('page=')) return;

        e.preventDefault();

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                schemesTable.innerHTML = html;
            })
            .catch(err => console.error('Error fetching page:', err));
    });
});
</script> --}}

<section id="schemes" class="p-6 bg-white rounded shadow mt-6">
    <h2 class="text-xl font-bold mb-2 text-green-700">Government Schemes</h2>
    <h3 class="text-md font-semibold text-gray-600 mb-4">
        Source: Ministry of Agriculture and Livestock Development (MoALD), Nepal
    </h3>

    <div id="schemes-table">
        @include('farmer.partials.schemes_table', ['schemes' => $schemes])
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const schemesTable = document.querySelector('#schemes-table');

    schemesTable.addEventListener('click', function (e) {
        const link = e.target.closest('a');
        if (!link) return;

        const url = link.getAttribute('href');
        if (!url || !url.includes('schemes_page')) return;

        e.preventDefault();

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                schemesTable.innerHTML = html;
            })
            .catch(err => console.error('Error fetching page:', err));
    });
});
</script>

<section id="market" class="p-6 bg-white rounded shadow mt-6">
    <h2 class="text-xl font-bold mb-2 text-green-700">Market Prices</h2>
    <h3 class="text-md font-semibold text-gray-600 mb-4">
        Source: Kalimati Fruits and Vegetable Market Development Board, Kathmandu
    </h3>

    <!-- Table -->
    <div id="market-table">
        @include('farmer.partials.market_prices_table', ['prices' => $prices])
    </div>

    <!-- Market Comparison Bar Chart -->
    <h3 class="text-md font-semibold text-gray-600 mt-6 mb-2">Market Comparison (Today)</h3>
    <div class="mb-2 space-x-2">
        <button id="showAll" class="bg-green-600 text-white px-3 py-1 rounded">Show All</button>
        <button id="showTop10Expensive" class="bg-blue-600 text-white px-3 py-1 rounded">Top 10 Expensive</button>
        <button id="showTop10Cheapest" class="bg-orange-600 text-white px-3 py-1 rounded">Top 10 Cheapest</button>
    </div>
    <canvas id="marketComparisonChart" width="400" height="200"></canvas>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const marketTable = document.querySelector('#market-table');
    const ctxComparison = document.getElementById('marketComparisonChart').getContext('2d');
    let marketComparisonChart = null;
    let mode = "all"; // "all", "expensive", "cheapest"

    function updateComparisonChart() {
        fetch('/market-comparison-data')
            .then(response => response.json())
            .then(todayPrices => {
                let labels, data;

                if (mode === "expensive") {
                    const sorted = [...todayPrices].sort((a, b) => b.price - a.price);
                    const top10 = sorted.slice(0, 10);
                    labels = top10.map(item => item.crop_name);
                    data = top10.map(item => parseFloat(item.price));
                } else if (mode === "cheapest") {
                    const sorted = [...todayPrices].sort((a, b) => a.price - b.price);
                    const bottom10 = sorted.slice(0, 10);
                    labels = bottom10.map(item => item.crop_name);
                    data = bottom10.map(item => parseFloat(item.price));
                } else {
                    labels = todayPrices.map(item => item.crop_name);
                    data = todayPrices.map(item => parseFloat(item.price));
                }

                if (marketComparisonChart) marketComparisonChart.destroy();

                marketComparisonChart = new Chart(ctxComparison, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: mode === "expensive" ? "Top 10 Expensive Crops (Rs)" :
                                   mode === "cheapest" ? "Top 10 Cheapest Crops (Rs)" :
                                   "Today's Prices (Rs)",
                            data: data,
                            backgroundColor: 'rgba(34,197,94,0.6)',
                            borderColor: 'rgba(34,197,94,1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { title: { display: true, text: 'Crop' } },
                            y: { title: { display: true, text: 'Price (Rs)' } }
                        }
                    }
                });
            });
    }

    // Initial render
    updateComparisonChart();

    // Button handlers
    document.getElementById('showAll').addEventListener('click', () => {
        mode = "all";
        updateComparisonChart();
    });
    document.getElementById('showTop10Expensive').addEventListener('click', () => {
        mode = "expensive";
        updateComparisonChart();
    });
    document.getElementById('showTop10Cheapest').addEventListener('click', () => {
        mode = "cheapest";
        updateComparisonChart();
    });

    // Handle AJAX pagination (table only)
    marketTable.addEventListener('click', function (e) {
        const link = e.target.closest('a');
        if (!link) return;

        const url = link.getAttribute('href');
        if (!url || !url.includes('prices_page')) return;

        e.preventDefault();

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                marketTable.innerHTML = html;
                // Chart does NOT change here — it always shows all crops (or top 10 depending on mode)
            })
            .catch(err => console.error('Error fetching page:', err));
    });
});
</script>


<!-- Farmer Profile Section -->
<section id="profile">
    <h2 class="text-2xl font-semibold mb-6">Farmer Profile</h2>

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
            @if(Auth::user()->farmerProfile?->profile_image)
                <img src="{{ asset('storage/' . Auth::user()->farmerProfile->profile_image) }}"
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
            <p class="mb-2">Phone: {{ Auth::user()->farmerProfile->phone ?? 'N/A' }}</p>
            <p class="mb-2">Location: {{ Auth::user()->farmerProfile->location ?? 'N/A' }}</p>
            <p class="mb-2">Experience:
                {{ Auth::user()->farmerProfile->experience ? Auth::user()->farmerProfile->experience . ' years' : 'N/A' }}
            </p>
            <p class="mb-2">Bio: {{ Auth::user()->farmerProfile->bio ?? 'N/A' }}</p>

            <!-- Edit Button -->
            <button onclick="document.getElementById('edit-form').classList.toggle('hidden')"
                    class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Edit Profile
            </button>
        </div>
    </div>

    <!-- Edit Profile Form (Initially Hidden) -->
    <form id="edit-form" method="POST"
          action="{{ route('farmer.profile.update') }}"
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
            {{-- <div>
                <label class="block font-medium mb-1">Location</label>
                <input type="text" name="location"
                       value="{{ old('location', Auth::user()->farmerProfile->location ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div> --}}
            <div>
                <label class="block font-medium mb-1">Location</label>
                <input type="text" id="location" name="location"
                    value="{{ old('location', Auth::user()->farmerProfile->location ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <!-- FARMER INFORMATION -->
        <h3 class="text-lg font-semibold mb-4">Farmer Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-medium mb-1">Experience (years)</label>
                <input type="number" name="experience"
                       value="{{ old('experience', Auth::user()->farmerProfile->experience ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Phone</label>
                <input type="text" name="phone"
                       value="{{ old('phone', Auth::user()->farmerProfile->phone ?? '') }}"
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
                      class="w-full border rounded px-3 py-2">{{ old('bio', Auth::user()->farmerProfile->bio ?? '') }}</textarea>
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            // Call Laravel endpoint to reverse geocode
            fetch(`/set-location?lat=${lat}&lon=${lon}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("location").value = data.locationName;
                })
                .catch(err => console.error("Location error:", err));
        });
    }
});
</script>


<section id="farmer-uploads" class="hidden">
    <div class="bg-white shadow rounded-lg p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">My Uploads</h2>
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
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Uploaded At</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Diagnosis Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plantImages as $upload)
                    @if($upload->user_id === Auth::id()) <!-- Only show farmer's own uploads -->
                        <tr class="border-t hover:bg-gray-50">
                            <!-- Image -->
                            <td class="px-4 py-2">
                                <img src="{{ asset('storage/' . $upload->file_path) }}"
                                     alt="{{ $upload->original_name }}"
                                     class="h-16 w-16 object-cover rounded">
                            </td>

                            <!-- Uploaded At -->
                            <td class="px-4 py-2">
                                {{ $upload->created_at->format('d M Y, h:i A') }}
                            </td>

                            <!-- Status -->
                            <td class="px-4 py-2 {{ $upload->diagnoses->isEmpty() ? 'text-yellow-600' : 'text-green-600' }}">
                                {{ $upload->diagnoses->isEmpty() ? 'Pending' : 'Diagnosed' }}
                            </td>

                            <!-- Diagnosis Details -->
                            <td class="px-4 py-2">
                                @if($upload->diagnoses->isEmpty())
                                    <span class="text-gray-500">Awaiting expert review</span>
                                @else
                                    @foreach($upload->diagnoses as $diagnosis)
                                        <div class="mb-2">
                                            <p><strong>Disease:</strong> {{ $diagnosis->disease->name }}</p>
                                            <p><strong>Symptoms:</strong> {{ $diagnosis->disease->symptoms }}</p>
                                            <p><strong>Treatment:</strong> {{ $diagnosis->disease->treatment }}</p>
                                            <p><strong>Prevention:</strong> {{ $diagnosis->disease->prevention }}</p>
                                            <p><strong>Diagnosed By:</strong> {{ $diagnosis->expert->name ?? 'Unknown Expert' }}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<section id="stories" class="hidden">
    <div class="bg-white shadow rounded-lg p-6">

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold">Agro Stories</h2>
            <p class="text-gray-600">Share your success with the community</p>
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

        <!-- Story Submission Form -->
        <form action="{{ route('farmer.stories.store') }}" method="POST" enctype="multipart/form-data" class="mb-8">
            @csrf

            <div class="mb-3">
                <label class="block font-semibold mb-1">Story Title</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2"
                       placeholder="e.g. Boosting Tomato Yield" required>
            </div>


            <div class="mb-3">
                <label class="block font-semibold mb-1">Your Name</label>
                <input type="text" name="farmer_name" class="w-full border rounded px-3 py-2"
                    value="{{ Auth::user()->name }}" readonly>
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Location</label>
                <input type="text" name="location" class="w-full border rounded px-3 py-2"
                    value="{{ $locationName }}" readonly>
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Story Description</label>
                <textarea name="description" rows="5" class="w-full border rounded px-3 py-2"
                          placeholder="Write your success story here..." required></textarea>
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label class="block font-semibold mb-1">Upload Image (optional)</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-center mt-4">
                <button type="submit" class="bg-green-600 text-white font-semibold px-6 py-2 rounded-md">
                    Submit Story
                </button>
            </div>
        </form>

        <!-- Submitted Stories List -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Your Submitted Stories</h3>

            @forelse($stories as $story)
                <div class="border rounded p-4 mb-3">
                    <h4 class="font-bold text-green-700">{{ $story->title }}</h4>
                    <p class="text-gray-600">{{ $story->description }}</p>
                    <p class="text-sm text-gray-500 mt-2">
                        Submitted by: {{ $story->user->name ?? $story->farmer_name }} ({{ $story->location }})
                    </p>

                    <!-- Image or Placeholder -->
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

                    <!-- Like Button -->
                    {{-- <form method="POST" action="{{ route('stories.like', $story->id) }}" class="mt-3">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 flex items-center space-x-1">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Like ({{ $story->likes_count }})</span>
                        </button>
                    </form> --}}

                    <!-- Status Badge -->
                    {{-- <span class="inline-block mt-3 px-3 py-1 text-sm rounded
                        @if($story->status === 'pending') bg-yellow-200 text-yellow-800
                        @elseif($story->status === 'approved') bg-green-200 text-green-800
                        @else bg-red-200 text-red-800 @endif">
                        {{ ucfirst($story->status) }}
                    </span> --}}

                    <!-- Status Badge -->
                    <span id="story-status-{{ $story->id }}"
                        class="inline-block mt-3 px-3 py-1 text-sm rounded
                                @if($story->status === 'pending') bg-yellow-200 text-yellow-800
                                @elseif($story->status === 'approved') bg-green-200 text-green-800
                                @else bg-red-200 text-red-800 @endif">
                        {{ ucfirst($story->status) }}
                    </span>
                </div>
            @empty
                <p class="text-gray-500">You haven’t submitted any stories yet.</p>
            @endforelse

            <!-- Pagination -->
            <div class="mt-4">
                {{ $stories->links() }}
            </div>
        </div>
    </div>
</section>

<script>
    async function updateStoryStatuses() {
        try {
            const response = await fetch("{{ route('farmer.stories.statuses') }}");
            const data = await response.json();

            data.stories.forEach(story => {
                const statusEl = document.getElementById(`story-status-${story.id}`);
                if(statusEl && statusEl.textContent.toLowerCase() !== story.status) {
                    statusEl.textContent = story.status.charAt(0).toUpperCase() + story.status.slice(1);

                    // Update classes
                    statusEl.classList.remove('bg-yellow-200','text-yellow-800','bg-green-200','text-green-800','bg-red-200','text-red-800');
                    if(story.status === 'pending') {
                        statusEl.classList.add('bg-yellow-200','text-yellow-800');
                    } else if(story.status === 'approved') {
                        statusEl.classList.add('bg-green-200','text-green-800');
                    } else {
                        statusEl.classList.add('bg-red-200','text-red-800');
                    }
                }
            });
        } catch(err) {
            console.error('Failed to fetch story statuses:', err);
        }
    }

    // Poll every 5 seconds
    setInterval(updateStoryStatuses, 5000);
</script>

<section id="ask-queries" class="mt-10 p-6 bg-gray-50 rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2 mb-4">
        Ask Queries
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


    <!-- Query Form -->
    <form action="{{ route('queries.store') }}" method="POST" class="mb-4">
        @csrf

        <!-- Select Crop -->
        <label class="block mb-2 font-medium">Select Crop (optional)</label>
        <select name="crop_id" class="w-full border rounded p-2 mb-3">
            <option value="">-- None --</option>
            @foreach($crops as $crop)
                <option value="{{ $crop->id }}">{{ $crop->name }}</option>
            @endforeach
        </select>

        <!-- Select Disease -->
        <label class="block mb-2 font-medium">Select Disease (optional)</label>
        <select name="disease_id" class="w-full border rounded p-2 mb-3">
            <option value="">-- None --</option>
            @foreach($diseases as $disease)
                <option value="{{ $disease->id }}">{{ $disease->name }}</option>
            @endforeach
        </select>

        <!-- Question -->
        <textarea name="question" rows="3"
                  class="w-full border rounded p-2 mb-3"
                  placeholder="Ask your question..."></textarea>

        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Submit Query
        </button>
    </form>

    <!-- List of Queries -->
    @if($queries->count())
        <div class="mt-6">
            <h3 class="text-lg font-semibold">Your Queries</h3>
            @foreach($queries as $query)
                <div class="border-b py-3">
                    <p class="font-medium">{{ $query->question }}</p>
                    <small class="text-gray-500">
                        Asked on {{ $query->created_at->format('d M Y') }}
                    </small>
                </div>
            @endforeach
        </div>
    @endif
</section>

<section id="my-queries" class="mt-10 p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-black border-b pb-2 mb-4">
        My Queries
    </h2>

    <div id="farmer-queries-container">
        @include('farmer.partials.queries', ['queries' => $queries])
    </div>
</section>

<script>
function loadFarmerQueries() {
    fetch("{{ route('farmer.queries') }}")
        .then(response => response.text())
        .then(html => {
            document.getElementById('farmer-queries-container').innerHTML = html;
        });
}

// Poll every 5 seconds
setInterval(loadFarmerQueries, 5000);
</script>

</main>
</div>

<!-- JS -->
<script src="{{asset('js/admin-dash.js')}}"></script>
</body>
</html>
