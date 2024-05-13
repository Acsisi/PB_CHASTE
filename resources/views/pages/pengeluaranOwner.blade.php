@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Laporan Keuangan'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12"">
                <div class="card">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="pb-0 px-3">
                                <div>
                                    <h6 class="mb-0">Detail Pengeluaran</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <form method="GET" id="expenseForm">
                                @php
                                    $startDate = session('start_date', isset($_GET['start_date']) ? $_GET['start_date'] : null);
                                    $endDate = session('end_date', isset($_GET['end_date']) ? $_GET['end_date'] : null);
                                @endphp
                                <div class="pb-0 px-3 d-flex align-items-center">
                                    <input type="date" name="start_date" class="form-control" aria-label="Start Date" value="{{ $startDate }}"">
                                    <span class="fw-bold mx-2">sampai</span>
                                    <input type="date" name="end_date" class="form-control" aria-label="End Date" value="{{ $endDate }}"">
                                    <button type="submit" class="btn btn-primary mx-2 mt-3">Cari</button>
                                </div>
                            <!-- </form> -->
                        </div>

                    </div>
                </div>
                    @php
                        use App\Models\H_Bulan;
                        use App\Models\User;
                        
                        $listPengeluaran = H_Bulan::where('status', 0)
                            ->when($startDate && $endDate, function($query) use ($startDate, $endDate) {
                                return $query->whereBetween('updated_at', [$startDate, $endDate]);
                            })
                            ->get();
                        $totalSum = $listPengeluaran->sum('total');
                        $listUser= User::where('role', 2)->get();
                    @endphp
                    <div class="card-body pt-4 p-3 " style="height: 300px; overflow-y: auto;">
                        @foreach($listPengeluaran as $key=>$d)
                        @php
                            $timestamp = $d->updated_at;
                            $dateTime = new DateTime($timestamp);
                            $date = $dateTime->format("d-m-Y");
                        @endphp
                        <ul class="list-group">
                            <li class="list-group-item border-0 justify-content-between ps-0 mb-2 border-radius-lg">
                                <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ $date }}</h6>
                                <div class="d-flex">
                                    <div class="align-items-center text-sm">
                                        Rp{{ number_format($d->total, 0, ',', '.') }} <br> {{ $d->keterangan }}
                                    </div>
                                    <div class="ms-auto text-end">
                                        <button class="btn btn-primary"><a href="/pengeluaranOwner/edit/{{$d->h_bulan_id}}" style="text-decoration: none;color: inherit;">Ubah</a></button>
                                        <button style="background-color: red;" class="btn btn-primary"><a href="/pengeluaranOwner/delete/{{$d->h_bulan_id}}" style="text-decoration: none;color: inherit;">Hapus</a></button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                    <div class="pb-0 px-3">
                        <div>
                            <h6 class="mb-0">Total Pengeluaran : {{ $totalSum }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-between align-items-center">
            <div class="col-12">
                <div class="card">
                    <div class="pb-0 px-3 d-flex justify-content-between align-items-center">
                        <div class="pb-0 px-3">
                            <div>
                                <h6 class="mb-0">Pemasukan Kos</h6>
                            </div>
                        </div>
                        <!-- <form method="GET" id="incomeForm"> -->
                            @php
                                $tgl_mulai = session('tgl_mulai', isset($_GET['tgl_mulai']) ? $_GET['tgl_mulai'] : null);
                                $tgl_akhir = session('tgl_akhir', isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : null);
                            @endphp
                            <div class="pb-0 px-3 d-flex align-items-center">
                                <input type="date" name="tgl_mulai" class="form-control" aria-label="Start Date" value="{{ $tgl_mulai }}">
                                <span class="fw-bold mx-2">sampai</span>
                                <input type="date" name="tgl_akhir" class="form-control" aria-label="End Date" value="{{ $tgl_akhir }}">
                                <button type="submit" class="btn btn-primary mx-2 mt-3">Cari</button>
                            </div>
                        </form>
                    </div>
                    @php
                        use App\Models\H_Kamar;
                        use App\Models\H_Galon;

                        // Select data from both H_Kamar and H_Galon
                        $listSewaKamar = H_Kamar::when($tgl_mulai && $tgl_akhir, function($query) use ($tgl_mulai, $tgl_akhir) {
                            return $query->whereBetween('updated_at', [$tgl_mulai, $tgl_akhir]);
                        })
                        ->get();

                        $listSewaGalon = H_Galon::when($tgl_mulai && $tgl_akhir, function($query) use ($tgl_mulai, $tgl_akhir) {
                            return $query->whereBetween('updated_at', [$tgl_mulai, $tgl_akhir]);
                        })
                        ->get();

                        // Calculate the total sum for both H_Kamar and H_Galon
                        $totalSumKamar = $listSewaKamar->sum('total');
                        $totalSumGalon = $listSewaGalon->sum('harga');
                    @endphp
                    <div class="card-body pt-4 p-3" style="height: 300px; overflow-y: auto;">
                        <!-- Display data from H_Kamar -->
                        @foreach($listSewaKamar as $key=>$d)
                            @php
                                $listUser2= User::where('user_id', $d->penyewa_id)->get();
                                $timestamp = $d->updated_at;
                                $dateTime = new DateTime($timestamp);
                                $date = $dateTime->format("d-m-Y");
                            @endphp
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        @foreach($listUser2 as $key=>$a)
                                            <h6 class="mb-3 text-sm">{{ $a->username }}</h6>
                                        @endforeach
                                        <span class="mb-2 text-xs">Jumlah pembayaran: <span class="text-dark font-weight-bold ms-sm-2">Rp{{ number_format($d->total, 0, ',', '.') }}</span></span>
                                        <span class="mb-2 text-xs">Tanggal pembayaran: <span class="text-dark ms-sm-2 font-weight-bold">{{ $date }}</span></span>
                                        <span class="mb-2 text-xs">Tipe pembayaran:<span class="text-dark ms-sm-2 font-weight-bold"> uang sewa kos</span></span>
                                    </div>
                                </li>
                            </ul>
                        @endforeach

                        <!-- Display data from H_Galon -->
                        @foreach($listSewaGalon as $key=>$d)
                            @php
                                $listUser2= User::where('user_id', $d->penyewa_id)->get();
                                $timestamp = $d->updated_at;
                                $dateTime = new DateTime($timestamp);
                                $date = $dateTime->format("d-m-Y");
                            @endphp
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        @foreach($listUser2 as $key=>$a)
                                            <h6 class="mb-3 text-sm">{{ $a->username }}</h6>
                                        @endforeach
                                        <span class="mb-2 text-xs">Jumlah pembayaran: <span class="text-dark font-weight-bold ms-sm-2">Rp{{ number_format($d->harga, 0, ',', '.') }}</span></span>
                                        <span class="mb-2 text-xs">Tanggal pembayaran: <span class="text-dark ms-sm-2 font-weight-bold">{{ $date }}</span></span>
                                        <span class="mb-2 text-xs">Tipe pembayaran:<span class="text-dark ms-sm-2 font-weight-bold"> beli galon aqua</span></span>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                    <div class="pb-0 px-3">
                        <div>
                            <h6 class="mb-0">Total Pemasukan Kamar: {{ $totalSumKamar }}</h6>
                            <h6 class="mb-0">Total Pemasukan Galon: {{ $totalSumGalon }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-body pt-4 p-3 " style="height: 300px; overflow-y: auto;">
                            <h1></h1>
                            <h6>Tambah Pemasukan</h6>
                            <form action="{{ route('add-income') }}" method="post">
                            @csrf
                                <div class="mb-3">
                                    <label class="form-label">Jumlah pemasukan</label>
                                    <input class="form-control" type="number" id="txtPemasukan" name="total">
                                </div>
                                <!-- <div class="mb-3">
                                    <label>Date</label>
                                    <input  class="form-control" type="date" name="date" id="">
                                </div> -->
                                <div class="mb-3 my-3 d-flex">
                                    <label class="form-label">Hasil dari</label>&nbsp;&nbsp;
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" name="exampleRadio" id="radioOption1" value="1">
                                        <label class="form-check-label" for="radioOption1">
                                            Kamar Kost
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadio" id="radioOption2" value="2">
                                        <label class="form-check-label" for="radioOption2">
                                            Galon
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3" id="kostOwnerSelect" style="display: none;">
                                    <label class="form-label">Penyewa Kamar</label>
                                    <select class="form-select" aria-label="Default select example" name="penyewa">
                                        <option>Pilih penyewa</option>
                                        @php
                                        $listPenyewaKost= User::where('role', '3')->get();
                                        @endphp
                                        @foreach ($listPenyewaKost as $key=>$isi)
                                        <option value="{{$isi->user_id}}">{{$isi->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3" id="GalonSelect" style="display: none;">
                                    <label class="form-label">Pembeli dari kamar</label>
                                    <select class="form-select" aria-label="Default select example" name="penyewa2">
                                        <option>Pilih pembeli</option>
                                        @php
                                        $listPenyewaKost = User::where('role', '3')
                                        ->where('status_galon', '!=', 2)
                                        ->get();
                                        @endphp
                                        @foreach ($listPenyewaKost as $key=>$isi)
                                        <option value="{{$isi->user_id}}">{{$isi->nama}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <label class="form-label">Jumlah Galon</label>
                                    <input class="form-control" type="number" id="" name="pcs"> -->
                                </div>
                                <div class="mb-3 my-3">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h1></h1>
                        <h6>Tambah Pengeluaran</h6>
                        <form action="{{ route('add-expense') }}" method="post">
                        @csrf
                            <div class="mb-3">
                                <label class="form-label">Jumlah Pembayaran</label>
                                <input class="form-control" type="number" id="" name="total">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <select class="form-select" name="desc">
                                    <option value="gaji">gaji</option>
                                    <option value="listrik">listrik</option>
                                    <option value="PDAM">PDAM</option>
                                    <option value="restock galon">restock galon</option>
                                </select>
                            </div>
                            <div class="mb-3 my-3">
                                <button class="btn btn-primary">Tambah</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            $(document).ready(function() {
                $('input[name="exampleRadio"]').change(function() {
                    if ($(this).val() == "2") {
                        $('#kostOwnerSelect').hide();
                        $('#GalonSelect').show();

                        $('#txtPemasukan').prop('disabled', true);

                        // Change spinner value
                        $('#txtPemasukan').val('20000');
                    } else {
                        $('#GalonSelect').hide();
                        $('#kostOwnerSelect').show();

                        $('#txtPemasukan').prop('disabled', false);

                        // Change spinner value back to its original value
                        $('#txtPemasukan').val('0');
                    }
                });
            });
        </script>
        @include('layouts.footers.auth.footer')
    </div>
@endsection