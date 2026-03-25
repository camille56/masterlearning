<?php

namespace App\Http\Controllers;

use App\Models\VideoProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoProgressController extends Controller
{
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'video_id' => 'required|integer|exists:videos,id',
            'last_timestamp' => 'required|integer',
            'last_hash' => 'required|string',
            'is_complete' => 'required|boolean',
        ]);

        $progress = VideoProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'video_id' => $validatedData['video_id'],
            ],
            [
                'last_timestamp' => $validatedData['last_timestamp'],
                'last_hash' => $validatedData['last_hash'],
                'is_complete' => $validatedData['is_complete'],
            ]
        );

        return response()->json($progress);
    }
}
