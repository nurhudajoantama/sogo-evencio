@extends('layouts.dashboard.main')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Transaction</h1>
<p class="mb-4">Page ini berisi mengenai transaksi yang dilakukan oleh user</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="col-lg-3">
            <form action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's username"
                        aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nomor Invoice</th>
                        <th>Nama Pemesan</th>
                        <th>Harga</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>Rp. {{ $transaction->total }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td>{{ $transaction->status->name }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#modalDetail{{ $transaction->id }}">
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
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="card-title">{{ $transaction->product?->name }}</h5>
                                            <h5 class="card-title">{{ $transaction->service?->name }}</h5>
                                            <h6 class="card-subtitle fs-2 mb-2 text-muted mb-3">Rp. {{
                                                $transaction->total }}
                                            </h6>
                                            <hr />
                                            <p class="fw-bold text-muted mb-1">Pembayaran</p>
                                            <p class="card-text m-0">{{ $transaction->payment->category->name }}
                                            </p>
                                            <p class="card-text m-0 mb-2">{{ $transaction->payment->name }}</p>
                                            <hr />
                                            <p class="fw-bold text-muted mb-1">Pengiriman</p>
                                            <p class="card-text m-0">{{ $transaction->destination_name }}</p>
                                            <p class="card-text m-0">{{ $transaction->destination_phone }}</p>
                                            <p class="card-text m-0">{{ $transaction->detail_destination }}</p>
                                            <p class="card-text m-0">{{ $transaction->shipment_method }}</p>
                                            <hr />
                                            <p class="fw-bold text-muted mb-1">Status</p>
                                            <p class="card-text m-0">{{ $transaction->status->name }}</p>
                                            @if ($transaction->payment_proof)
                                            <p>Sudah mengunggah bukti pembayaran. &nbsp;
                                                <a class="" href="{{ asset('storage/'.$transaction->payment_proof) }}"
                                                    alt="">
                                                    Lihat Bukti Pembayaran
                                                </a>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @switch($transaction->status_id)
                            @case(1)
                            @case(2)
                            <form class="d-inline"
                                action="{{ route('dashboard.transactions.updateStatus', $transaction) }}" method="post">
                                @csrf
                                <input type="hidden" name="status_id" value="3">
                                <button class="btn btn-success btn-sm">Accept</button>
                            </form>
                            @break
                            @case(3)
                            <form class="d-inline"
                                action="{{ route('dashboard.transactions.updateStatus', $transaction) }}" method="post">
                                @csrf
                                <input type="hidden" name="status_id" value="4">
                                <button class="btn btn-success btn-sm">Sent</button>
                            </form>
                            @break
                            @case(4)
                            <form class="d-inline"
                                action="{{ route('dashboard.transactions.updateStatus', $transaction) }}" method="post">
                                @csrf
                                <input type="hidden" name="status_id" value="6">
                                <button class="btn btn-success btn-sm">Success</button>
                            </form>
                            @break
                            @default
                            @endswitch
                            @if ($transaction->status_id != 6)
                            <form class="d-inline"
                                action="{{ route('dashboard.transactions.updateStatus', $transaction) }}" method="post">
                                @csrf
                                <input type="hidden" name="status_id" value="5">
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection