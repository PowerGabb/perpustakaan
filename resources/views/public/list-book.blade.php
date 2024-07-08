@extends('layouts.second')
@section('title', 'Perpustakaan | Buku')
@section('content')
    <div class="container contents">

        
        @if (session()->has('error'))
            @if (Auth::user()->role == 'menunggu aktivasi')
                <div class="row">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                    </div>
                </div>
            @endif
        @endif

        @if (session()->has('error'))
     
                <div class="row">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                    </div>
                </div>
           
        @endif

        <div>
            <form action="/book" method="GET">
                @csrf
                <div class="input-group mb-3">
                    
                    <select class="form-select" name="kategori">
                        <option value="">Semua Kategori</option>
                       
                        @foreach ($kategori as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                </div>
            </form>
        </div>
        <div class="row">
            @forelse ($books as $item)
                <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                    <div class="card h-100">
                        <img draggable="false" class="img-fluid d-flex mx-auto my-4"
                            @if ($item->cover != '') src="{{ asset('storage/cover/' . $item->cover) }}"
                    @else
                    src="{{ asset('default.png') }}" @endif
                            alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">
                                Kode Buku: {{ $item->book_code }}
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="/book/{{ $item->id }}" class="btn btn-outline-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                    <div class="card h-100">
                        <img draggable="false" class="img-fluid d-flex mx-auto my-4" src="{{ asset('default.png') }}">

                        <div class="card-body">
                            <h5 class="card-title text-danger">Buku Tidak Di Temukan</h5>
                            <p class="card-text">
                                Kode Buku: -----
                            </p>

                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
