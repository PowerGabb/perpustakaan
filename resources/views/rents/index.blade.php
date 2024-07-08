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
                <div class="card-header">
                    <h3>Riwayat Peminjaman</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Peminjam</th>
                                    <th>Buku <i class="bx bx-filter"></i></th>
                                    <th>Status <i class="bx bx-filter"></i></th>
                                    <th>Tgl Pinjam <i class="bx bx-filter"></i></th>
                                    <th>Tgl Kembali <i class="bx bx-filter"></i></th>
                                    <th>Denda Terlambat <i class="bx bx-filter"></i></th>
                                    <th>Tgl Wajib Kembali <i class="bx bx-filter"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="/users/{{ $item->user->id }}">{{ $item->user->name }}</a></td>
                                        <td>{{ $item->book->title }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->rent_at }}</td>
                                        <td>{{ $item->return_at }}</td>
                                        <td class="text-danger font-weight-bold text-center">{{ $item->denda }}</td>
                                        <td>{{ $item->rent_time_limit }}</td>
                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <p class="text-center text-danger">No Data</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

