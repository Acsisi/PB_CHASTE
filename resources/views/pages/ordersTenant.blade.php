@extends('layouts.appTenant', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Orders'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>List Pesanan</h6>
                        <form action="{{ route('orders.filter') }}" method="post" class="form-inline">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="tanggal" class="sr-only">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Filter Tanggal</button>
                        </form>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" align="center">Id Pesanan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" align="center">Nama Pemesan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" align="center">Pesanan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" align="center">Total Transaksi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" align="center">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" align="center">Terima atau Tolak Pesanan</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{ $order->h_menu_id }}</td>
                                                <td>{{ $order->dimiliki_customer->nama }}</td>
                                                <td>@foreach($order->memiliki_d_menu as $dMenu)
                                                    {{ $dMenu->qty }}{{ $dMenu->dimiliki_menu->nama }}<br>
                                                @endforeach</td>
                                                <td>Rp {{ number_format($order->total , 0, ',', '.')}}</td>
                                                <td>
                                                    @if($order->status == 2)
                                                        Pesanan diterima
                                                    @elseif($order->status == 1)
                                                        Pesanan menunggu respons penjual
                                                    @elseif($order->status == 0)
                                                        Pesanan ditolak
                                                    @else
                                                        {{ $order->status }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($order->status == 2 || $order->status == 0)
                                                    @else
                                                        <form action="{{ route('orders.terima', ['id' => $order->h_menu_id]) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">Terima</button>
                                                        </form>
                                                    
                                                        <form action="{{ route('orders.tolak', ['id' => $order->h_menu_id]) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection