<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\NoRak;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use PDF;
use Picqer\Barcode\BarcodeGeneratorPNG;

class BooksController extends Controller
{
    public function index()
    {
        $data = Book::with('noRak')->get();

        return view('books.index', compact('data'));
    }

    public function search(Request $request){
        $data = Book::with('noRak')->where('title', 'like', '%' . $request->search . '%')->get();
        return view('books.index', compact('data'));
    }

    

    public function create()
    {

        $authors = Author::all();
        $publishers = Publisher::all();
        $raks = NoRak::all();
        $categories = Categories::all();
        return view('books.create', compact('authors', 'raks', 'publishers', 'categories'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'book_code' => 'required|unique:books,book_code',
            'author_id' => 'required',
            'categories' => 'required',
            'publisher_id' => 'required',
            'description' => 'max:210',
            'rak_id' => 'required',
            'jumlah' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'publication_year' => 'required',
        ]);


        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $imgname = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/cover', $imgname);
        }else
        {
            $imgname = null;
        }

        $data = Book::create([
            'title' => $request->title,
            'book_code' => $request->book_code,
            'author_id' => $request->author_id,
            'publisher_id' => $request->publisher_id,
            'rak_id' => $request->rak_id,
            'cover' => $imgname,
            'publication_year' => $request->publication_year,
            'description' => $request->description,
            'jumlah' => $request->jumlah,
        ]);

        $data->categories()->attach($request->categories);

        return redirect()->route('books.index')->with('success', 'Data created successfully');
    }



    public function edit($id)
    {
        $book = Book::find($id);
        $authors = Author::all();
        $publishers = Publisher::all();
        $raks = NoRak::all();
        $categories = Categories::all();
        return view('books.edit', compact('book', 'authors', 'raks', 'publishers', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'rak_id' => 'required',
            'jumlah' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'publication_year' => 'required',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('cover')) {
            // Hapus gambar lama
            Storage::delete('public/cover/' . $book->cover);

            $image = $request->file('cover');
            $imgname = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/cover', $imgname);
            $book->cover = $imgname;
        }

        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->book_code = $request->book_code;
        $book->publisher_id = $request->publisher_id;
        $book->rak_id = $request->rak_id;
        $book->publication_year = $request->publication_year;
        $book->description = $request->description;
        $book->jumlah = $request->jumlah;
        $book->save();

        // Synchronize kategori
        $book->categories()->sync($request->categories);

        return redirect()->route('books.index')->with('success', 'Data updated successfully');
    }


    public function destroy($id)
    {
        $data = Book::find($id);
        $data->delete();
        return redirect()->route('books.index')->with('success', 'Data deleted successfully');
    }


    public function barcode_pdf(){
        $data = Book::all();
        return view('books.barcode_pdf', compact('data'));
    }

    public function downloadPDF(){
        

    

        $mpdf = new Mpdf();
        $data = Book::all();
        // return view('pdf-generator.barcode-all', compact('data'));
        $mpdf->WriteHTML(view('pdf-generator.barcode-all', compact('data')));
        $mpdf->Output();

    }
}
