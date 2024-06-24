<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublishersController extends Controller
{
    public function index(){

        $data = Publisher::paginate(5);
        return view('publishers.index', compact('data'));
    }

    public function create(){
        return view('publishers.create');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
        ]);

        Publisher::create($request->all());
        return redirect('/publishers/create')->with('success', 'Publisher created successfully');
    }

    public function destroy(Publisher $publisher){
        
        $publisher->delete();
        return redirect('/publishers')->with('success', 'Publisher deleted successfully');
        
    }
}
