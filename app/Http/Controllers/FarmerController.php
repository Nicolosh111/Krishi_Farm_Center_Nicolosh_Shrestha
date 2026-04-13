<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\PlantImage;
use App\Models\SuccessStory;
use App\Models\User;
use App\Models\Consultation;
use App\Models\Query;
use App\Models\Crop;
use App\Models\Disease;
use App\Models\Scheme;
use App\Models\CropPrice;

class FarmerController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();

         // Schemes (latest subsidies)
        // Schemes (paginated for AJAX)
        // $schemes = Scheme::orderBy('created_at', 'desc')->paginate(5);

        $schemes = Scheme::orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'schemes_page');
        // Crop Prices (latest market rates)
        // $prices = CropPrice::latest()->get();


        // Market Comparison / Crop Trend
        // $crops = CropPrice::select('crop_name')->distinct()->orderBy('crop_name')->pluck('crop_name');
        // $selectedCrop = $request->get('crop_name', $crops->first() ?? null);

        // $trendPrices = [];

        // if ($selectedCrop) {
        //     $trendPrices = CropPrice::where('crop_name', $selectedCrop)
        //         ->orderBy('date')
        //         ->get(['date', 'min_price', 'max_price', 'price']);
        // }

        // $prices = CropPrice::orderBy('date', 'desc')->paginate(10);

        $prices = CropPrice::orderBy('date', 'desc')
    ->paginate(10, ['*'], 'prices_page');

        // if ($request->ajax()) {
        //     return view('farmer.partials.market_prices_table', compact('prices'))->render();
        // }

        // if ($request->has('prices')) {
        //         return view('farmer.partials.market_prices_table', compact('prices'))->render();
        //     }

        if ($request->ajax()) {
        if ($request->has('schemes_page')) {
            return view('farmer.partials.schemes_table', compact('schemes'))->render();
        }
        if ($request->has('prices_page')) {
            return view('farmer.partials.market_prices_table', compact('prices'))->render();
        }
    }

    $allCrops = CropPrice::select('crop_name')->distinct()->pluck('crop_name');

        // Plant images with diagnoses
        $plantImages = PlantImage::with([
                'diagnoses.disease',
                'diagnoses.expert'
            ])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Farmer’s own success stories (paginated)
        $stories = SuccessStory::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Expert list with pagination
        $experts = User::where('role', 'expert')
            ->where('is_approved', 1)
            ->with('expertProfile')
            ->paginate(9); // paginator so {{ $experts->links() }} works

        // $bookedExpertIds = Consultation::where('farmer_id', $user->id)
        //                                ->pluck('expert_id')
        //                                ->toArray();

        $bookedExpertIds = Consultation::where('farmer_id', $user->id)
        ->where('status', 'upcoming')
        ->pluck('expert_id')
        ->toArray();

         $consultations = Consultation::with('expert.expertProfile')
        ->where('farmer_id', $user->id)
        ->orderBy('date', 'asc')
        ->orderBy('time', 'asc')
        ->get();

        // $payments = Consultation::where('farmer_id', Auth::id())
        // ->orderBy('created_at', 'desc')
        // ->get();

        $payments = Consultation::with(['expert.expertProfile', 'refund'])
        ->where('farmer_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

          // Add crops and diseases here
    $crops = Crop::latest()->get();
    $diseases = Disease::latest()->get();

         // Get queries asked by this farmer
    $queries = Query::where('user_id', $user->id)   // use $user->id here
                    ->with(['crop','disease','replies.expert'])
                    ->latest()
                    ->get();

        $totalUploads      = $plantImages->count();
        $totalStories      = $stories->total(); // paginated, so use total()
        $totalExperts      = User::where('role', 'expert')->where('is_approved', 1)->count();
        $totalConsults     = $consultations->count();
        $totalPayments     = $payments->where('payment_status', 'paid')->count();


        // Weather API call (fallback to farmer’s city or Itahari)
        $fallbackCity = $user->city ?? 'Itahari';
        $response = Http::get("https://api.weatherapi.com/v1/forecast.json", [
            'key' => config('services.weatherapi.key'),
            'q'   => $fallbackCity,
            'days'=> 7
        ]);
        $weather = $response->json();

        // Reverse geocode using LocationIQ
        $lat = $weather['location']['lat'] ?? 26.6667;
        $lon = $weather['location']['lon'] ?? 87.2833;

        $apiKey = env('LOCATIONIQ_KEY');
        $url = "https://us1.locationiq.com/v1/reverse.php?key={$apiKey}&lat={$lat}&lon={$lon}&format=json";

        $geo = Http::get($url)->json();
        $address = $geo['address'] ?? [];

        $locationParts = [
            $address['city'] ?? null,
            $address['county'] ?? null,   // Sunsari
        ];
        $locationName = implode(', ', array_filter($locationParts));

        return view('farmer.dashboard', compact(
            'user',
            'plantImages',
            'stories',
            'experts',
            'weather',
            'locationName',
            'bookedExpertIds',
            'consultations',
            'payments',
            'totalUploads',
            'totalStories',
            'totalExperts',
            'totalConsults',
            'totalPayments',
            'queries',
            'crops',
            'diseases',
            'schemes',
            'prices',
            // 'selectedCrop',
            // 'trendPrices',
            'allCrops'

        ));
    }

    public function queries()
    {
        $queries = \App\Models\Query::with(['crop','disease','replies.expert'])
                                    ->where('user_id', Auth::id())
                                    ->latest()
                                    ->get();

        return view('farmer.partials.queries', compact('queries'));
    }


    public function marketComparisonData(Request $request)
    {
        $today = now()->toDateString();

        $todayPrices = CropPrice::where('date', $today)
            ->orderBy('crop_name')
            ->get(['crop_name', 'price']);

        return response()->json($todayPrices);
    }

}
