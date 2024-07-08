@extends('layouts.main')
@section('title', 'Tambah Buku')
@section('content')
<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Buku</h5>
            <small class="text-muted float-end"></small>
        </div>
        <div class="card-body">
            <form action="/books/{{ $book->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Judul Buku</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="title" value="{{ $book->title }}">
                        @error('title')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">No Inventaris</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="no_inventaris" value="{{ $book->no_inventaris }}">
                        @error('no_inventaris')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Buku</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" id="book_code"
                            name="book_code" value="{{ $book->book_code }}">
                        @error('book_code')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Pengarang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="pengarang" value="{{ $book->pengarang }}">
                        @error('pengarang')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="penerbit" value="{{ $book->penerbit }}">
                        @error('penerbit')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Kota Terbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="kota_terbit" value="{{ $book->kota_terbit }}">
                        @error('kota_terbit')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Edisi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="edisi" value="{{ $book->edisi }}">
                        @error('edisi')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Diterbikan Pada</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="basic-default-name" name="publication_year" value="{{ $book->publication_year }}">
                        @error('publication_year')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Rak Buku</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="rak" value="{{ $book->rak }}">
                        @error('rak')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Jumlah Halaman</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="basic-default-name" name="jumlah_halaman" value="{{ $book->jumlah_halaman }}">
                        @error('jumlah_halaman')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Tinggi Buku</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="basic-default-name" name="tinggi_buku" value="{{ $book->tinggi_buku }}">
                        @error('tinggi_buku')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">ISBN</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="isbn" value="{{ $book->isbn }}">
                        @error('isbn')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="kategori" value="{{ $book->kategori }}">
                        @error('kategori')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Sumber</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="sumber" value="{{ $book->sumber }}">
                        @error('sumber')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="harga" value="{{ $book->harga }}">
                        @error('harga')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="keterangan" value="{{ $book->keterangan }}">
                        @error('keterangan')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Stok Buku</label>
                    <div class="col-sm-10">
                        <input type="number" name="jumlah" class="form-control" id="basic-default-name" value="{{ $book->jumlah }}">
                        @error('jumlah')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Cover Buku</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="basic-default-name" name="cover" >
                        @error('cover')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Deskripsi Buku</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="" cols="40" class="form-control" rows="5"> {{ $book->description }} </textarea>
                        @error('description')
                            <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>


@if ($errors->any())
<div class="bs-toast toast fade show bg-danger position-fixed bottom-0 end-0 m-3" role="alert"
    aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Gagal</div>
        <small>Now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{ $errors->first() }}
    </div>
</div>

<style>
    @media (max-width: 767px) {
        .bs-toast {
            max-width: 200px;
            font-size: 12px;
        }
    }
</style>
@endif
<!-- jQuery -->

<!-- Your script -->



@endsection
