@extends('layouts.main')
@section('content')
    

        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3>List Buku</h3>
                        <div class="d-flex">
                            <a href="/books/create" class="btn btn-primary btn-sm me-2">Tambah Buku</a>
                            <a href="/download-pdf" class="btn btn-dark btn-sm me-2">Export Barcode</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Barcode</th>
                                        <th>Cover</th>
                                        <th>Jumlah</th>
                                        <th>Rak Buku</th>
                                        <th>Ditambah Pada</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{!! DNS1D::getBarcodeHTML($item->book_code, 'C128') !!}
                                                p - {{ $item->book_code }}</td>
                                            <td rowspan="1" colspan="1">
                                                @if ($item->cover)
                                                    <img src="{{ asset('storage/cover/' . $item->cover) }}" alt="img"
                                                        width="70">
                                                @else
                                                    <img src="{{ asset('default.png') }}" alt="img" width="70">
                                                @endif
                                            </td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>{{ $item->noRak->name }}</td>
                                            <td>{{ $item->created_at }}</td>

                                            <td>
                                                <form action="/books/{{ $item->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="btn-group d-flex">
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        <a href="/books/{{ $item->id }}/edit"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@if ($errors->any())
    <div class="bs-toast toast fade show bg-success position-fixed bottom-0 end-0 m-3" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Berhasil</div>
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


