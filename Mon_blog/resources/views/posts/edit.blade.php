<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Éditer un Article</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Éditer l'Article</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Titre:</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="body" class="block text-gray-700">Contenu:</label>
                <textarea name="body" id="body" class="w-full p-2 border border-gray-300 rounded" required>{{ $post->body }}</textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Image:</label>
                <input type="file" name="image" id="image" class="w-full p-2 border border-gray-300 rounded">
                @if ($post->image)
                    <br>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Image" class="mt-4 w-32 h-32 object-cover">
                @endif
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Mettre à Jour</button>
        </form>
    </div>
</body>
</html>
