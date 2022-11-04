@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Daftar Transaksi</h1>
    <div class="row mt-5">
        @foreach ($transactions as $transaction)
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $transaction->product?->name }}</h5>
                    <h5 class="card-title">{{ $transaction->service?->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted mb-3">Rp. {{ $transaction->total }}</h6>
                    <hr />
                    <p class="fw-bold text-muted mb-1">Pembayaran</p>
                    <p class="card-text m-0">{{ $transaction->payment->category->name }}</p>
                    <p class="card-text m-0 mb-2">{{ $transaction->payment->name }}</p>
                    <hr />
                    <p class="fw-bold text-muted mb-1">Pengiriman</p>
                    <p class="card-text m-0">{{ $transaction->destination_name }}</p>
                    <p class="card-text m-0">{{ $transaction->destination_phone }}</p>
                    <p class="card-text m-0">{{ $transaction->detail_destination }}</p>
                    <p class="card-text m-0">{{ $transaction->shipment_method }}</p>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                        data-bs-target="#modalDetail{{ $transaction->id }}">
                        Detail
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalDetail{{ $transaction->id }}" tabindex="-1"
                        aria-labelledby="modalDetail{{ $transaction->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalDetail{{ $transaction->id }}Label">
                                        Detail Transaksi
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="card-title">{{ $transaction->product?->name }}</h5>
                                    <h5 class="card-title">{{ $transaction->service?->name }}</h5>
                                    <h6 class="card-subtitle fs-2 mb-2 text-muted mb-3">Rp. {{ $transaction->total }}
                                    </h6>
                                    <hr />
                                    <p class="fw-bold text-muted mb-1">Pembayaran</p>
                                    <div class="d-flex">
                                        <img width="70px" src="{{ asset('storage/'.$transaction->payment->logo) }}"
                                            alt="{{ $transaction->payment->name }}">
                                        <div class="ms-3">
                                            <p class="card-text m-0">{{ $transaction->payment->category->name }}</p>
                                            <p class="card-text m-0 mb-2">{{ $transaction->payment->name }}</p>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex flex-column align-items-center">
                                        @switch($transaction->payment->category->name)
                                        @case('Bank')
                                        <span class="text-muted">Rekening. </span>
                                        <p class="card-text fw-bold fs-3 mx-auto my-0">
                                            {{ $transaction->payment->account_number }}
                                        </p>
                                        @break
                                        @case('E-Wallet')
                                        <span class="text-muted">Nomor Telepon. </span>
                                        <p class="card-text fw-bold fs-3 mx-auto my-0">
                                            {{ $transaction->payment->phone_number }}
                                        </p>
                                        @break
                                        @case('QR Code')
                                        <img width="350px" src="{{ asset('storage/'.$transaction->payment->qr_code) }}"
                                            alt="">
                                        @break
                                        @endswitch
                                        <span class="text-muted">Atas Nama. </span>
                                        <p class="card-text m-0 mb-2">
                                            {{ $transaction->payment->account_name }}
                                        </p>
                                    </div>
                                    <hr />
                                    <p class="fw-bold text-muted mb-1">Pengiriman</p>
                                    <p class="card-text m-0">{{ $transaction->destination_name }}</p>
                                    <p class="card-text m-0">{{ $transaction->destination_phone }}</p>
                                    <p class="card-text m-0">{{ $transaction->detail_destination }}</p>
                                    <p class="card-text m-0">{{ $transaction->shipment_method }}</p>
                                    <hr />
                                    <p class="fw-bold text-muted mb-1">Status</p>
                                    <p class="card-text m-0">{{ $transaction->status->name }}</p>
                                    <hr />
                                    <p class="fw-bold text-muted mb-1">Bukti Pembayaran</p>
                                    @if ($transaction->payment_proof)
                                    <p>Sudah mengunggah bukti pembayaran. &nbsp;
                                        <a class="" href="{{ asset('storage/'.$transaction->payment_proof) }}" alt="">
                                            Lihat Bukti Pembayaran
                                        </a>
                                    </p>
                                    @endif
                                    <form action="{{ route('uploadPaymentProof', $transaction->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="payment_proof" class="form-label">
                                                @if ($transaction->payment_proof)
                                                Ganti Bukti Pembayaran
                                                @else
                                                Upload bukti pembayaran
                                                @endif
                                            </label>
                                            <input class="form-control" type="file" id="payment_proof"
                                                name="payment_proof">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection