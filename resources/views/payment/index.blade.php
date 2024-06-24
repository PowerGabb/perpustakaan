@extends('layouts.second')
@section('title', 'Perpustakaan | Payment')
@section('content')

    <div class="container contents">
        <div class="card">
            <div class="card-header">
                <h1>Pembayaran denda</h1>
            </div>
            <div class="card-body">
                <h3>Pembayaran denda terkait peminjaman buku <span class="text-primary">{{ $denda->book->title }}</span></h3>
                <p>Pada tanggal peminjaman: {{ $denda->rent_at }}</p>
                <p>Pada tanggal pengembalian: {{ $denda->return_at }} yang seharusnya {{ $denda->rent_time_limit }}</p>
                <p>Jumlah denda: <span class="text-danger">{{ $denda->denda }}</span></p>
            </div>
            <div class="card-footer">
                <button id="pay-button" class="btn btn-primary">Pay!</button>
            </div>
        </div>


        <!-- Form untuk mengirim data ke URL /return-fine/{id} -->
        <form id="return-fine-form" method="POST" action="/return-fine/{{ $denda->id }}">
            @csrf <!-- Tambahkan CSRF token untuk keamanan -->
        </form>
    </div>

    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-UsBW-ngFge4NmunQ"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    // Menambahkan informasi pembayaran ke dalam form untuk dikirim
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/return-fine/{{ $denda->id }}';

                    // Menambahkan ID pembayaran sebagai input tersembunyi
                    var paymentIdField = document.createElement('input');
                    paymentIdField.type = 'hidden';
                    paymentIdField.name = 'payment_id';
                    paymentIdField.value = result
                    .transaction_id; // Menggantinya dengan ID pembayaran dari Midtrans

                    // Menambahkan status pembayaran sebagai input tersembunyi
                    var paymentStatusField = document.createElement('input');
                    paymentStatusField.type = 'hidden';
                    paymentStatusField.name = 'payment_status';
                    paymentStatusField.value = result
                    .transaction_status; // Menggantinya dengan status pembayaran dari Midtrans

                    // Menambahkan CSRF token
                    var csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';

                    // Menambahkan semua input ke dalam form
                    form.appendChild(paymentIdField);
                    form.appendChild(paymentStatusField);
                    form.appendChild(csrfField);

                    // Menambahkan form ke dalam body
                    document.body.appendChild(form);

                    // Mengirim form
                    form.submit();
                },

                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
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
