@extends('layouts.appTenant', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Report'])

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Pengeluaran</div>

                    <div class="card-body">
                        <form action="{{ route('pengeluaran.update', ['id' => $pengeluaran->h_bulan_id]) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $pengeluaran->keterangan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="number" class="form-control" id="nominal" name="nominal" value="{{ $pengeluaran->total }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Pengeluaran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
