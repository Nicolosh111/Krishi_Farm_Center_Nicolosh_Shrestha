<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuccessStory;

class ExpertController extends Controller
{
    public function approve(SuccessStory $story)
    {
        $story->update(['status' => 'approved']);

        return redirect()->route('expert.dashboard', ['section' => 'expert-stories'])
            ->with('success', 'Story approved successfully.');
    }

    public function reject(SuccessStory $story)
    {
        $story->update(['status' => 'rejected']);

        return redirect()->route('expert.dashboard', ['section' => 'expert-stories'])
            ->with('success', 'Story rejected.');
    }

    public function queries()
    {
        $queries = \App\Models\Query::with(['user','crop','disease','replies.expert'])
                                    ->latest()
                                    ->get();

        return view('expert.partials.queries', compact('queries'));
    }
}
