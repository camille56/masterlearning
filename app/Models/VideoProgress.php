<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoProgress extends Model
{
    use HasFactory;

    protected $table = 'video_progress';

    protected $fillable = [
        'user_id',
        'video_id',
        'last_timestamp',
        'last_hash',
        'is_complete',
    ];

    /**
     * Recherche la progression pour un utilisateur et une vidéo spécifiques.
     *
     * @param int $userId L'ID de l'utilisateur.
     * @param int $videoId L'ID de la vidéo.
     * @return self|null Retourne l'objet VideoProgress ou null s'il n'est pas trouvé.
     */
    public static function findForUserAndVideo(int $userId, int $videoId): ?self
    {
        return self::query()
            ->where('user_id', $userId)
            ->where('video_id', $videoId)
            ->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
