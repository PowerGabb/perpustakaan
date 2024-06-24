<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index(){
        $data = Author::paginate(5);
        return view('authors.index', compact('data'));
    }

    public function create(){
        return view('authors.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:authors|max:255',
        ]);

        Author::create($request->all());

        return redirect()->route('authors.create')->with('success', 'Added Author: '.$request->name);
    }

    public function destroy (Author $author){
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Deleted Author: '.$author->name);
    }
}
