<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agriculture Information & Support Platform</title>
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="logo">
        <img src="{{ asset('images/gardener.png') }}">
        <span>Krishi Farm Center</span>
  </div>

    <ul class="nav-links">
        <li><a href="#hero">Home</a></li>
        <li><a href="#crops">Crops</a></li>
        <li><a href="#diseases">Diseases</a></li>
        <li><a href="#agro-centers">Agro Centers</a></li>
        <li><a href="{{ route('resources.index') }}">Knowledge Hub</a></li>
    </ul>

   <div class="dashboard">
        <i class="fas fa-user-circle" onclick="toggleProfileMenu(event)"></i>
        <ul class="dashboard-menu">
            <li><a href="/farmer/dashboard">My Dashboard</a></li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
            </form>
        </li>
        </ul>
    </div>

    <!--  Cross for mobile -->
    <div class="hamburger" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>
</nav>

<section class="hero" id="hero">
    <div>
        <h1>Agriculture Information & Support Platform</h1>
        <p>Your one-stop solution for crop info, diagnosis, and expert help.</p>

        <!-- SEARCH & FILTER -->
        <form action="{{ route('search') }}" method="GET" class="hero-search">
            <input type="text" name="q" placeholder="Search for crops or diseases..." >

            <select name="type">
                <option value="">All Types</option>
                <option value="crop">Crop</option>
                <option value="disease">Disease</option>
            </select>

            <select name="region">
                <option value="">All Regions</option>
                <option value="everest">Everest Region</option>
                <option value="terai">Terai</option>
                <option value="hills">Hills</option>
            </select>

            <button type="submit">Search</button>
        </form>
    </div>
</section>

