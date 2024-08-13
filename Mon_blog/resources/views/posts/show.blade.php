<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Blog - Article</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6 max-w-4xl bg-gray-200 shadow-md rounded-lg">
        <h1 class="text-4xl font-extrabold mb-6 text-gray-800">Titre: {{ $post->title }}</h1>
        <p class="text-lg text-gray-700 mb-6">Contenu: {{ $post->body }}</p>
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="Image" class="w-full max-w-lg h-60 object-cover mx-auto mb-6 rounded-lg shadow-lg">
        @endif
        <div class="flex gap-4 justify-start mb-6">
            <a href="{{ route('posts.edit', $post->id) }}" class="bg-blue-600 text-white py-2 px-6 rounded-lg shadow hover:bg-blue-700 transition duration-300">Éditer</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white py-2 px-6 rounded-lg shadow hover:bg-red-700 transition duration-300">Supprimer</button>
            </form>
        </div>
        <a href="{{ route('posts.index') }}" class="bg-gray-600 text-white py-2 px-6 rounded-lg shadow hover:bg-gray-700 transition duration-300">Retour à la liste</a>
    </div>
</body>


</html>
