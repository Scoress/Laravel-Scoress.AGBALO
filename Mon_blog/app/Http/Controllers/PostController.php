<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Post::query();


        // Vérifiez si une recherche est effectuée
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('body', 'like', "%{$search}%");
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('home', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'body' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public'); // Stocke l'image dans le répertoire public/images
        }

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Article créé avec succès.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        // $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // $this->authorize('update', $post);
       
        $validator = Validator([
            'title' => 'required|max:100',
            'body' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation pour les images
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            // Supprime l'ancienne image
            if ($post->image && file_exists(storage_path('app/public/' . $post->image))) {
                unlink(storage_path('app/public/' . $post->image));
            }
            // Télécharge la nouvelle image
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(Post $post)
    {
        // $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Article supprimé avec succès.');
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $search = $request->input('search');
        $posts = Post::where('title', 'like', "%{$search}%")
            ->orWhere('body', 'like', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('home', compact('posts'))->with('search', $search);
    }
}
