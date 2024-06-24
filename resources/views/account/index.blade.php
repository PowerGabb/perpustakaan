@extends('layouts.second')
@section('title', 'Account')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="">Informasi Akun</h5>
                    </div>
                    
                    
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if (auth()->user()->avatar)
                            <img src="{{ asset('storage/photo/'.auth()->user()->avatar)}}" alt="user-avatar" class="d-block rounded" height="100"
                            width="100" id="uploadedAvatar" />
                            @else
                            <img src="{{ asset('sneat/img/avatars/1.png')}}" alt="">
                            @endif

                            
                            
                        </div>
                        
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" onsubmit="return false">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Nama Lengkap</label>
                                    <input class="form-control" type="text" id="firstName" name="firstName"
                                        value="{{ $profile->name }}" autofocus disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">NISN</label>
                                    <input class="form-control" type="text" name="lastName" id="lastName"
                                        value="{{ $profile->nisn }}" disabled />
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="currency" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" value="{{ $profile->class }}" disabled>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $profile->email }}" placeholder="john.doe@example.com" disabled />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="organization" name="role"
                                        value="{{ $profile->role }}" disabled />
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="phoneNumber">Nomor Telepon</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">ID (+62)</span>
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                            placeholder="{{ $profile->phone }}" disabled />
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea name="address" class="form-control" id="" value="{{ $profile->address }}" cols="30"
                                        rows="10" disabled>{{ $profile->address}}</textarea>
                                </div>

                               
                            </div>
                            <div class="mt-2">
                                <a href="/profile/edit" class="btn btn-primary me-2">Edit Profile</a>
                                @if (auth()->user()->role == 'admin')
                                @else
                                <a href="/print-card" class="btn btn-outline-warning">Cetak Kartu Anggota</a>
                                @endif
                                
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection

