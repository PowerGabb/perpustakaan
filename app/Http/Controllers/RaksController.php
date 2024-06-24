<?php

namespace App\Http\Controllers;

use App\Models\NoRak;
use Illuminate\Http\Request;

class RaksController extends Controller
{
    public function index(){

        $data = NoRak::paginate(5);
        return view('raks.index', compact('data'));
    }

    public function create(){
        return view('raks.create');
    }

    public function store(Request $request){
        $data = new NoRak();
        $data->name = $request->name;
        $data->save();
        return redirect('/raks/create')->with('success', 'Data Tersimpan');
    }

    public function destroy($id){
        $data = NoRak::find($id);
        $data->delete();
        return redirect('/raks')->with('success', 'Data Terhapus');
    }
}
