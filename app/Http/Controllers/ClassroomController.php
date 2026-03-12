<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ClassroomController extends Controller
{
    public function index() {
        return response()->json(Classroom::with('school')->get());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'school_id' => 'required|exists:schools,id', // Vérifie que l'école existe
        ]);
        $classroom = Classroom::create($data);
        return response()->json($classroom, 201);
    }

    public function show($id) {
        $classroom = Classroom::with(['school', 'users'])->find($id);
        return $classroom ? response()->json($classroom) : response()->json(['error' => 'Not found'], 404);
    }
}
