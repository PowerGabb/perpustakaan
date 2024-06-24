<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rent;
use App\Models\Category;
use App\Models\Categories;
use App\Models\WebSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        
        // Mengambil data buku dengan kategori terkait, membatasi 4 item per halaman, dan mengurutkannya berdasarkan yang terbaru
        $books = Book::with('categories')->latest()->paginate(4);
        // $rented = Rent::where('status', 'dipinjam')
        // ->orWhere('status', 'waiting')
        // ->count();
        $logo = WebSetting::first();    
        // Mengirimkan data ke view dengan menggunakan nama yang lebih deskriptif
        return view('public.index', compact('books', 'logo'));
    }


    public function search(Request $request)
    {

        dd($request->input('search'));
        $searchTerm = $request->input('search');
        $books = Book::with('noRak')
            ->where('title', 'LIKE', "%{$searchTerm}%")
            ->paginate(4); // Using pagination with 4 items per page

        return view('public.list-book', compact('books'));
    }

    public function dashboard()
    {

        $books = Book::count();
        $categories = Categories::count();
        $rents = Rent::where('status', 'dipinjam')->count();

        $data = Rent::with('book', 'user')->latest()->get();
        return view('dashboard', compact('books', 'categories', 'rents', 'data'));
    }

    public function book($id)
    {

        $book = Book::with('categories', 'noRak', 'author', 'publisher')->find($id);
        return view('public.book-detail', compact('book'));
    }

    public function listBook(Request $request)
    {
        $categories = Categories::all();
        
        $query = Book::with('categories', 'noRak', 'author', 'publisher');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category); // Tambahkan alias tabel 'categories' di sini
            });
        }

        $books = $query->paginate(4);

        return view('public.list-book', compact('books', 'categories'));
    }
}
