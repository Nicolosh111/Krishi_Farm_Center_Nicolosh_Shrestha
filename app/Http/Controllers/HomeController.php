<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Crop;
use App\Models\Disease;
use App\Models\SuccessStory;

class HomeController extends Controller
{
    public function index(Request $request)
{
    $crops = Crop::where('status', 'active')->take(4)->get();
    $diseases = Disease::where('status', 'active')->latest()->take(4)->get();

    $regions   = Crop::select('region')->distinct()->pluck('region');
    $soilTypes = Crop::select('soil_type')->distinct()->pluck('soil_type');
    $seasons   = Crop::select('best_season')->distinct()->pluck('best_season');

    // If user is logged in, use their saved city, else fallback to Itahari
    $user = Auth::user();
    $fallbackCity = $user?->city ?? 'Itahari';

    // WeatherAPI call using city name
    $response = Http::get('http://api.weatherapi.com/v1/current.json', [
        'key' => env('WEATHERAPI_KEY'),
        'q'   => $fallbackCity,
        'aqi' => 'no',
    ]);
    $data = $response->json();

    $currentWeather = [
        'temperature' => $data['current']['temp_c'] ?? null,
        'humidity'    => $data['current']['humidity'] ?? null,
        'rain'        => $data['current']['precip_mm'] ?? null,
        'wind'        => round(($data['current']['wind_kph'] ?? 0) / 3.6, 1),
        'condition'   => $data['current']['condition']['text'] ?? null,
        'icon'        => $data['current']['condition']['icon'] ?? null,
    ];

    // --- Reverse geocode using LocationIQ ---
    // WeatherAPI gives us lat/lon in the "location" block
    $lat = $data['location']['lat'] ?? 26.6667;
    $lon = $data['location']['lon'] ?? 87.2833;

    $apiKey = env('LOCATIONIQ_KEY');
    $url = "https://us1.locationiq.com/v1/reverse.php?key={$apiKey}&lat={$lat}&lon={$lon}&format=json";

    $geo = Http::get($url)->json();
    $address = $geo['address'] ?? [];

    // Include both city and county/district
    $locationParts = [
        $address['city'] ?? null,
        $address['county'] ?? null,   // Sunsari
    ];
    $locationName = implode(', ', array_filter($locationParts));

    $advisory = $this->cropAdvisory(
        $currentWeather['temperature'],
        $currentWeather['rain'],
        $currentWeather['humidity']
    );

    $stories = SuccessStory::where('status', 'approved')
        ->latest()
        ->take(6)
        ->get();

    return view('homepage', compact(
        'crops','diseases','locationName','currentWeather','advisory','stories',
    'regions', 'soilTypes', 'seasons'));
}

    private function cropAdvisory($temp, $rain, $humidity)
    {
        if ($rain > 10) return 'Heavy rainfall expected. Avoid pesticide spraying and field work.';
        if ($rain > 3)  return 'Light rain expected. Good for transplanting rice and vegetables.';
        if ($temp > 35) return 'High temperature. Increase irrigation and avoid midday farming.';
        if ($humidity > 80) return 'High humidity. Watch out for fungal diseases.';
        return 'Weather conditions are suitable for most farming activities.';
    }
}
