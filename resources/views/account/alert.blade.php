@extends('layouts.second')
@section('title', 'Aturan Pinjam')
@section('content')
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
              <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                  <div class="card-body">
                    <h5 class="mb-4">Dengan Meminjam Buku <span class="text-primary">{{ $data->title }}</span> Maka
                        Kamu Setuju:</h5>
                    <p class="mb-4">
                        
                        <ol class=" mb-4">

                            <li>Menjaga Kondisi Buku</li>
                            <li>Mengembalikan Buku Kurang Dari 7 Hari Setelah Di Pinjam</li>
                            <li>Mengembalikan Buku Kepada Penjaga Perpus</li>
                            <li>Menjaga Kondisi Perpustakaan</li>
                            <li>Mengganti Buku Apabila Hilang</li>


                        </ol>

                        <p class="text-danger">Setelah Kamu Menyetujui, Maka Tunggu Hingga Status Peminjaman Berubah</p>
                        
                    </p>

                    <a href="/pinjam/buku/{{ $data->id }}/sekarang" class="btn btn-primary me-2">Setuju</a>
                    <a href="/" class="btn btn-danger me-2">Batalkan</a>
                  </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                  <div class="card-body pb-0 px-0 px-md-4">
                    <img src="{{ asset('sneat/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection
