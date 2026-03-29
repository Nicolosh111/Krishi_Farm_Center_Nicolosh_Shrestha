<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crop;
use App\Models\User;
use App\Models\Disease;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Show only crops created by logged-in expert
        $crops = Crop::where('user_id', Auth::id())->latest()->get();

        $users = User::whereIn('role', ['farmer', 'expert'])->get();
        $diseases = Disease::with('crop')->latest()->get();

        return view('expert.dashboard', compact('users', 'crops', 'diseases'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('expert.crops.create');
    }

    /**
     * Store new crop
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'region' => 'required|string',
            'best_season' => 'required|string',
            'status' => 'required|string',
            'soil_type' => 'nullable|string|max:255',
            'cultivation_practices' => 'nullable|string',
            'yield_potential' => 'nullable|numeric',
            'resources.*' => 'nullable|file|max:51200',
            'resource_links.*' => 'nullable|url',
        ]);

        // Crop image
        $imagePath = $request->file('image')->store('crops', 'public');

        $crop = Crop::create([
            'user_id' => Auth::id(),
            'image' => $imagePath,
            'name' => $request->name,
            'description' => $request->description,
            'region' => $request->region,
            'best_season' => $request->best_season,
            'status' => $request->status,
            'soil_type' => $request->soil_type,
            'cultivation_practices' => $request->cultivation_practices,
            'yield_potential' => $request->yield_potential,
        ]);

        /* ---------------- RESOURCE FILES ---------------- */
        // if ($request->hasFile('resources')) {
        //     foreach ($request->file('resources') as $file) {
        //         if (!$file) continue;

        //         $path = $file->store('resources', 'public');

        //         $type = match (true) {
        //             str_contains($file->getClientMimeType(), 'video') => 'video',
        //             str_contains($file->getClientMimeType(), 'pdf')   => 'pdf',
        //             str_contains($file->getClientMimeType(), 'image') => 'image',
        //             default => 'file',
        //         };

        //         Resource::create([
        //             'crop_id' => $crop->id,
        //             'title'   => $file->getClientOriginalName(),
        //             'file'    => $path,
        //             'type'    => $type,
        //             'user_id' => Auth::id(),
        //         ]);
        //     }
        // }

        // /* ---------------- RESOURCE LINKS ---------------- */
        // if ($request->filled('resource_links')) {
        //     foreach ($request->resource_links as $link) {
        //         if (!$link) continue;

        //         Resource::create([
        //             'crop_id' => $crop->id,
        //             'title'   => $link,
        //             'link'    => $link,
        //             'type'    => 'link',
        //             'user_id' => Auth::id(),
        //         ]);
        //     }
        // }

        // Resource Files
        if ($request->hasFile('resources')) {
            foreach ($request->file('resources') as $index => $file) {
                if (!$file) continue;

                $path = $file->store('resources', 'public');

                $type = match (true) {
                    str_contains($file->getClientMimeType(), 'video') => 'video',
                    str_contains($file->getClientMimeType(), 'pdf')   => 'pdf',
                    str_contains($file->getClientMimeType(), 'image') => 'image',
                    default => 'file',
                };

                Resource::create([
                    'crop_id' => $crop->id,
                    'title'   => $request->resource_file_titles[$index] ?? $file->getClientOriginalName(),
                    'file'    => $path,
                    'type'    => $type,
                    'user_id' => Auth::id(),
                ]);
            }
        }

        // Resource Links
        if ($request->filled('resource_links')) {
            foreach ($request->resource_links as $index => $link) {
                if (!$link) continue;

                Resource::create([
                    'crop_id' => $crop->id,
                    'title'   => $request->resource_link_titles[$index] ?? $link,
                    'link'    => $link,
                    'type'    => 'link',
                    'user_id' => Auth::id(),
                ]);
            }
        }

        return redirect()->route('expert.dashboard', ['section' => 'crops'])
            ->with('success', 'Crop created successfully');
    }

    /**
     * Show crop (farmer + expert)
     */
    public function show(string $id)
    {
        $crop = Crop::with('diseases', 'resources')->findOrFail($id);
        return view('crops.show', compact('crop'));
    }

    /**
     * Edit crop
     */
    public function edit(string $id)
    {
        $crop = Crop::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('resources')
            ->firstOrFail();

        return view('crops.edit', compact('crop'));
    }

    /**
     * Update crop
     */
    public function update(Request $request, string $id)
    {
        $crop = Crop::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'region' => 'required|string',
            'best_season' => 'required|string',
            'status' => 'required|string',
            'soil_type' => 'nullable|string|max:255',
            'cultivation_practices' => 'nullable|string',
            'yield_potential' => 'nullable|numeric',
            'resources.*' => 'nullable|file|max:51200',
            'resource_links.*' => 'nullable|url',
        ]);

        // Update image
        if ($request->hasFile('image')) {
            if ($crop->image) {
                Storage::disk('public')->delete($crop->image);
            }
            $crop->image = $request->file('image')->store('crops', 'public');
        }

        /* -------- ADD NEW RESOURCE FILES -------- */
        if ($request->hasFile('resources')) {
            foreach ($request->file('resources') as $file) {
                if (!$file) continue;

                $path = $file->store('resources', 'public');

                $type = match (true) {
                    str_contains($file->getClientMimeType(), 'video') => 'video',
                    str_contains($file->getClientMimeType(), 'pdf')   => 'pdf',
                    str_contains($file->getClientMimeType(), 'image') => 'image',
                    default => 'file',
                };

                Resource::create([
                    'crop_id' => $crop->id,
                    'title'   => $file->getClientOriginalName(),
                    'file'    => $path,
                    'type'    => $type,
                    'user_id' => Auth::id(),
                ]);
            }
        }

        /* -------- ADD NEW RESOURCE LINKS -------- */
        if ($request->filled('resource_links')) {
            foreach ($request->resource_links as $link) {
                if (!$link) continue;

                Resource::create([
                    'crop_id' => $crop->id,
                    'title'   => $link,
                    'link'    => $link,
                    'type'    => 'link',
                    'user_id' => Auth::id(),
                ]);
            }
        }

        $crop->update($request->only([
            'name',
            'description',
            'region',
            'best_season',
            'status',
            'soil_type',
            'cultivation_practices',
            'yield_potential'
        ]));

        return redirect()->route('expert.dashboard', ['section' => 'crops'])
            ->with('success', 'Crop updated successfully');
    }

    /**
     * Delete crop
     */
    public function destroy(string $id)
    {
        $crop = Crop::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('resources')
            ->firstOrFail();

        if ($crop->image) {
            Storage::disk('public')->delete($crop->image);
        }

        foreach ($crop->resources as $resource) {
            if ($resource->type !== 'link' && $resource->file) {
                Storage::disk('public')->delete($resource->file);
            }
            $resource->delete();
        }

        $crop->delete();

        return redirect()->route('expert.dashboard', ['section' => 'crops'])
            ->with('success', 'Crop deleted successfully');
    }

    // Handle form submission and show results
    public function recommend(Request $request)
    {
        $region = $request->input('region');
        $soil   = $request->input('soil_type');
        $season = $request->input('season'); // from form

        // Match against best_season column
        $crops = Crop::where('region', $region)
            ->where('soil_type', $soil)
            ->where('best_season', $season)
            ->get();

        return view('crops.results', compact('crops'));
    }

}
