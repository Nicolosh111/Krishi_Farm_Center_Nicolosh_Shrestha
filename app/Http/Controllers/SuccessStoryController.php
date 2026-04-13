<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuccessStory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SuccessStoryController extends Controller
{
    public function create()
    {
        return view('farmer.stories.create');
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'farmer_name' => 'required|string|max:255',
    //         'location' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $path = $request->file('image')->store('stories', 'public');
    //         $validated['image_url'] = $path; // store relative path
    //     }

    //     $validated['status'] = 'pending';
    //     $validated['user_id'] = Auth::id(); // optional: link to farmer

    //     SuccessStory::create($validated);

    //     return redirect()->route('farmer.dashboard',['section'=>'stories'])
    //         ->with('success', 'Your story has been submitted and is awaiting expert review.');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('stories', 'public');
            $validated['image_url'] = $path;
        }

        // Always enforce name and location from authenticated user / weather API
        $validated['farmer_name'] = Auth::user()->name;
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        // --- Fetch location dynamically from WeatherAPI/LocationIQ ---
        $fallbackCity = Auth::user()?->city ?? 'Itahari';
        $response = Http::get('http://api.weatherapi.com/v1/current.json', [
            'key' => env('WEATHERAPI_KEY'),
            'q'   => $fallbackCity,
            'aqi' => 'no',
        ]);
        $data = $response->json();

        $lat = $data['location']['lat'] ?? 26.6667;
        $lon = $data['location']['lon'] ?? 87.2833;

        $geo = Http::get("https://us1.locationiq.com/v1/reverse.php", [
            'key' => env('LOCATIONIQ_KEY'),
            'lat' => $lat,
            'lon' => $lon,
            'format' => 'json',
        ])->json();

        $address = $geo['address'] ?? [];
        $locationParts = [
            $address['city'] ?? null,
            $address['county'] ?? null,
        ];
        $validated['location'] = implode(', ', array_filter($locationParts));

        SuccessStory::create($validated);

        return redirect()->route('farmer.dashboard',['section'=>'stories'])
            ->with('success', 'Your story has been submitted and is awaiting expert review.');
    }

    public function like($id)
    {
        $story = SuccessStory::findOrFail($id);
        $userId = Auth::id();

        if ($story->likes()->where('user_id', $userId)->exists()) {
            return response()->json([
                'likes_count' => $story->likes()->count(),
                'message' => 'You already liked this story!',
                'status' => 'error',
                'liked_by' => $story->likedByUsers()->pluck('name')->toArray()
            ]);
        }

        $story->likes()->create(['user_id' => $userId]);

        return response()->json([
            'likes_count' => $story->likes()->count(),
            'message' => 'You liked this story!',
            'status' => 'success',
            'liked_by' => $story->likedByUsers()->pluck('name')->toArray()
        ]);
    }

    public function unlike($id)
    {
        $story = SuccessStory::findOrFail($id);
        $userId = Auth::id();

        $like = $story->likes()->where('user_id', $userId)->first();

        if (!$like) {
            return response()->json([
                'likes_count' => $story->likes()->count(),
                'message' => 'You haven’t liked this story yet.',
                'status' => 'error',
                'liked_by' => $story->likedByUsers()->pluck('name')->toArray()
            ]);
        }

        $like->delete();

        return response()->json([
            'likes_count' => $story->likes()->count(),
            'message' => 'You unliked this story!',
            'status' => 'success',
            'liked_by' => $story->likedByUsers()->pluck('name')->toArray()
        ]);
    }

    public function fetchStatuses()
    {
        $stories = SuccessStory::where('user_id', Auth::id())
                    ->select('id', 'status')
                    ->get();

        return response()->json([
            'stories' => $stories
        ]);
    }

}
