<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Models\QueryReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueryReplyController extends Controller
{
    public function store(Request $request, Query $query)
    {
        $request->validate([
            'reply' => 'required|string|max:2000',
        ]);

        QueryReply::create([
            'query_id'  => $query->id,
            'expert_id' => Auth::id(),
            'reply'     => $request->reply,
        ]);

        // Update query status
        $query->update(['status' => 'answered']);

         return redirect()
        ->back()
        ->with('success', 'Reply added successfully.')
        ->withFragment('expert-queries');
    }
}
