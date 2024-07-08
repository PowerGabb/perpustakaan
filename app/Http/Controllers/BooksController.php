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

        $data = Book::all();
        return view('books.index', compact('data'));
    }

    public function search(Request $request)
    {
        $data = Book::with('noRak')->where('title', 'like', '%' . $request->search . '%')->get();
        return view('books.index', compact('data'));
    }



    public function create()
    {


        return view('books.create');
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $validate = $request->validate([
            'title' => 'required',
            'book_code' => 'required|unique:books,book_code',
        ]);


        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $imgname = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/cover', $imgname);
        } else {
            $imgname = null;
        }

        $data = Book::create([
            'title' => $request->title,
            'no_inventaris' => $request->no_inventaris,
            'book_code' => $request->book_code,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'kota_terbit' => $request->kota_terbit,
            'edisi' => $request->edisi,
            'publication_year' => $request->publication_year,
            'rak' => $request->rak,
            'jumlah_halaman' => $request->jumlah_halaman,
            'tinggi_buku' => $request->tinggi_buku,
            'isbn' => $request->isbn,
            'kategori' => $request->kategori,
            'sumber' => $request->sumber,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'cover' => $imgname,
            'description' => $request->description,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('books.index')->with('success', 'Data created successfully');
    }



    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {

        $book = Book::findOrFail($id);

        if ($request->hasFile('cover')) {
            // Hapus gambar lama
            Storage::delete('public/cover/' . $book->cover);

            $image = $request->file('cover');
            $imgname = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/cover', $imgname);
        } else {
            $imgname = $book->cover;
        }

        $book->update([
            'title' => $request->title,
            'no_inventaris' => $request->no_inventaris,
            'book_code' => $request->book_code,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'kota_terbit' => $request->kota_terbit,
            'edisi' => $request->edisi,
            'publication_year' => $request->publication_year,
            'rak' => $request->rak,
            'jumlah_halaman' => $request->jumlah_halaman,
            'tinggi_buku' => $request->tinggi_buku,
            'isbn' => $request->isbn,
            'kategori' => $request->kategori,
            'sumber' => $request->sumber,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'cover' => $imgname,
            'description' => $request->description,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('books.index')->with('success', 'Data updated successfully');
    }




    public function destroy($id)
    {
        $data = Book::find($id);
        $data->delete();
        return redirect()->route('books.index')->with('success', 'Data deleted successfully');
    }


    public function barcode_pdf()
    {
        $data = Book::all();
        return view('books.barcode_pdf', compact('data'));
    }

    public function downloadPDF()
    {




        $mpdf = new Mpdf();
        $data = Book::all();
        // return view('pdf-generator.barcode-all', compact('data'));
        $mpdf->WriteHTML(view('pdf-generator.barcode-all', compact('data')));
        $mpdf->Output();
    }
}
