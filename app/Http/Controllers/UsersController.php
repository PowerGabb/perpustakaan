<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {

        $data = User::all();
        return view('users.index', ['data' => $data]);
    }

    public function show(User $user){
        // dd($user);
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user){
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $user){
        
        $user = User::find($user);
        $user->update($request->all());
        return redirect('/users');
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){

        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'nisn' => 'required',
            'password' => 'required',
            'class' => 'required'
        ]);

        User::create(
            [
            'name' => $request->name,
            'email' => $request->email,
            'nisn' => $request->nisn,
            'password' => bcrypt($request->password),
            'class' => $request->class,
            'role' => 'siswa'
            ]
        );
        return redirect('/users');
    }

    public function activation(){
       
        $data = User::where('role', 'menunggu aktivasi')->paginate(5);
        return view('users.activation', ['data' => $data]);
    }

    public function activate($user){

        $user = User::find($user);
        $user->update(['role' => 'siswa']);
        return redirect('users-activation');
    }

    public function destroy(Request $request, $user){
        $user = User::find($user);
        $user->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
