@extends('layouts.appTenant', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Report'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Laporan Laba Rugi</h6>
                        <form action="{{ route('showReportTenant') }}" method="get">
                            @csrf
                            <div class="form-group">
                                <label for="bulan">Bulan</label>
                                <select class="form-control" id="bulan" name="bulan">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                            {{ date("F", mktime(0, 0, 0, $i, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <select class="form-control" id="tahun" name="tahun">
                                    @for ($i = 2023; $i <= 2030; $i++)
                                        <option value="{{ $i }}" {{ $i == $tahun ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                        @if (!empty($bulan) && !empty($tahun))
                            <br>
                            <h5 style="color: red">Pengeluaran</h5>
                            <form action="{{ route('pengeluaran.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                                </div>
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <input type="number" class="form-control" id="nominal" name="nominal" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah Pengeluaran</button>
                            </form>
                            <table id="pengeluaranTable" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th style="color: red">No</th>
                                        <th style="color: red">Keterangan</th>
                                        <th style="color: red">Nominal Pengeluaran</th>
                                        <th style="color: red">Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $counter = 1;
                                @endphp
                                <tbody>                               
                                    @foreach($pengeluaran as $item)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="{{ route('pengeluaran.edit', ['id' => $item->h_bulan_id]) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-secondary">Edit</button>
                                                </form>
                                                <form action="{{ route('pengeluaran.delete', ['id' => $item->h_bulan_id]) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <span style="color: red">Total Pengeluaran: Rp {{ number_format($result['totalPengeluaran'],0,',','.') }}</span>
                            <br>
                            <br>
                            <h5 style="color: green">Pendapatan</h5>
                            <table id="pendapatanTable" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th style="color: green">No</th>
                                        <th style="color: green">Tanggal</th>
                                        <th style="color: green">Total Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach($pendapatan as $p)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                                            <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <span style="color: green">Total Pendapatan: Rp {{ number_format($result['totalPendapatan'],0,',','.') }}</span>
                            <br>
                            <br>
                            <br>
                            <h5 style="color: red">
                                @if ($result['totalKerugian'] > 0)
                                    Total Kerugian: Rp {{ number_format($result['totalKerugian'], 0, ',', '.') }}
                                @else
                                    Total Kerugian: Rp 0
                                @endif
                            </h5>
                            <br>
                            <h5 style="color: green">
                                @if ($result['totalKeuntungan'] > 0)
                                    Total Keuntungan: Rp {{ number_format($result['totalKeuntungan'], 0, ',', '.') }}
                                @else
                                    Total Keuntungan: Rp 0
                                @endif
                            </h5>
                        </div>
                    @else
                        <h5 style="color: green">Belum ada data</h5>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
