<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF; // Import the PDF facade

class Postcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get posts
        $posts = Post::latest()->paginate(5);
        // Render view with posts
        return view('posts.index', compact('posts'));
    }

    public function downloadPDF()
{
    $posts = Post::all(); // Ambil semua data mahasiswa

    // Menggunakan DomPDF untuk menghasilkan PDF
    $pdf = PDF::loadView('posts.pdf', compact('posts')); // Pastikan 'pdf' adalah nama file Blade yang Anda buat untuk PDF
    return $pdf->download('daftar_mahasiswa.pdf'); // Nama file PDF yang akan diunduh
}
    public function show($id)
    {
        $post = Post::findOrFail($id); // Fetch the post by ID
        return view('posts.show', compact('post')); // Return the view with the post data
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validate form
        $request->validate([
            'foto_mahasiswa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nim' => 'required|min:5',
            'nama_mahasiswa' => 'required|min:5'
        ]);

        // Upload image
        $image = $request->file('foto_mahasiswa');
        $image->storeAs('public/posts', $image->hashName());

        // Create post
        Post::create([
            'foto_mahasiswa' => $image->hashName(),
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa
        ]);

        // Redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Validate form
        $request->validate([
            'foto_mahasiswa' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nim' => 'required|min:5',
            'nama_mahasiswa' => 'required|min:5'
        ]);

        // Check if image is uploaded
        if ($request->hasFile('foto_mahasiswa')) {
            // Upload new image
            $image = $request->file('foto_mahasiswa');
            $image->storeAs('public/posts', $image->hashName());

            // Delete old image
            Storage::delete('public/posts/' . $post->foto_mahasiswa);

            // Update post with new image
            $post->update([
                'foto_mahasiswa' => $image->hashName(),
                'nim' => $request->nim,
                'nama_mahasiswa' => $request->nama_mahasiswa
            ]);
        } else {
            // Update post without image
            $post->update([
                'nim' => $request->nim,
                'nama_mahasiswa' => $request->nama_mahasiswa
            ]);
        }

        // Redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(Post $post)
    {
        // Delete image
        Storage::delete('public/posts/' . $post->foto_mahasiswa);
        // Delete post
        $post->delete();
        // Redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}