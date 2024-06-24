@extends('layouts.main')
@section('content')
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Kembalikan Buku</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form action="/rents-back" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="user">User dan buku yang dipinjam</label>
                        <div class="col-sm-10">
                            <select class="users form-control" name="id">
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->user->name }} - {{ $item->book->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>

@endsection
