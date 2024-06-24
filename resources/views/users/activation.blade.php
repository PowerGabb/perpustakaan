@extends('layouts.main')
@section('title', 'Pengguna')
@section('content')

    @php
        $currentPage = request()->input('page', 1); // Mendapatkan nomor halaman saat ini
        $perPage = $data->perPage(); // Mendapatkan jumlah item per halaman
        $startingNumber = ($currentPage - 1) * $perPage + 1; // Menghitung nomor awal pada halaman saat ini
    @endphp

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">List Pengguna</h5>
            <div class="d-flex ">
                <a href="/users/create" class="btn btn-dark btn-sm me-2">Tambah Pengguna</a>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengguna</th>
                        <th>Kelas</th>
                        <th>NISN</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $item)
                        <tr>
                            <td><strong>{{ $startingNumber++ }}</strong></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->class }}</td>
                            <tPd>{{ $item->nisn }}</tPd>
                            <td rowspan="1" colspan="1">

                                <form action="/users/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    <a href="/activation/{{ $item->id }}" class="btn btn-primary btn-sm">Aktifkan</a>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <td colspan="5">
                            <p class="text-center text-danger">No Data</p>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($data->links()->paginator->hasPages())
            <div class="mt-4 p-4 box has-text-centered">
                {{ $data->links() }}
            </div>
        @endif
    </div>

    @if (Session::get('status') == 'success')
        <div class="bs-toast toast fade show bg-success position-fixed bottom-0 end-0 m-3" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Berhasil</div>
                <small>Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('message') }}
            </div>
        </div>
    @endif

    <style>
        @media (max-width: 767px) {
            .bs-toast {
                max-width: 200px;
                font-size: 12px;
            }
        }
    </style>

@endsection
