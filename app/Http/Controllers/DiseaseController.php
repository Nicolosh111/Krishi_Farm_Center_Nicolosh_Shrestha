<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\Crop;
use App\Models\User;
use App\Models\PlantImage;
use App\Models\DiseaseDiagnosis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\SuccessStory;
use App\Models\Resource;
use App\Models\Consultation;
use App\Models\Query;

class DiseaseController extends Controller
{

    public function index()
{
    $users = User::whereIn('role', ['farmer', 'expert'])->get();

    $crops = Crop::where('user_id', Auth::id())->latest()->get();

    $diseases = Disease::where('user_id', Auth::id())
               ->with('crop')
               ->latest()
               ->get();

    $plantImages = PlantImage::with(['user','diagnoses.disease','diagnoses.expert'])
                            ->latest()
                            ->get();

    $stories = SuccessStory::where('status', 'pending')->paginate(10);

    $resources = Resource::where('user_id', Auth::id())->latest()->get();

       $consultations = Consultation::where('expert_id', Auth::id())
        ->with(['farmer','expert.expertProfile','refund'])
        ->orderBy('date','asc')
        ->get();

          $queries = Query::with(['user', 'crop', 'disease', 'replies.expert'])
                        ->orderBy('created_at', 'desc')
                        ->get();


    $totalCrops        = $crops->count();
    $totalDiseases     = $diseases->count();
    $pendingDiagnoses  = $plantImages->filter(function($img) {
                            return $img->diagnoses->where('status', 'pending')->count() > 0;
                        })->count();
    $knowledgeArticles = $resources->count();
    $expertStories     = $stories->total();

    return view('expert.dashboard', compact(
        'users','crops','diseases','plantImages','stories','resources','totalCrops','totalDiseases','pendingDiagnoses','knowledgeArticles','expertStories','consultations','queries'

    ));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'crop_id'    => 'required|exists:crops,id',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'symptoms'   => 'required|string',
            'cause'      => 'nullable|string',
            'prevention' => 'nullable|string',
            'treatment'  => 'nullable|string',
            'severity'   => 'required|in:low,medium,high',
            'status'     => 'required|in:active,inactive',
            'type'       => 'nullable|string|max:255',
            'resources.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,mp4,mov,avi|max:51200',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('diseases', 'public');
        }

        $disease = Disease::create([
        'user_id'    => Auth::id(),
        'name'       => $request->name,
        'crop_id'    => $request->crop_id,
        'image'      => $path,
        'symptoms'   => $request->symptoms,
        'cause'      => $request->cause,
        'prevention' => $request->prevention,
        'treatment'  => $request->treatment,
        'severity'   => $request->severity,
        'status'     => $request->status,
        'type'       => $request->type,
    ]);

//     if ($request->hasFile('treatment_images')) {
//     foreach ($request->file('treatment_images') as $file) {
//         $path = $file->store('treatments', 'public');
//         $disease->treatmentImages()->create([
//             'file' => $path,
//         ]);
//     }
// }

if ($request->hasFile('treatment_images')) {
    foreach ($request->file('treatment_images') as $index => $file) {
        $path = $file->store('treatments', 'public');

        $disease->treatmentImages()->create([
            'file'  => $path,
            'title' => $request->treatment_image_titles[$index] ?? null,
        ]);
    }
}

         // Handle resources
    // if ($request->hasFile('resources')) {
    //     foreach ($request->file('resources') as $file) {
    //         $filePath = $file->store('resources', 'public');

    //         $disease->resources()->create([
    //             'title' => $file->getClientOriginalName(),
    //             'file'  => $filePath,
    //             'type'  => 'file',
    //         ]);
    //     }
    // }


    // Handle resources
        if ($request->hasFile('resources')) {
            foreach ($request->file('resources') as $file) {
                $filePath = $file->store('resources', 'public');

                $disease->resources()->create([
                    'title' => $request->resource_title ?? $file->getClientOriginalName(),
                    'file'  => $filePath,
                    'type'  => $file->getClientMimeType(),
                    'crop_id'    => $disease->crop_id,
                    'disease_id' => $disease->id,
                ]);
            }
        }

        // Handle external link
        if ($request->filled('resource_link')) {
            $disease->resources()->create([
                'title' => $request->resource_title ?? 'External Guide',
                'file'  => $request->resource_link,
                'type'  => 'link',
                'crop_id'    => $disease->crop_id,
                'disease_id' => $disease->id,
            ]);
        }

