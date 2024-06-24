@extends('layouts.main')
@section('title', 'Pengguna')
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
                <div class="card-header">
                    <h3>List Pengguna</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered">
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
                                @foreach ($data as $item)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->class }}</td>
                                    <td>{{ $item->nisn }}</td>
                                    <td rowspan="1" colspan="1">
                                        <form action="/users/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            <a href="/users/{{ $item->id }}" class="btn btn-primary btn-sm">Show Detail</a>
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
