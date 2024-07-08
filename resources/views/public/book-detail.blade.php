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
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                                <h6 class="card-subtitle text-muted mb-4">Nomor Inventaris:
                                    {{ $book->no_inventaris }}
                                 </h6>
                                @endif
                                <h6 class="card-subtitle text-muted mb-4">Kode Buku:
                                    {{ $book->book_code }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Pengarang:
                                    {{ $book->pengarang }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Penerbit:
                                    {{ $book->penerbit }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Kota Terbit:
                                    {{ $book->kota_terbit }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Edisi:
                                    {{ $book->edisi }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Tahun Terbit:
                                    {{ $book->publication_year }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Rak:
                                    {{ $book->rak }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Jumlah Halaman:
                                    {{ $book->jumlah_halaman }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Tinggi Buku:
                                    {{ $book->tinggi_buku }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">ISBN:
                                    {{ $book->isbn }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Kategori:
                                    {{ $book->kategori }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Sumber:
                                    {{ $book->sumber }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Harga:
                                    {{ $book->harga }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Keterangan:
                                    {{ $book->keterangan }}
                                </h6>
                                <h6 class="card-subtitle text-muted mb-4">Jumlah Stok:
                                    {{ $book->jumlah }}
                                </h6>
                                <p class="card-text mb-5">
                                    {!! $book->description !!}
                                </p>
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                                @else
                                <a href="/pinjam/buku/{{ $book->id }}" class="btn btn-outline-primary w-100">Pinjam</a>
                                @endif
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
