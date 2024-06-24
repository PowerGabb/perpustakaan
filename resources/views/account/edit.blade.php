@extends('layouts.second')
@section('title', 'Account')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <form action="/profile" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if ($profile->avatar)
                                    <img src="{{ asset('storage/photo/'.$profile->avatar) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                @else
                                    <img src="{{ asset('sneat/img/avatars/1.png') }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                @endif
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" name="photo" class="account-file-input" hidden/>
                                    </label>
                                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>
                                    <p class="text-muted mb-0">Hanya di perbolehkan mengupload gambar dengan ukuran 5MB</p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <form id="formAccountSettings" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">Nama Lengkap</label>
                                        <input class="form-control" type="text" id="firstName" name="name" value="{{ $profile->name }}" autofocus />
                                        @error('name')
                                            <p class="text-danger pt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="lastName" class="form-label">NISN</label>
                                        <input class="form-control" type="text" name="nisn" id="nisn" value="{{ $profile->nisn }}" />
                                        @error('nisn')
                                            <p class="text-danger pt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-lg-12">
                                        <label for="currency" class="form-label">Kelas</label>
                                        <input type="text" class="form-control" name="class" value="{{ $profile->class }}">
                                        @error('class')
                                            <p class="text-danger pt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email" value="{{ $profile->email }}" placeholder="john.doe@example.com" />
                                        @error('email')
                                            <p class="text-danger pt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="organization" class="form-label">Status</label>
                                        @if (Auth::user()->role == 'admin')
                                            <input type="text" class="form-control" id="organization" name="role" value="{{ $profile->role }}">
                                        @else
                                        <select name="role" id="" class="form-control" value="{{ $profile->role }}">
                                            <option value="siswa">Siswa</option>
                                            <option value="guru">Guru</option>
                                            <option value="anggota">Anggota</option>
                                        </select>
                                        @endif
                                        @error('role')
                                            <p class="text-danger pt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="phoneNumber">Nomor Telepon</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">ID (+62)</span>
                                            <input type="text" id="phoneNumber" name="phone" class="form-control" value="{{ $profile->phone }}" />
                                        </div>
                                        @error('phone')
                                            <p class="text-danger pt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="address" class="form-label">Alamat</label>
                                        <textarea name="address" class="form-control" id="address" cols="30" rows="10" value="{{ $profile->address }}">{{ $profile->address }}</textarea>
                                        @error('address')
                                            <p class="text-danger pt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                    <a class="btn btn-outline-danger" href="/profile">Batalkan</a>
                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            document.getElementById('upload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('uploadedAvatar').src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endsection
@endsection


@if (session()->has('error'))
    <div class="bs-toast toast fade show bg-danger position-fixed bottom-0 end-0 m-3" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Gagal</div>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('error') }}
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