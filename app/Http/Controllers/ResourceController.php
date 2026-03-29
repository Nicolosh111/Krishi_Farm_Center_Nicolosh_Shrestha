<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\Crop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    // public function index(Request $request)
    // {
    //     $query = Resource::query()->with('crop');

    //     // Optional filters
    //     if ($request->filled('type')) {
    //         $query->where('type', $request->type); // pdf, video, link
    //     }

    //     // Knowledge Hub: show all resources (general + crop-specific if needed)
    //     $resources = $query->latest()->paginate(12);

    //     return view('resources.index', compact('resources'));
    // }

    public function index(Request $request)
{
    $query = Resource::query()->with('crop');

    // Optional filters
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    if ($request->filled('crop_id')) {
        $query->where('crop_id', $request->crop_id);
    }

    $resources = $query->latest()->paginate(12);

    // Fetch crops for the filter dropdown
    $crops = Crop::all();

    return view('resources.index', compact('resources', 'crops'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'type'    => 'required|string',
            'file'    => 'nullable|file',
            'link'    => 'nullable|url',
        ]);

        $resource = new Resource($validated);
        $resource->user_id = Auth::id();

        // Knowledge Hub: force crop_id to null
        $resource->crop_id = null;

        // Handle file upload
        if ($request->hasFile('file')) {
            $resource->file = $request->file('file')->store('resources', 'public');
        }

        // If type is link, clear file column
        if ($request->type === 'link') {
            $resource->file = null;
        }

        $resource->save();

        return redirect()->route('expert.dashboard', ['section' => 'knowledge-hub'])
               ->with('success', 'Resource uploaded successfully');
    }

    public function update(Request $request, $id)
    {
        $resource = Resource::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'type'    => 'required|string',
            'file'    => 'nullable|file',
            'link'    => 'nullable|url',
        ]);

        $resource->fill($validated);

        // Knowledge Hub: force crop_id to null
        $resource->crop_id = null;

        // Handle file upload
        if ($request->hasFile('file')) {
            if ($resource->file) {
                Storage::disk('public')->delete($resource->file);
            }
            $resource->file = $request->file('file')->store('resources', 'public');
        }

        // If type is link, clear file column
        if ($request->type === 'link') {
            $resource->file = null;
        }

        $resource->save();

        return redirect()->route('expert.dashboard', ['section' => 'knowledge-hub'])
               ->with('success', 'Resource updated successfully');
    }

    public function destroy($id)
    {
        $resource = Resource::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Only delete file if it exists and resource is not a link
        if ($resource->type !== 'link' && $resource->file) {
            Storage::disk('public')->delete($resource->file);
        }

        $resource->delete();

        return redirect()->route('expert.dashboard', ['section' => 'knowledge-hub'])
               ->with('success', 'Resource deleted successfully');
    }
}
