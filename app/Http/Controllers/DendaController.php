<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {

        $data = Violation::all();
        return view('denda.index', compact('data'));
    }

    public function edit($id){

        $data = Violation::find($id);
        return view('denda.edit', compact('data'));
    }

    public function update(Request $request, $id){

        $validate = $request->validate([
            'nominal' => 'required',
        ]);
        $data = Violation::find($id);
        $data->update($request->all());
        return redirect('/denda');
    }
}
