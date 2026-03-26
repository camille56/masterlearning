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
            'last_hash' => 'required|string', //  hash front
            'is_complete' => 'required|boolean',
        ]);

        /**
         * constantes
         */
        $clefSuperSecrete = "superCouscous";
        $ecartTolerable = 5;

        //On récupère les données soumises par le front
        $userId = Auth::id();
        $videoId = $validatedData['video_id'];
        $nouveauTimestamp = $validatedData['last_timestamp'];
        $hashEnvoyeParLeFront = $validatedData['last_hash'];
        $isComplete = $validatedData['is_complete'];

        //est ce la premiere fois qu on lance la vidéo?
        $existingProgress = VideoProgress::where('user_id', $userId)
            ->where('video_id', $videoId)
            ->first();

        if ($existingProgress) {
            //Il y a deja en base une entrée. on doit vérifier que le hash que l'on va
            // constituer avec les données du front soit identique au hash constitué à partir du back.

            $ancienTimeStamp= $existingProgress->last_timestamp;
            $ancienHashBdd = $existingProgress->last_hash;
            $clef = $userId . $videoId . $nouveauTimestamp . $ancienHashBdd . $clefSuperSecrete;
            $shaAttendu = hash('sha256', $clef);

            $ecart=$nouveauTimestamp-$ancienTimeStamp;

            if ($ecart>$ecartTolerable){
                return response()->json(['error' => 'Triche'], 403);
            }


            if ($shaAttendu === $hashEnvoyeParLeFront) {
                //update autorisé et on update le hash et le timestamp
                $existingProgress->update([
                    'last_timestamp' => $nouveauTimestamp,
                    'last_hash' => $shaAttendu,
                    'is_complete' => $isComplete,
                ]);
                return response()->json($existingProgress);
            } else {
                return response()->json(['error' => 'Hash invalide'], 403);
            }

        } else {
            $hashBase =  "couscous";

            $clef = $userId . $videoId . $nouveauTimestamp . $hashBase . $clefSuperSecrete;
            $shaAttendu = hash('sha256', $clef);

            if ($shaAttendu === $hashEnvoyeParLeFront) {
                $progress = VideoProgress::create([
                    'user_id' => $userId,
                    'video_id' => $videoId,
                    'last_timestamp' => $nouveauTimestamp,
                    'last_hash' => $shaAttendu, // On sauvegarde
                    'is_complete' => $isComplete,
                ]);
                return response()->json($progress);
            }

            return response()->json(['error' => 'Premier hash invalide'], 403);
        }
    }
}
