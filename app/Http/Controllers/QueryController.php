<?php
namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question'   => 'required|string|max:1000',
            'crop_id'    => 'nullable|exists:crops,id',
            'disease_id' => 'nullable|exists:diseases,id',
        ]);

        if (!$request->crop_id && !$request->disease_id) {
            return back()->withErrors(['context' => 'You must select a crop or disease.']);
        }

        Query::create([
            'user_id'    => Auth::id(),
            'crop_id'    => $request->crop_id,
            'disease_id' => $request->disease_id,
            'question'   => $request->question,
            'status'     => 'open',
        ]);

        return redirect()->back()->with('success', 'Your query has been submitted.')->withFragment('ask-queries');
    }
}
