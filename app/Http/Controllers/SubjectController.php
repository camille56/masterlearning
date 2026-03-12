<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SubjectController extends Controller
{
    public function index() {
        return response()->json(Subject::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|unique:subjects',
        ]);
        $subject = Subject::create($data);
        return response()->json($subject, 201);
    }

    public function show($id) {
        $subject = Subject::with('courses')->find($id);
        return $subject ? response()->json($subject) : response()->json(['error' => 'Not found'], 404);
    }
}
