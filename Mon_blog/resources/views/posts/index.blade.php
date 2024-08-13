<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Liste des Articles</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Liste des Articles</h1>
        <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Créer un nouvel article</a>

        @if (session('success'))
            <p class="mt-4 bg-green-500 text-white p-2 rounded">{{ session('success') }}</p>
        @endif

        <div class="mt-6 flex-grid grid-cols-4 gap-4">
            @foreach ($posts as $post)
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-semibold">
                        <a href="{{ route('posts.show', $post->id) }}"
                            class="text-blue-500 hover:underline">{{ $post->title }}</a>
                    </h2>
                    <p>Posted {{ $post->created_at->diffForHumans() }}</p>
                    <div class="mt-2">
                        <a href="{{ route('posts.edit', $post->id) }}"
                            class="text-blue-500 hover:underline">Éditer</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
