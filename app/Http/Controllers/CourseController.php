<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CourseController extends Controller
{
    public function index() {
        return response()->json(Course::with('subject')->get());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
        ]);
        $course = Course::create($data);
        return response()->json($course, 201);
    }

    public function show($id) {
        $course = Course::with('subject')->find($id);
        return $course ? response()->json($course) : response()->json(['error' => 'Not found'], 404);
    }
}
