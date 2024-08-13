<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Mon Espace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="bg-slate-400">
        <nav class="bg-gray-200 p-4">
            <div class="container mx-auto flex items-center justify-between">
                <a href="#" class="text-lg font-semibold">Mon Blog</a>
            
                <div id="navbar-menu" class="lg:flex flex-grow hidden items-center justify-end space-x-4">
             

                    <form action="{{ route('logout') }}" method="POST" class="flex items-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="ml-4 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none">Logout</button>
                    </form>

                </div>
            </div>
        </nav>


        <div class="container mx-auto p-4">
            <h1 class="text-3xl font-bold text-gray-900">Welcome, {{ Auth::user()->name }}</h1>
        </div>

        <div class=" dark:bg-gray-800 flex justify-center items-center">
          <form action="{{ route('posts.search')}}" method="GET" class="max-w-[480px] w-full px-4">
              <div class="relative">
                  <input type="text" name="search" value="{{ request('search')}}" class="w-full border h-12 shadow p-4 rounded-full dark:text-gray-800 dark:border-gray-700 dark:bg-gray-200" placeholder="Rechercher des posts ...">
                  <button type="submit">
                      <svg class="text-teal-400 h-5 w-5 absolute top-3.5 right-3 fill-current dark:text-teal-300"
                          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                          x="0px" y="0px" viewBox="0 0 56.966 56.966"
                          style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve">
                          <path
                              d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z">
                          </path>
                      </svg>
                  </button>
              </div>
          </form>
      </div>

  
        <div class="container mx-auto p-6 ">
            <h1 class="text-3xl font-bold mb-6">Liste des Articles</h1>
            <a href="{{ route('posts.create') }}"
                class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Créer un nouvel article</a>

            @if (session('success'))
                <p class="mt-4 bg-green-500 text-white p-2 rounded">{{ session('success') }}</p>
            @endif

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($posts as $post)
                    <div class="p-4 rounded shadow bg-white">
                        <div class="relative mb-4">
                            <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('default-image.jpg') }}"
                                alt="Aperçu de l'article" class="w-full h-40 object-cover rounded-lg">
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold mb-2">
                                <a href="{{ route('posts.show', $post->id) }}"
                                    class="text-blue-500 hover:underline">{{ $post->title }}</a>
                            </h2>
                            <p class="text-gray-500 text-sm mb-2">Posté {{ $post->created_at->diffForHumans() }}</p>
                            <div class="flex justify-between gap-2">
                                <a href="{{ route('posts.edit', $post->id) }}" class="bg-blue-600 text-white py-2 px-6 rounded-lg shadow hover:bg-blue-700 transition duration-300">Éditer</a>

                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class=" flex justify-center mt-6">
                {{ $posts->links() }}
            </div>
        </div>
        
    </div>
</body>



</html>
