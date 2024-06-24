@extends('layouts.main')

@section('title', 'Denda')
@section('content')

    <div class="container contents">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Pengaturan Denda Harian Dan Nominal</h5>
                        <div class="d-flex ">
                            <form action="/denda/4" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="input-group">
                                    <input type="number" class="form-control" name="nominal" id="nominal" value="{{ $data[3]->nominal }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tipe Pengguna</th>
                                        <th>Jumlah Denda Harian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $item)
                                        @if ($key !== 3)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->role }}</td>
                                                <td>{{ $item->nominal }}</td>
                                                <td><a href="/denda/{{ $item->id }}/edit"
                                                        class="btn btn-primary btn-sm">Edit</a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

