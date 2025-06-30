<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends UserController
{

    public function index(Request $request)
    {
        $query = Candidate::query();

        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        if ($request->filled('skills')) {
            $query->where('skills', 'like', "%{$request->skills}%");
        }

        if ($request->filled('languages')) {
            $query->where('languages', 'like', "%{$request->languages}%");
        }

        $candidates = $query->paginate(10);
        return view('account.recruiter.candidates.index', compact('candidates'));
    }
}
