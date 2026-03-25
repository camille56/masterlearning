<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->title }}</title>
</head>
<body>
    <h1>{{ $video->title }}</h1>
    <p>{{ $video->description }}</p>
    <video width="640" height="480" controls>
        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <br>
    <a href="{{ route('videos.index') }}">Back to all videos</a>
</body>
</html>
