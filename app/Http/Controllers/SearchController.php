<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crop;
use App\Models\Disease;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query  = $request->input('q');
        $type   = $request->input('type');   // crop, disease, or all
        $region = $request->input('region'); // specific region or all

        $crops = collect();
        $diseases = collect();
        $diseaseMessage = null;

        // Handle crops
        if (!$type || $type === 'crop' || $type === 'all') {
            $crops = Crop::when($query, fn($q) => $q->where('name', 'like', "%{$query}%"))
                        ->when($region && strtolower($region) !== 'all', fn($q) => $q->where('region', $region))
                        ->get();
        }

        // Handle diseases
        if ($type === 'disease') {
            if ($region && strtolower($region) !== 'all') {
                // Region chosen → skip diseases and show message
                $diseaseMessage = "Diseases are not region-specific, so no results are shown for {$region}.";
            } else {
                $diseases = Disease::when($query, fn($q) => $q->where('name', 'like', "%{$query}%"))
                                ->get();
            }
        }

        return view('search.results', compact('crops', 'diseases', 'query', 'region', 'type', 'diseaseMessage'));
    }
}
