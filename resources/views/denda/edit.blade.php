@extends('layouts.main')

@section('title', 'Denda')
@section('content')
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Tambah Kategori</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form action="/denda/{{ $data->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nominal Denda {{ $data->role }}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="basic-default-name" name="nominal" value="{{ $data->nominal }}">
                            @error('nominal')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
