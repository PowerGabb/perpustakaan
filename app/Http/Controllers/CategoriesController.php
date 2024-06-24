<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){

        $data = Categories::paginate(5);
        return view('categories.index', ['data' => $data]);        
    }

    public function create(){

        return view('categories.create');
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required',
        ]);

        Categories::create($request->all());

        return redirect()->route('categories.create')->with('success', 'Category created successfully.');
    }

    public function destroy(Request $request, $id){
        $data = Categories::find($id);
        $data->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