<section class="weather-section" id="weather">
  <h2 class="section-title">Today’s Farm Weather</h2>
  <span class="section-subtitle">Weather updates to help farmers plan better</span>

  <div class="weather-card-container">
    <!-- Location -->
    <div class="weather-card">
      <div class="weather-info">
        <h3><i class="fas fa-map-marker-alt"></i> Location</h3>
        <p>{{ $locationName }}</p>
      </div>
    </div>

    <!-- Current Temperature & Condition -->
    <div class="weather-card">
      <div class="weather-info">
        <h3><i class="fas fa-thermometer-half"></i> Temperature</h3>
        <p>{{ $currentWeather['temperature'] }} °C</p>
        <span>{{ $currentWeather['condition'] }}</span>
      </div>
    </div>

    <!-- Rain & Humidity -->
    <div class="weather-card">
      <div class="weather-info">
        <h3><i class="fas fa-tint"></i> Rain / Humidity</h3>
        <p>{{ $currentWeather['rain'] }} mm</p>
        <span>{{ $currentWeather['humidity'] }}% humidity</span>
      </div>
    </div>

    <!-- Advisory -->
    <div class="weather-card">
      <div class="weather-info">
        <h3><i class="fas fa-leaf"></i> Advisory</h3>
        <p>{{ $advisory }}</p>
        <span><i class="fas fa-wind"></i> Wind: {{ $currentWeather['wind'] }} m/s</span>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            // Send lat/lon to Laravel via AJAX instead of redirect
            fetch(`/set-location?lat=${lat}&lon=${lon}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Location saved:", data);
                    document.getElementById("location-text").innerText = data.locationName;
                });
        });
    }
});
</script>

<section class="popular-crops" id="crops">
    <h2 class="section-title">Popular Crops</h2>
    <span class="section-subtitle">Learn about high-yield crops and best cultivation practices.</span>

    <div class="crop-card-container">
        @forelse($crops as $crop)
            <div class="crop-card">
                <!-- Crop Image -->
                <img src="{{ asset('storage/' . $crop->image) }}" alt="{{ $crop->name }}">

                <!-- Crop Info -->
                <div class="crop-info">
                    <h3>{{ $crop->name }}</h3>
                    <p>{{ $crop->description }}</p>
                    <span>Best season: {{ ucfirst($crop->best_season) }}</span>
                    <span>Suitable region: {{ ucfirst($crop->region) }}</span>

                    <div class="btn-wrapper">
                        <a href="{{ route('crops.show', $crop->id) }}" class="btn">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-600">No crops available yet.</p>
        @endforelse
    </div>
</section>

<section class="common-diseases-section" id="diseases">
    <h2 class="section-title">Common Plant Diseases</h2>
    <span class="section-subtitle">Identify and manage plant diseases effectively.</span>

    <div class="diagnosis-link-wrapper">
        <a href="{{ route('disease.identification') }}" class="diagnosis-link">
            <i class="fas fa-camera mr-2"></i>
            Not sure? Upload plant image for diagnosis
        </a>
    </div>

    <div class="disease-card-container">
        @forelse($diseases as $disease)
            <div class="disease-card">
                <!-- Disease Image -->
                @if($disease->image)
                    <img src="{{ asset('storage/' . $disease->image) }}" alt="{{ $disease->name }}">
                @else
                    <img src="{{ asset('images/default-disease.jpg') }}" alt="No image available">
                @endif

                <!-- Disease Info -->
                <div class="disease-info">
                    <h3>{{ $disease->name }}</h3>

                    <!-- Affected Crop -->
                @if($disease->crop)
                    <p><strong>Affected Crop:</strong> {{ $disease->crop->name }}</p>
                @endif

                <!-- Symptoms -->
                {{-- <p><strong>Symptoms:</strong> {{ Str::limit($disease->symptoms, 60) }}</p> --}}

                    <div class="btn-wrapper">
                        <a href="{{ route('diseases.show', $disease->id) }}" class="btn">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-600">No diseases available yet.</p>
        @endforelse
    </div>
</section>

<section class="agro-centers-section homepage-map" id="agro-centers">
    <h2 class="section-title">Nearby Agro Centers</h2>
    <span class="section-subtitle">Quick access to agro-shops and input suppliers.</span>

    <div class="map-wrapper">
        <div id="map"></div>
    </div>

    <div id="loadingMessage" style="text-align:center; margin-top:10px; color:#4d6b4f;">
        Searching for nearby agro shops...
    </div>

    <div class="location-btn-wrapper">
        <button id="findLocationBtn" class="location-btn">
            <i class="fas fa-location-crosshairs mr-2"></i> Find My Location
        </button>
    </div>
</section>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
  // Initialize map
  var map = L.map('map').setView([27.0, 85.0], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Known shops (manual list for Itahari)
  var knownShops = [
    {name: "Pashupati Nursery", lat: 26.666, lon: 87.283, type: "Nursery"},
    {name: "New Makalu Agrovet", lat: 26.667, lon: 87.275, type: "Fertilizer"},
    {name: "Goyal Agro Pvt. Ltd.", lat: 26.668, lon: 87.280, type: "Seeds"},
    {name: "Chandani Agro Feeds", lat: 26.669, lon: 87.278, type: "Feed"}
  ];

  var userLat = null, userLng = null;

  // Haversine formula to calculate distance (km)
  function getDistance(lat1, lon1, lat2, lon2) {
      function toRad(x) { return x * Math.PI / 180; }
      var R = 6371; // Earth radius in km
      var dLat = toRad(lat2 - lat1);
      var dLon = toRad(lon2 - lon1);
      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
              Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
              Math.sin(dLon/2) * Math.sin(dLon/2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
      return (R * c).toFixed(2); // distance in km
  }

  // Load agro shops from OSM + manual list
  function loadAgroShops(lat, lng) {
      document.getElementById("loadingMessage").innerText = "Searching for nearby agro shops...";

      var query = `
          [out:json];
          (
              node["shop"~"agrarian|agricultural_supplies|farm|garden_centre|plant|seeds|fertilizer|pesticides|nursery"](around:15000, ${lat}, ${lng});
          );
          out;
      `;

      fetch("https://overpass-api.de/api/interpreter", {
          method: "POST",
          body: query
      })
      .then(res => res.json())
      .then(data => {
          if (data.elements.length === 0) {
              document.getElementById("loadingMessage").innerText = "No agro shops found nearby.";
          } else {
              document.getElementById("loadingMessage").innerText = "";
          }

          // OSM results
          data.elements.forEach(function(el) {
              var dist = userLat ? getDistance(userLat, userLng, el.lat, el.lon) : "N/A";
              L.marker([el.lat, el.lon]).addTo(map)
                .bindPopup((el.tags.name || "Agro Shop") + "<br>Type: " + (el.tags.shop || "Unknown") + "<br>Distance: " + dist + " km");
          });

          // Manual known shops
          knownShops.forEach(function(shop) {
              var dist = userLat ? getDistance(userLat, userLng, shop.lat, shop.lon) : "N/A";
              L.marker([shop.lat, shop.lon]).addTo(map)
                .bindPopup(shop.name + "<br>Type: " + shop.type + "<br>Distance: " + dist + " km");
          });
      })
      .catch(err => {
          document.getElementById("loadingMessage").innerText = "Error loading shops.";
          console.error(err);
      });
  }

  // Locate user
  function locateUser() {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
              userLat = position.coords.latitude;
              userLng = position.coords.longitude;
              map.setView([userLat, userLng], 14);

            //   L.marker([userLat, userLng]).addTo(map).bindPopup("You are here").openPopup();

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${userLat}&lon=${userLng}`)
                .then(res => res.json())
                .then(data => {
                    const address = data.address || {};

                    // Build "City, District" style string
                    const city = address.city || address.town || address.village || address.suburb;
                    const district = address.county || address.state_district;

                    const locationName = [city, district].filter(Boolean).join(", ");

                    L.marker([userLat, userLng]).addTo(map)
                        .bindPopup(locationName || "My Location")
                        .openPopup();
                });

              loadAgroShops(userLat, userLng);
          }, function() {
              document.getElementById("loadingMessage").innerText = "Location access denied.";
              userLat = 27.0; userLng = 85.0; // fallback
              loadAgroShops(userLat, userLng);
          });
      }
  }

  // Auto-load
  locateUser();
  document.getElementById("findLocationBtn").addEventListener("click", locateUser);
