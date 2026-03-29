<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agriculture Information & Support Platform</title>
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<!-- NAVBAR -->
<nav>
  <div class="logo">
    <img src="{{ asset('images/gardener.png') }}">
    <span>Krishi Farm Center</span>
  </div>

    <!-- Main links -->
    <ul class="nav-links">
        <li><a href="#hero">Home</a></li>
        <li><a href="#features">Features</a></li>
        <li><a href="#why">Why Us</a></li>
        <li><a href="#gallery">Gallery</a></li>
    </ul>

    <!-- Auth links -->
    <ul class="nav-auth">
        <li><a href="{{route('login')}}">Login</a></li>
        <li><a href="{{route('register')}}">Register</a></li>
    </ul>

    <!-- Hamburger / Cross for mobile -->
    <div class="hamburger" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>
</nav>


<!-- HERO -->
<section class="hero" id="hero">
    <div>
        <h1>Agriculture Information & Support Platform</h1>
        <p>Your one-stop solution for crop info, diagnosis, and expert help.</p>

        <!-- SEARCH & FILTER INSIDE HERO -->
        <!-- <div class="hero-search">
            <input type="text" placeholder="Search for crops, diseases, or experts..." id="search-input">
            <select id="filter-type">
                <option value="">All Types</option>
                <option value="crop">Crop</option>
                <option value="disease">Disease</option>
                <option value="expert">Expert</option>
            </select>
            <select id="filter-region">
                <option value="">All Regions</option>
                <option value="everest">Everest Region</option>
                <option value="terai">Terai</option>
                <option value="hills">Hills</option>
            </select>
            <button onclick="performSearch()">Search</button>
        </div> -->
    </div>
</section>



<!-- FEATURES -->
<section class="section" id="features">
    <h2>Our Features</h2>
    <div class="features">
        <div class="feature-box">
            <h3>🌾 Crop Information</h3>
            <p>Get detailed and reliable crop cultivation guidelines.</p>
        </div>

        <div class="feature-box">
            <h3>🦠 Disease Diagnosis</h3>
            <p>Identify diseases and get treatment suggestions.</p>
        </div>

        <div class="feature-box">
            <h3>👨‍🌾 Expert Support</h3>
            <p>Chat with verified agricultural experts anytime.</p>
        </div>

        <div class="feature-box">
            <h3>🏬 Agro Resources</h3>
            <p>Find agro-stores, fertilizers, and tools nearby.</p>
        </div>
    </div>
</section>

<section class="section" id="why">
    <h2>Why Choose Us?</h2>
    <p>Simple, verified, and farmer-friendly platform built for Nepal.</p>

    <ul class="why-list">
        <li>Get reliable advice from agriculture specialists.</li>
        <li>Access comprehensive crop and disease information.</li>
        <li>Connect with other farmers and share experiences.</li>
        <li>Save time and reduce farming costs with accurate guidance.</li>
    </ul>
</section>


<section id="gallery" class="gallery">
    <h2>Gallery</h2>
    <p>Explore our collection of farming and agricultural images.</p>
<div class="gallery-container">
    <div class="gallery-item">
        <img src="{{ asset('images/greenforce-staffing-bYZn_C-RswQ-unsplash.jpg') }}" alt="Farm">
    </div>
    <div class="gallery-item">
        <img src="{{ asset('images/nathan-cima-ZJ6q407CscY-unsplash.jpg') }}" alt="Crop">
    </div>
    <div class="gallery-item">
        <img src="{{ asset('images/pexels-wolfgang-weiser-467045605-34402625.jpg') }}" alt="Tractor">
    </div>
    <div class="gallery-item">
        <img src="{{ asset('images/pexels-kampus-7658822.jpg') }}" alt="Vegetable">
    </div>
    <div class="gallery-item">
        <img src="{{ asset('images/tim-mossholder-xDwEa2kaeJA-unsplash.jpg') }}" alt="Harvest">
    </div>
    <div class="gallery-item">
        <img src="{{ asset('images/pexels-aryalprakash-10806264.jpg') }}" alt="Agriculture">
    </div>
    <div class="gallery-item">
        <img src="{{ asset('images/pexels-equalstock-20527345.jpg') }}" alt="Agriculture">
    </div>
    <div class="gallery-item">
        <img src="{{ asset('images/pexels-quang-nguyen-vinh-222549-3232602.jpg') }}" alt="Agriculture">
    </div>
    <div class="gallery-item">
        <img src="{{ asset('images/pexels-minan1398-1093837.jpg') }}" alt="Agriculture">
    </div>
    <div class="gallery-item">
        <img src="{{ asset('images/pexels-cpkhanal-26845309.jpg') }}" alt="Agriculture">
    </div>
</div>
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
                <li><a href="#features">Features</a></li>
                <li><a href="#why">Why Choose Us</a></li>
                <li><a href="#">Contact</a></li>
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
