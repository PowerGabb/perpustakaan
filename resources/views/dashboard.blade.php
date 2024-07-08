@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
    <div class="mb-3">
        <H1>Selamat Datang Di Dashboard, <span class="text-primary">{{ Auth::user()->name }}</span></H1>


    </div>
    <div class="col-lg-12  order-1">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-book rounded text-primary"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="/books">Selengkapnya</a>

                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Jumlah Buku</span>
                        <h3 class="card-title mb-2">{{ $books }}</h3>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-category-alt rounded text-primary"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="/categories">Selengkapnya</a>

                                </div>
                            </div>
                        </div>
                        <span>Jumlah Kategori</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $kategori }}</h3>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-user rounded text-primary "></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="/users">Selengkapnya</a>

                                </div>
                            </div>
                        </div>
                        <span>Jumlah Peminjaman</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $rents }}</h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">Data Peminjaman Terbaru</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Buku</th>
                <th>Status</th>
                <th>Tanggal Pinjam</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($data as $item)
                <tr>
                    <td  rowspan="1" colspan="1" class="text-center">{{$loop->iteration}}</td>
                    <td rowspan="1" colspan="1">{{ $item->user->name }}</td>
                    <td rowspan="1" colspan="1">{{ $item->user->class }}</td>
                    <td rowspan="1" colspan="1">{{ $item->book->title }}</td>
                    <td rowspan="1" colspan="1">{{ $item->status }}</td>
                    <td rowspan="1" colspan="1">{{ $item->rent_at }}</td>
                    <td rowspan="1" colspan="1">
                        @if ($item->status == 'waiting')
                        <form action="/rents/{{ $item->id }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                            <a href="/rents/{{ $item->id }}/accept" type="submit" class="btn btn-primary btn-sm">Izinkan</a>
                        </form>
                        @elseif ($item->status == 'dipinjam')
                            <form action="/rents-back" method="POST">
                                @csrf

                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-primary btn-sm">Kembalikan</button>
                            </form>
                        @else
                            <p class="text-success">Selesai</p>
                        @endif
                    </td>
                </tr>
                @empty
                    <td rowspan="1" colspan="3"><p class="text-center text-danger">No Data</p></td>
                @endforelse
            </tbody>
          </table>
        </div>
      </div>



@endsection