</script>
{{--
<section class="success-stories-section" id="success-stories">
    <h2 class="section-title">Agro Success Stories</h2>
    <span class="section-subtitle">Real farmers, real results</span>

    <div class="stories-card-container">
        @forelse($stories as $story)
            <div class="story-card">
                <!-- Image or Placeholder -->
                <div class="story-image mb-2">
                    @if($story->image_url)
                        <img src="{{ asset('storage/'.$story->image_url) }}"
                             alt="{{ $story->title }}"
                             class="story-img">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}"
                             alt="No image available"
                             class="story-img bg-gray-200">
                    @endif
                </div>

                <div class="story-info">
                    <h3>{{ $story->title }}</h3>
                    <p><strong>Farmer:</strong> {{ $story->farmer_name }} ({{ $story->location }})</p>
                    <p>{{ Str::limit($story->description, 120) }}</p>

                <!-- Like Button -->
                    <form method="POST" action="{{ route('stories.like', $story->id) }}" class="mt-2">
                        @csrf
                        <button type="submit" class="like-btn flex items-center space-x-1">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Like ({{ $story->likes_count ?? 0 }})</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-600 italic">No success stories available yet. Be the first to share yours!</p>
        @endforelse
    </div>
</section> --}}

<section class="success-stories-section" id="success-stories">
    <h2 class="section-title">Agro Success Stories</h2>
    <span class="section-subtitle">Real farmers, real results</span>

    <!-- Success message area -->
    <div id="like-message" class="text-green-600 font-semibold text-right mb-4"></div>

    <div class="stories-card-container">
        @forelse($stories as $story)
            <div class="story-card">
                <div class="story-image mb-2">
                    @if($story->image_url)
                        <img src="{{ asset('storage/'.$story->image_url) }}"
                             alt="{{ $story->title }}"
                             class="story-img">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}"
                             alt="No image available"
                             class="story-img bg-gray-200">
                    @endif
                </div>

                <div class="story-info">
                    <h3>{{ $story->title }}</h3>
                    <p><strong>Farmer:</strong> {{ $story->farmer_name }} ({{ $story->location }})</p>
                    <p>{{ Str::limit($story->description, 120) }}</p>

                    <!-- Like Button -->
                   @php
                    $userLiked = Auth::check() && $story->likes()->where('user_id', Auth::id())->exists();
                @endphp

                <form method="POST"
                    action="{{ $userLiked ? route('stories.unlike', $story->id) : route('stories.like', $story->id) }}"
                    data-like="{{ route('stories.like', $story->id) }}"
                    data-unlike="{{ route('stories.unlike', $story->id) }}"
                    class="like-form mt-2">
                    @csrf
                    <button type="submit" class="like-btn flex items-center space-x-1">
                        @if($userLiked)
                            <i class="fas fa-thumbs-down"></i>
                            <span class="like-count">Unlike ({{ $story->likes()->count() }})</span>
                        @else
                            <i class="fas fa-thumbs-up"></i>
                            <span class="like-count">Like ({{ $story->likes()->count() }})</span>
                        @endif
                    </button>
                </form>

                <p class="text-sm text-gray-600 mt-1 flex items-center">
                    <i class="fas fa-check text-green-600 mr-1"></i>
                    @if($story->likedByUsers->count() > 0)
                        Liked by
                        {{ $story->likedByUsers->take(3)->pluck('name')->join(', ') }}
                        @if($story->likedByUsers->count() > 3)
                            and {{ $story->likedByUsers->count() - 3 }} others
                        @endif
                    @else
                        No likes yet
                    @endif
                </p>

                </div>
            </div>
        @empty
            <p class="text-center text-gray-600 italic">No success stories available yet. Be the first to share yours!</p>
        @endforelse
    </div>
</section>

<!-- Inline CSS -->
<style>
   .story-info p.text-gray-600 {
    font-size: 0.85rem;
    font-style: italic;
    margin-top: 10px;
    color: #4b5563;
}
.story-info p.text-gray-600 i {
    font-size: 0.9rem;
    color: #16a34a;
}
    .success-stories-section {

        padding: 24px;
        margin-top: 0;
    }

    .success-stories-section h2 {
        font-size: 1.8rem;
        color: #166534;
        margin-bottom: 8px;
    }

    .success-stories-section .section-subtitle {
        color: #555;
        margin-bottom: 20px;
    }

    .stories-card-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .story-card {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #fafafa;
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: box-shadow 0.2s ease;
    }

    .story-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .story-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 6px;
    }
    .like-btn {
        background-color: #dc2626;
        color: #fff;
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .like-btn:hover {
        background-color: #b91c1c;
    }
#like-message {
    background-color: #d1fae5;
    color: #065f46;
    border: 1px solid #10b981;
    padding: 10px 16px;
    border-radius: 6px;
    font-weight: 500;
    max-width: 300px;
    margin-left: auto;
    margin-bottom: 12px;
    opacity: 0;
    transform: translateX(100%);
    transition: transform 0.5s ease, opacity 0.5s ease;
}

#like-message.show {
    opacity: 1;
    transform: translateX(0); /* slide in */
}

#like-message.error {
    background-color: #fee2e2;
    color: #991b1b;
    border: 1px solid #f87171;
}
</style>
{{--
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.like-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let url = this.action;
            let token = this.querySelector('input[name="_token"]').value;
            let button = this.querySelector('button');
            let likeUrl = this.dataset.like;
            let unlikeUrl = this.dataset.unlike;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                let span = this.querySelector('.like-count');
                if (span) span.textContent = `Like (${data.likes_count})`;

                let msg = document.getElementById('like-message');
                msg.textContent = data.message;
                msg.classList.remove('error');
                msg.classList.add('show');

                if (data.status === 'error') {
                    msg.classList.add('error');
                }

                setTimeout(() => { msg.classList.remove('show'); }, 3000);

                if (data.status === 'success') {
                    // Toggle between Like and Unlike
                    if (url === likeUrl) {
                        this.action = unlikeUrl;
                        button.innerHTML = '<i class="fas fa-thumbs-down"></i> <span class="like-count">Unlike ('+data.likes_count+')</span>';
                    } else {
                        this.action = likeUrl;
                        button.innerHTML = '<i class="fas fa-thumbs-up"></i> <span class="like-count">Like ('+data.likes_count+')</span>';
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script> --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.like-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let url = this.action;
            let token = this.querySelector('input[name="_token"]').value;
            let button = this.querySelector('button');
            let likeUrl = this.dataset.like;
            let unlikeUrl = this.dataset.unlike;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {

                let span = this.querySelector('.like-count');
                if (span) span.textContent = (url === likeUrl)
                    ? `Unlike (${data.likes_count})`
                    : `Like (${data.likes_count})`;

                let msg = document.getElementById('like-message');
                msg.textContent = data.message;
                msg.classList.remove('error');
                msg.classList.add('show');

                if (data.status === 'error') {
                    msg.classList.add('error');
                }

                setTimeout(() => { msg.classList.remove('show'); }, 3000);

                if (data.status === 'success') {
                    // Toggle button
                    if (url === likeUrl) {
                        this.action = unlikeUrl;
                        button.innerHTML = '<i class="fas fa-thumbs-down"></i> <span class="like-count">Unlike ('+data.likes_count+')</span>';
                    } else {
                        this.action = likeUrl;
                        button.innerHTML = '<i class="fas fa-thumbs-up"></i> <span class="like-count">Like ('+data.likes_count+')</span>';
                    }

                    let likedBy = this.closest('.story-info').querySelector('p.text-gray-600');
                    if (likedBy && data.liked_by) {
                        if (data.liked_by.length > 0) {
                            let names = data.liked_by.slice(0,3).join(', ');
                            let extra = data.liked_by.length > 3 ? ` and ${data.liked_by.length - 3} others` : '';
                            likedBy.innerHTML = `<i class="fas fa-check text-green-600 mr-1"></i> Liked by ${names}${extra}`;
                        } else {
                            likedBy.innerHTML = `<i class="fas fa-check text-green-600 mr-1"></i> No likes yet`;
                        }
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>

<section id="crop-recommendation-section" class="crop-recommendation-section">
    <h2 class="section-title">Crop Recommendation</h2>
    <span class="section-subtitle">Find the best crops for your soil and season</span>

    <form action="{{ route('crop.recommend') }}" method="POST" class="crop-form-inline">
    @csrf

    <select name="region" required>
        <option value="">Select Region</option>
        @foreach($regions as $region)
            <option value="{{ $region }}">{{ $region }}</option>
        @endforeach
    </select>

    <select name="soil_type" required>
        <option value="">Select Soil Type</option>
        @foreach($soilTypes as $soil)
            <option value="{{ $soil }}">{{ $soil }}</option>
        @endforeach
    </select>

    <select name="season" required>
        <option value="">Select Season</option>
        @foreach($seasons as $season)
            <option value="{{ $season }}">{{ $season }}</option>
        @endforeach
    </select>

    <button type="submit" class="btn-green">Get Recommendation</button>
</form>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-container">

        <div class="footer-box">
            <h3>Krishi Farm Center</h3>
            <p>Your trusted Agriculture Information & Support Platform.</p>
        </div>

        <div class="footer-box">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="#hero">Home</a></li>
                <li><a href="#crops">Crops</a></li>
                <li><a href="#diseases">Diseases</a></li>
                <li><a href="#agro-centers">Agro Centers</a></li>
                <li><a href="{{ route('resources.index') }}">Knowledge Hub</a></li>
            </ul>
        </div>

        <div class="footer-box">
            <h4>Follow Us</h4>
            <ul>
                <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a></li>
            </ul>
        </div>

        <div class="footer-box">
            <h4>Contact</h4>
            <p><i class="fas fa-map-marker-alt"></i> Nepal</p>
            <p><i class="fas fa-phone"></i> +977 9800000000</p>
            <p><i class="fas fa-envelope"></i> krishi@gmail.com</p>
        </div>
    </div>
</footer>

<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
