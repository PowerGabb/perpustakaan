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
        $books = Book::paginate(4);
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
        $rents = Rent::where('status', 'dipinjam')->count();
        $dipinjam = Rent::where('status', 'returned')->count();
        $kategori = Book::all()->pluck('kategori')->unique()->values()->count();
        


        $data = Rent::with('book', 'user')->latest()->get();
        return view('dashboard', compact('books', 'rents', 'data', 'dipinjam', 'kategori'));
    }

    public function book($id)
    {

        $book = Book::find($id);
        return view('public.book-detail', compact('book'));
    }

    public function listBook(Request $request)
    {
        $query = Book::query();  // Use query builder for flexibility

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->kategori) {
            $query->where('kategori', 'like', '%' . $request->kategori . '%');
        }

        $books = $query->get();
        
        $kategori = Book::all()->pluck('kategori')->unique()->values();
      
        return view('public.list-book', compact('books', 'kategori'));
    }
}
