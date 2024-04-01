@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Report'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="fas fa-landmark opacity-10"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        @php
                                            use App\Models\H_Bulan;
                                            $currentMonthAngka = date('n');
                                            $currentMonthHuruf = date('F');
                                            $currentYear = date('Y');
                                            $totalPengeluaran = H_Bulan::where('status', 0)
                                            ->whereMonth('created_at', $currentMonthAngka)
                                            ->whereYear('created_at', $currentYear)
                                            ->sum('total');
                                        @endphp
                                        <h6 class="text-center mb-0">Expenses</h6>
                                        <span class="text-xs">for {{ $currentMonthHuruf." ".$currentYear }}</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-4">
                                <div class="card">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="fas fa-money-bill opacity-10"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        @php
                                            use App\Models\H_Kamar;
                                            $totalPemasukanHKamar = H_Kamar::whereMonth('created_at', $currentMonthAngka)
                                            ->whereYear('created_at', $currentYear)
                                            ->sum('total');
                                        @endphp
                                        <h6 class="text-center mb-0">Incomes</h6>
                                        <span class="text-xs">for {{ $currentMonthHuruf." ".$currentYear }}</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">Rp{{ number_format($totalPemasukanHKamar, 0, ',', '.') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
