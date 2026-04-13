<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuccessStory;

class ExpertController extends Controller
{
    // public function approve(SuccessStory $story)
    // {
    //     $story->update(['status' => 'approved']);

    //     return redirect()->route('expert.dashboard', ['section' => 'expert-stories'])
    //         ->with('success', 'Story approved successfully.');
    // }

    // public function reject(SuccessStory $story)
    // {
    //     $story->update(['status' => 'rejected']);

    //     return redirect()->route('expert.dashboard', ['section' => 'expert-stories'])
    //         ->with('success', 'Story rejected.');
    // }

    public function approve(SuccessStory $story)
    {
        $story->update(['status' => 'approved']);

        return response()->json([
            'success' => true,
            'status' => 'approved',
            'message' => 'Story approved successfully.'
        ]);
    }

    public function reject(SuccessStory $story)
    {
        $story->update(['status' => 'rejected']);

        return response()->json([
            'success' => true,
            'status' => 'rejected',
            'message' => 'Story rejected successfully.'
        ]);
    }

    public function queries()
    {
        $queries = \App\Models\Query::with(['user','crop','disease','replies.expert'])
                                    ->latest()
                                    ->get();

        return view('expert.partials.queries', compact('queries'));
    }

       public function pendingStories()
        {
            $stories = SuccessStory::with('user')
                ->where('status', 'pending')
                ->latest()
                ->get()
                ->map(function($story) {
                    return [
                        'id' => $story->id,
                        'title' => $story->title,
                        'description' => $story->description,
                        'farmer_name' => $story->user->name ?? $story->farmer_name,
                        'location' => $story->location,
                        'image_url' => $story->image_url ? asset('storage/' . $story->image_url) : asset('images/placeholder.png'),
                        'status' => $story->status,
                    ];
                });

            return response()->json($stories);
        }

}
