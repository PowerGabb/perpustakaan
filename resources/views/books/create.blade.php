@extends('layouts.main')
@section('title', 'Tambah Buku')
@section('content')
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Tambah Buku</h5>
                <form action="/import-excel-book" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
                </form>
            </div>
            <div class="card-body">
                <form action="/books" method="POST" enctype="multipart/form-data" id="bookForm">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Judul Buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" name="title">
                            @error('title')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Penulis Buku</label>
                        <div class="col-sm-10">
                            <select name="author_id" id="" class="form-control">
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Penerbit Buku</label>
                        <div class="col-sm-10">
                            <select name="publisher_id" id="" class="form-control">
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Rak Buku</label>
                        <div class="col-sm-10">
                            <select name="rak_id" id="" class="form-control">
                                @foreach ($raks as $rak)
                                    <option value="{{ $rak->id }}">{{ $rak->name }}</option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Diterbikan Pada</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="basic-default-name" name="publication_year">
                            @error('publication_year')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Category</label>
                        <div class="col-sm-10">
                            <select class="inputbox form-select" name="categories[]" multiple>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>



                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Stok Buku</label>
                        <div class="col-sm-10">
                            <input type="number" name="jumlah" class="form-control">
                            @error('jumlah')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Cover Buku</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="basic-default-name" name="cover">
                            @error('cover')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Deskripsi Buku</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="" cols="40" class="form-control" rows="5"></textarea>
                            @error('description')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" id="book_code"
                                name="book_code">
                            @error('book_code')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
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
    @if (session()->has('success'))
        <div class="bs-toast toast fade show bg-success position-fixed bottom-0 end-0 m-3" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Gagal</div>
                <small>Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
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
    @if (session()->has('error'))
        <div class="bs-toast toast fade show bg-danger position-fixed bottom-0 end-0 m-3" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Gagal</div>
                <small>Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('error') }}
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
    <script>
        document.getElementById('bookForm').addEventListener('keydown', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                return false;
            }
        });
    </script>


@endsection
