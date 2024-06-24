@extends('layouts.second')
@section('title', 'Perpustakaan | Yasfat')
@section('content')

    <div class="container contents">

        @if (Auth::check())
            @if (Auth::user()->role == 'menunggu aktivasi')
                <div class="row">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Selamat Anda Berhasil Register, Namun Akun Anda Belum Terverifikasi Oleh Admin Dan Belum Bisa Meminjam</strong>
                    </div>
                </div>
            @endif
        @endif
        <div class="header-box d-flex align-items-center row">
            <div class="col-lg-6">
                <h1 class="mb-4"><span style="color: red;">Perpustakaan Yasfat</span><br>Bersama Kami</h1>
                <p class="mb-3">Selamat datang di Perpustakaan Yasfat, tempat di mana pengetahuan dan inspirasi bertemu
                    dalam harmoni sempurna. Kami tidak hanya sekadar sebuah perpustakaan; kami adalah pusat kearifan yang
                    mengundang Anda untuk menjelajahi dunia pengetahuan dengan penuh semangat dan keingintahuan.</button>
                <div>
                    <a href="/book" class="btn btn-primary">Cari Buku</a>
                </div>
            </div>
            <div class="pt-lg-0 pt-5 d-flex justify-content-center align-items-center col-lg-6">
                <img src="{{ asset('storage/logo/'. $logo->logo) }}" alt="">
            </div>
        </div>
    </div>

    <div class="container hotbook">

        <h1 class="align-center mb-5 text-center">Buku Terbaru</h1>

        <div class="row row-cols-1 row-cols-md-4 g-3 mt-4">
            @foreach ($books as $item)
                <div class="col mb-3">
                    <div class="card shadow h-100">
                        @if ($item->cover)
                            <img src="{{ asset('storage/cover/' . $item->cover) }}" alt="unsplash.com"
                                class="card-img-top rounded mt-3 px-3">
                        @else
                            <img src="{{ asset('default.png') }}" alt="unsplash.com" class="card-img-top rounded mt-3 px-3">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="/book/{{ $item->id }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                            <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    </div>

    

@endsection

