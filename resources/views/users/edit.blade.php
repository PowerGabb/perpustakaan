@extends('layouts.main')
@section('title', 'Edit Pengguna')
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Edit Profile</h5>
        <!-- Account -->
        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img src="{{ asset('sneat/img/avatars/1.png') }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
          </div>
        </div>
        <hr class="my-0">
        <div class="card-body">
          <form id="formAccountSettings" method="POST" action="/users/{{ $user->id }}">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="firstName" class="form-label">Nama Lengkap</label>
                <input class="form-control" type="text" id="firstName" name="name" value="{{$user->name}}">
              </div>
              <div class="mb-3 col-md-6">
                <label for="lastName" class="form-label">Email</label>
                <input class="form-control" type="text" name="email" id="lastName" value="{{$user->email}}">
              </div>
              <div class="mb-3 col-md-12">
                <label for="email" class="form-label">NISN</label>
                <input class="form-control" type="text" id="email" name="nisn" value="{{$user->nisn}}">
              </div>
              <div class="mb-3 col-md-12">
                <label for="organization" class="form-label">Kelas</label>
                <select name="class" id="" class="form-select" value="{{$user->class}}">
                    <option value="10 RPL 1">10 RPL 1</option>
                    <option value="10 RPL 2">10 RPL 2</option>
                    <option value="11 RPL 1">11 RPL 1</option>
                    <option value="11 RPL 2">11 RPL 2</option>
                    <option value="12 RPL 1">12 RPL 1</option>
                    <option value="12 RPL 2">12 RPL 2</option>
                    <option value="10 TKJ 1">10 TKJ 1</option>
                    <option value="11 TKJ 1">11 TKJ 1</option>
                    <option value="12 TKJ 1">12 TKJ 1</option>
                    <option value="10 OTKP 1">10 OTKP 1</option>
                    <option value="11 OTKP 1">11 OTKP 1</option>
                    <option value="12 OTKP 1">12 OTKP 1</option>
                </select>
              </div>
              
            </div>
            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2">Save changes</button>
              <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
          </form>
        </div>
        <!-- /Account -->
      </div>
      
    </div>
  </div>
@endsection
