<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Article</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
        <p class="mb-4">{{ $post->body }}</p>
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="Image" class="mb-4 w-64 h-64 object-cover">
        @endif
        <a href="{{ route('posts.edit', $post->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Éditer</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Supprimer</button>
        </form>
        <br>
        <a href="{{ route('posts.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Retour à la liste</a>
    </div>
</body>
</html>
