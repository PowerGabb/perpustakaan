<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rent;
use App\Models\User;
use App\Models\Violation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentsController extends Controller
{
    public function index()
    {

        $data = Rent::with('user', 'book')->where('status', '!=', 'waiting')->get();
        return view('rents.index', compact('data'));
    }

    public function create()
    {


        $students = User::where('role', 'siswa')->get();
        $books = Book::all();
        return view('rents.create', compact('students', 'books'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
        ]);

        Rent::create(
            [
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'status' => 'dipinjam',
                'assign' => 'by admin',
                'rent_at' => Carbon::now()->format('Y-m-d'),
                'return_at' => null,
                'rent_time_limit' => Carbon::now()->addDays(7)->format('Y-m-d'),
            ]
        );


        $book = Book::find($request->book_id);
        $book->update([
            'jumlah' => $book->jumlah - 1
        ]);


        return redirect('/rents/create')->with('success', 'Data Peminjaman Di Tambahkan');
    }

    public function waiting()
    {

        $data = Rent::with('user', 'book')->where('status', 'waiting')->paginate(5);
        return view('rents.waiting', compact('data'));
    }

    public function accept($id)
    {

        $data = Rent::find($id);
        $denda = Violation::where('id', 4)->first();

        $book = Book::find($data->book_id);
        $book->update([
            'jumlah' => $book->jumlah - 1
        ]);
        $data->update([
            'status' => 'dipinjam',
            'rent_at' => Carbon::now()->format('Y-m-d'),
            'rent_time_limit' => Carbon::now()->addDays($denda->nominal)->format('Y-m-d'),
            'assign' => 'by admin',
        ]);

        return redirect('/rents-waiting')->with('success', 'Data Peminjaman Di Tambahkan');
    }

    public function returning()
    {

        $data = Rent::with('user', 'book')->where('status', 'dipinjam')->get();
        return view('rents.returning', compact('data'));
    }

    public function back(Request $request)
    {
        $data = Rent::find($request->id);
        $book = Book::find($data->book_id);

        // Update jumlah buku
        $book->update([
            'jumlah' => $book->jumlah + 1
        ]);

        // Calculate the difference in days
        $rentTimeLimit = Carbon::parse($data->rent_time_limit);
        $now = Carbon::now();
        $diffInDays = $now->diffInDays($rentTimeLimit, false); 

        // Calculate denda
        $denda = $diffInDays > 0 ? 0 : abs($diffInDays) * 2000;

        // Update rent data
        $data->update([
            'status' => 'returned',
            'denda' => $denda,
            'return_at' => $now->format('Y-m-d'),
        ]);

        return redirect('/rents-return')->with('success', 'Buku Dikembalikan');
    }


    public function destroy(Request $request, $id)
    {
        $data = Rent::find($id);
        $data->delete();
        return redirect('/rents-waiting')->with('success', 'Data Terhapus');
    }
}
