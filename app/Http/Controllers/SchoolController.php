<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SchoolController extends Controller
{
    // Récupérer toutes les écoles
    public function index()
    {
        $schools = School::all();
        return response()->json($schools);
    }

    // Créer une nouvelle école
    public function store(Request $request)
    {
        // Validation simple
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
        ]);

        $school = School::create($request->all());

        return response()->json([
            'message' => 'École créée avec succès !',
            'data' => $school
        ], 201);
    }

    // Récupérer une école spécifique avec ses classes
    public function show($id)
    {
        $school = School::with('classrooms')->find($id);

        if (!$school) {
            return response()->json(['message' => 'École non trouvée'], 404);
        }

        return response()->json($school);
    }
}
