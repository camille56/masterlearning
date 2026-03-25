<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos</title>
</head>
<body>
    <h1>Videos</h1>
    <a href="{{ route('videos.create') }}">Upload Video</a>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <div>
        @foreach ($videos as $video)
            <div>
                <h2>{{ $video->title }}</h2>
                <p>{{ $video->description }}</p>
                <video width="320" height="240" controls>
                    <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endforeach
    </div>
</body>
</html>
