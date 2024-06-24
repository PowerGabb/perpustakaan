@extends('layouts.second')
@section('title', 'Perpustakaan | Pinjamanku')
@section('content')
    <div class="container">
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
                        <h3>Pinjamanku</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Buku <i class="bx bx-filter"></i></th>
                                        <th>Status <i class="bx bx-filter"></i></th>
                                        <th>Tgl Pinjam <i class="bx bx-filter"></i></th>
                                        <th>Tgl Kembali <i class="bx bx-filter"></i></th>
                                        <th>Denda Terlambat <i class="bx bx-filter"></i></th>
                                        <th>Tgl Wajib Kembali <i class="bx bx-filter"></i></th>
                                        <th>Bayar Denda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->book->title }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->rent_at }}</td>
                                            <td>{{ $item->return_at }}</td>
                                            <td class="text-danger font-weight-bold text-center">{{ $item->denda }}</td>
                                            <td>{{ $item->rent_time_limit }}</td>
                                            <td>
                                                @if($item->denda > 0 && $item->status != 'denda dibayar')
                                                    <a href="/pay-fine/{{ $item->id }}" class="btn btn-primary">Bayar Denda</a>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="">
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
    </div>
@endsection

@if ($errors->any())
<div class="bs-toast toast fade show bg-success position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <i class="bx bx-bell me-2"></i>
      <div class="me-auto fw-semibold">Berhasil</div>
      <small>Now</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      {{$errors->first()}}
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
