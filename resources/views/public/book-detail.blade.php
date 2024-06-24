@extends('layouts.second')
@section('title', 'Detail')
@section('content')
    <div class="container contents">
        <div class="row">
            <div class="col-md-12 col-lg-12 mb-5">
                <div class="card h-100 w-100">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 col-lg-4">
                                @if ($book->cover != '')
                                    <img class="img-fluid d-flex mx-auto my-4"
                                        src="{{ asset('storage/cover/' . $book->cover) }}" alt="Card image cap">
                                @else
                                    <img class="img-fluid d-flex mx-auto my-4" src="{{ asset('default.png') }}"
                                        alt="Card image cap">
                                @endif
                            </div>
                            <div class="col-12 col-lg-8 pt-4">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <h6 class="card-subtitle text-muted mb-4">Kategori:
                                    @foreach ($book->categories as $datass)
                                        {{ $datass->title }},
                                    @endforeach
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Kode Buku:
                                    <p>{{ $book->book_code }}</p>
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Jumlah Stok:
                                    <p>{{ $book->jumlah }}</p>
                                </h6>
                                <p class="card-text mb-5">
                                    {!! $book->description !!}
                                </p>
                                <a href="/pinjam/buku/{{ $book->id }}" class="btn btn-outline-primary w-100">Pinjam</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    @if (Session::has('success'))
        <div class="bs-toast toast fade show bg-success bottom-0 end-0 position-fixed m-3" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Berhasil</div>
                <small>sec ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('success') }}
            </div>
        </div>
    @endif
@endsection