        return redirect()->route('expert.dashboard', ['section' => 'diseases'])
                         ->with('success', 'Disease created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $disease = Disease::with(['crop','resources'])->findOrFail($id);
        return view('diseases.show', compact('disease'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $disease = Disease::findOrFail($id);
        $disease = Disease::where('id', $id)
    ->where('user_id', Auth::id())
    ->firstOrFail();

        $crops = Crop::all();
        return view('expert.diseases.edit', compact('disease', 'crops'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $disease = Disease::findOrFail($id);

        $disease = Disease::where('id', $id)
    ->where('user_id', Auth::id())
    ->firstOrFail();

        $request->validate([
            'name'       => 'required|string|max:255',
            'crop_id'    => 'required|exists:crops,id',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'symptoms'   => 'required|string',
            'cause'      => 'nullable|string',
            'prevention' => 'nullable|string',
            'treatment'  => 'nullable|string',
            'severity'   => 'required|in:low,medium,high',
            'status'     => 'required|in:active,inactive',
            'type'       => 'nullable|string|max:255',
            'resources.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:20480',
        ]);

        if ($request->hasFile('image')) {
            if ($disease->image) {
                Storage::disk('public')->delete($disease->image);
            }
            $disease->image = $request->file('image')->store('diseases', 'public');
        }

        $disease->update($request->except('image'));


        $disease->update($request->except('image'));

        // Delete selected treatment images
if ($request->filled('delete_treatment_images')) {
    foreach ($request->delete_treatment_images as $imageId) {
        $image = $disease->treatmentImages()->find($imageId);
        if ($image) {
            Storage::disk('public')->delete($image->file); // remove file
            $image->delete(); // remove DB record
        }
    }
}

// Handle new treatment images
// if ($request->hasFile('treatment_images')) {
//     foreach ($request->file('treatment_images') as $file) {
//         $path = $file->store('treatments', 'public');
//         $disease->treatmentImages()->create([
//             'file' => $path,
//         ]);
//     }
// }
if ($request->hasFile('treatment_images')) {
    foreach ($request->file('treatment_images') as $index => $file) {
        $path = $file->store('treatments', 'public');

        $disease->treatmentImages()->create([
            'file'  => $path,
            'title' => $request->treatment_image_titles[$index] ?? null,
        ]);
    }
}

         //Handle new uploaded resources
            if ($request->hasFile('resources')) {
                foreach ($request->file('resources') as $file) {
                    $filePath = $file->store('resources', 'public');

                    $disease->resources()->create([
                        'title'      => $request->resource_title ?? $file->getClientOriginalName(),
                        'file'       => $filePath,
                        'type'       => $file->getClientMimeType(),
                        'crop_id'    => $disease->crop_id,
                        'disease_id' => $disease->id,
                    ]);
                }
            }

            // Handle new external resource link
            if ($request->filled('resource_link')) {
                $disease->resources()->create([
                    'title'      => $request->resource_title ?? 'External Guide',
                    'file'       => $request->resource_link,
                    'type'       => 'link',
                    'crop_id'    => $disease->crop_id,
                    'disease_id' => $disease->id,
                ]);
            }


        return redirect()->route('expert.dashboard', ['section' => 'diseases'])
                         ->with('success', 'Disease updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $disease = Disease::findOrFail($id);

        $disease = Disease::where('id', $id)
    ->where('user_id', Auth::id())
    ->firstOrFail();

        if ($disease->image) {
            Storage::disk('public')->delete($disease->image);
        }
        $disease->delete();

        return redirect()->route('expert.dashboard', ['section' => 'diseases'])
                         ->with('success', 'Disease deleted successfully');

    }

    public function commonDiseases()
    {
    // Only active diseases, latest first
    $diseases = Disease::where('status', 'active')->latest()->get();

    return view('frontend.common-diseases', compact('diseases'));
    }

    // public function identify()
    // {
    //     return view('diseases.disease-identification');
    // }

        public function identify()
    {
        $crops = Crop::all();
        return view('diseases.disease-identification', compact('crops'));
    }

//   public function process(Request $request)
// {
//     $request->validate([
//         'plant_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
//         'crop_id'     => 'required|exists:crops,id',
//         'symptoms'    => 'required|array|min:1',
//     ]);

//     // Save uploaded image
//     $path = $request->file('plant_image')->store('plant_images', 'public');
//     $plantImage = PlantImage::create([
//         'user_id'       => Auth::id(),
//         'crop_id'       => $request->crop_id,
//         'file_path'     => $path,
//         'original_name' => $request->file('plant_image')->getClientOriginalName(),
//     ]);

//     // Rule-based prediction
//     $possibleDiseases = Disease::where('crop_id', $request->crop_id)
//         ->where(function ($q) use ($request) {
//             foreach ($request->symptoms as $symptom) {
//                 $q->orWhere('symptoms', 'LIKE', "%$symptom%");
//             }
//         })
//         ->get();

//     // Fake confidence score
//     $confidence = rand(60, 85);

//     // return view('diseases.prediction-result', compact('plantImage', 'possibleDiseases', 'confidence'));
//     return redirect()->route('disease.identification')
//                  ->with('success', 'Image uploaded successfully');
// }


    // public function process(Request $request)
    // {
    //     $request->validate([
    //         'plant_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
    //         'crop_id'     => 'required|exists:crops,id',
    //     ]);

    //     // Save uploaded image
    //     $path = $request->file('plant_image')->store('plant_images', 'public');
    //     $plantImage = PlantImage::create([
    //         'user_id'       => Auth::id(),
    //         'crop_id'       => $request->crop_id,
    //         'file_path'     => $path,
    //         'original_name' => $request->file('plant_image')->getClientOriginalName(),
    //     ]);

    //     // Pull expert-defined diseases for this crop
    //     $crop = Crop::with('diseases')->findOrFail($request->crop_id);

    //     // Rule-based prediction: all diseases for this crop
    //     $possibleDiseases = $crop->diseases;

    //     // Eager-load expert diagnoses for this image
    //     $expertDiagnoses = $plantImage->diagnoses()->with(['disease','expert'])->get();

    //     // Fake confidence score
    //     $confidence = rand(60, 85);

    //     return view('diseases.prediction-result', compact(
    //         'plantImage',
    //         'possibleDiseases',
    //         'expertDiagnoses',
    //         'confidence'
    //     ));
    // }


       public function process(Request $request)
    {
        $request->validate([
            'plant_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'crop_id'     => 'required|exists:crops,id',
        ]);

        // Save uploaded image
        $path = $request->file('plant_image')->store('plant_images', 'public');
        $plantImage = PlantImage::create([
            'user_id'       => Auth::id(),
            'crop_id'       => $request->crop_id,
            'file_path'     => $path,
            'original_name' => $request->file('plant_image')->getClientOriginalName(),
        ]);

        // Redirect to showPrediction with the new image ID
        return redirect()->route('prediction.show', $plantImage->id);
    }

    public function diagnose(Request $request, $plantImageId)
    {
        $request->validate([
            'disease_id' => 'required|exists:diseases,id',
        ]);

        // Ensure the plant image exists
        $plantImage = PlantImage::findOrFail($plantImageId);

        DiseaseDiagnosis::create([
            'plant_image_id' => $plantImage->id,
            'expert_id'      => Auth::id(),
            'disease_id'     => $request->disease_id,
        ]);

        // return back()->with('success', 'Diagnosis saved successfully');

        return redirect()->route('expert.dashboard', ['section' => 'diagnosis'])
        ->with('success', 'Diagnosis saved successfully');
    }

//     public function showPrediction($plantImageId)
// {
//     $plantImage = PlantImage::with(['diagnoses.disease','diagnoses.expert'])
//                             ->findOrFail($plantImageId);

//     $possibleDiseases = $plantImage->crop->diseases;
//     $expertDiagnoses = $plantImage->diagnoses;

//     return view('diseases.prediction-result', compact(
//         'plantImage',
//         'possibleDiseases',
//         'expertDiagnoses'
//     ));
// }

//     public function showPrediction($plantImageId)
// {
//     $plantImage = PlantImage::with([
//         'diagnoses.disease',
//         'diagnoses.expert',
//         'crop.diseases'
//     ])->findOrFail($plantImageId);

//     return view('diseases.prediction-result', [
//         'plantImage' => $plantImage,
//         'possibleDiseases' => $plantImage->crop->diseases
//     ]);
// }

   public function showPrediction($plantImageId)
    {
        $plantImage = PlantImage::with(['diagnoses.disease','diagnoses.expert'])
                                ->findOrFail($plantImageId);

        $possibleDiseases = $plantImage->crop->diseases;
        $expertDiagnoses = $plantImage->diagnoses;

        //  confidence score (random for now)
        $confidence = rand(60, 85);

        return view('diseases.prediction-result', compact(
            'plantImage',
            'possibleDiseases',
            'expertDiagnoses',
            'confidence'
        ));
    }

    public function pendingImages()
    {
        $images = PlantImage::with('user')
            ->whereDoesntHave('diagnoses') // only pending
            ->latest()
            ->get()
            ->map(function($img) {
                return [
                    'id' => $img->id,
                    'farmer_name' => $img->user->name ?? 'Unknown',
                    'file_path' => $img->file_path,
                    'original_name' => $img->original_name,
                    'uploaded_at' => $img->created_at->format('d M Y, h:i A'),
                ];
            });

        return response()->json($images);
    }

    public function diagnoses($plantImageId)
    {
        $plantImage = PlantImage::with(['diagnoses.disease','diagnoses.expert'])
                                ->findOrFail($plantImageId);

        $diagnoses = $plantImage->diagnoses->map(function($diag) {
            return [
                'disease_name' => $diag->disease->name,
                'expert_name'  => $diag->expert->name ?? $diag->expert->username ?? 'Unknown Expert',
            ];
        });

        return response()->json($diagnoses);
    }


}
