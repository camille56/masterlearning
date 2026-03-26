<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $video->title }}</title>
</head>
<body>
    <h1>{{ $video->title }}</h1>
    <p>{{ $video->description }}</p>
    <video id="video-player" width="640" height="480" controls data-video-id="{{ $video->id }}">
        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <br>
    <a href="{{ route('videos.index') }}">Retour à la liste de videos</a>

    <script>
        const videoPlayer = document.getElementById('video-player');
        const videoId = videoPlayer.dataset.videoId;
        let progressInterval;

        // Fonction pour envoyer la mise à jour de la progression
        function sendProgressUpdate(isComplete = false) {
            const currentTime = Math.floor(videoPlayer.currentTime);

            // const lastHash = `${videoId}${currentTime}`;

            console.log(`Envoi de la progression : ${currentTime}s, Terminé : ${isComplete}`);

            fetch('/video-progress', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    video_id: videoId,
                    last_timestamp: currentTime,
                    // last_hash: lastHash,
                    is_complete: isComplete
                })
            })
            .then(response => response.json())
            .then(data => console.log('Progression enregistrée:', data))
            .catch(error => console.error('Erreur:', error));
        }

        // Démarre l'envoi de la progression à intervalles réguliers
        videoPlayer.addEventListener('play', () => {
            console.log('Lecture démarrée. Début des mises à jour toutes les 5 secondes.');
            // On s'assure de ne pas avoir plusieurs intervalles en même temps
            clearInterval(progressInterval);
            progressInterval = setInterval(() => sendProgressUpdate(false), 5000);
        });

        // Arrête l'envoi de la progression lorsque la vidéo est en pause
        videoPlayer.addEventListener('pause', () => {
            console.log('Lecture en pause. Arrêt des mises à jour.');
            clearInterval(progressInterval);
            // Envoie une dernière mise à jour au moment de la pause
            sendProgressUpdate(false);
        });

        // Marque la vidéo comme terminée
        videoPlayer.addEventListener('ended', () => {
            console.log('Vidéo terminée.');
            clearInterval(progressInterval);
            // Envoie la mise à jour finale avec le statut "terminé"
            sendProgressUpdate(true);
        });
    </script>
</body>
</html>
