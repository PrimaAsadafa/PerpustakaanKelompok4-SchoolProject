<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {// Ambil kategori dari query (default = semua)
        $kategori = $request->input('kategori');

        // Filter berdasarkan kategori
        $books = Book::when($kategori, function ($query, $kategori) {
            return $query->where('kategori', $kategori);
        })
        ->latest()
        ->get();

        return view('home', compact('books', 'kategori'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        
        return response()->json([
            'id' => $book->id,
            'judul' => $book->judul,
            'tahun_terbit' => $book->tahun_terbit,
            'deskripsi' => $book->deskripsi,
            'thumbnail_path' => $book->thumbnail_path ? asset('storage/' . $book->thumbnail_path) : null,
            'read_url' => route('books.read', $book->id),
            'file_path' => route('books.view-pdf', $book->id),
        ]);
    }
}
