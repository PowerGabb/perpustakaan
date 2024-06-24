<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Book;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {

        $profile = User::where('id', Auth::user()->id)->first();
        return view('account.index', compact('profile'));
    }

    public function edit()
    {

        $profile = User::where('id', Auth::user()->id)->first();
        return view('account.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = User::where('id', Auth::user()->id)->first();

        $request->validate([
            'name' => 'required',
            'nisn' => 'required|max:10',
            'class' => 'required',
            'email' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        if ($request->hasFile('photo')) {
            $nameimg = $request->name . '-' . date('Y-m-d') . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/photo/', $nameimg);
            $profile->avatar = $nameimg;
        }

        $profile->name = $request->name;
        $profile->nisn = $request->nisn;
        $profile->class = $request->class;
        $profile->role = $request->role;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->save();

        return redirect('/profile')->with('success', 'akun berhasil diperbarui');
    }

    public function rents()
    {

        $data = Rent::where('user_id', Auth::user()->id)->latest()->get();

        return view('account.pinjamanku', compact('data'));
    }

    public function pinjam($id)
    {

        $data = Book::where('id', $id)->first();
        return view('account.alert', compact('data'));
    }

    public function pinjamNow($id)
    {

        $data = Book::where('id', $id)->first();

        if ($data->jumlah == 0) {
            return redirect('/')->with('error', 'Buku sedang tidak tersedia atau stock habis');
        }

        if (Auth::user()->role == 'guru' || Auth::user()->role == 'anggota') {
            // jika role nya adalah guru atau anggota maka tidak perlu mengisi nisn
        } elseif (Auth::user()->role == 'siswa') {
            // jika role nya siswa maka wajib mengisi nisn
            if (Auth::user()->nisn == null) {
                return redirect('/profile/edit')->with('error', 'Lengkapi data diri terlebih dahulu');
            }
        } else {
            return redirect('/book')->with('error', 'Akun anda tidak bisa meminjam buku');
        }

        $activeLoans = Rent::where('user_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('status', 'waiting')
                    ->orWhere('status', 'dipinjam');
            })
            ->count();

        if ($activeLoans >= 3) {
            return redirect('/book')->with('error', 'Anda tidak dapat meminjam lebih dari 3 buku.');
        }


        $rent = Rent::create([
            'user_id' => Auth::user()->id,
            'book_id' => $id,
            'status' => 'waiting'
        ]);

        return redirect('/pinjamanku')->with('Buku di ajukan, menunggu persetujuan');
    }

    public function printCard(){

        
        $account = User::where('id', Auth::user()->id)->first();
        // return view('card.card', compact('account'));

        $mpdf = new Mpdf();
        $mpdf->WriteHTML(view('card.card', compact('account')));
        $mpdf->Output();
        
    }

   
}
