<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return response()->json(User::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:Etudiant,Professeur',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);
        $user = User::create($data);
        return response()->json($user, 201);
    }

    public function show($id) {
        $user = User::with('classroom')->find($id);
        return $user ? response()->json($user) : response()->json(['error' => 'Not found'], 404);
    }
}
