@extends('layouts.main')
@section('title', 'Detail Pengguna')
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img src="{{ asset('sneat/img/avatars/1.png') }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
          </div>
        </div>
        <hr class="my-0">
        <div class="card-body">
          <form id="formAccountSettings" method="POST" onsubmit="return false">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="firstName" class="form-label">Nama Lengkap</label>
                <input class="form-control" type="text" id="firstName" name="firstName"  placeholder="{{$user->name}}" readonly>
              </div>
              <div class="mb-3 col-md-6">
                <label for="lastName" class="form-label">Email</label>
                <input class="form-control" type="text" name="lastName" id="lastName"  placeholder="{{$user->email}}" readonly> 
              </div>
              <div class="mb-3 col-md-12">
                <label for="email" class="form-label">NISN</label>
                <input class="form-control" type="text" id="email" name="email"  placeholder="{{$user->nisn}}" readonly>
              </div>
              <div class="mb-3 col-md-12">
                <label for="organization" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="organization" name="organization"  placeholder="{{$user->class}}" readonly>
              </div>
              
            </div>
            <div class="mt-2">
              <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary me-2">Edit Users</a>
              <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
          </form>
        </div>
        <!-- /Account -->
      </div>
      
    </div>
  </div>
@endsection