@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    @include('layouts.navbars.auth.topnav', ['title' => 'Laporan'])

    @php
        $months = [
            '01' => 'Januari', 
            '02' => 'Februari', 
            '03' => 'Maret', 
            '04' => 'April', 
            '05' => 'Mei', 
            '06' => 'Juni', 
            '07' => 'Juli', 
            '08' => 'Agustus', 
            '09' => 'September', 
            '10' => 'Oktober', 
            '11' => 'November', 
            '12' => 'Desember'
        ];

        $currentMonthAngka = date('m');
        $currentYear = date('Y');
    @endphp
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
                                            $monthNames = [
                                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                            ];

                                            $currentMonthAngka = date('n');
                                            $currentMonthHuruf = $monthNames[$currentMonthAngka - 1]; // Adjust index
                                            $currentYear = date('Y');
                                            $totalPengeluaran = H_Bulan::where('status', 0)
                                                ->whereMonth('created_at', $currentMonthAngka)
                                                ->whereYear('created_at', $currentYear)
                                                ->sum('total');
                                        @endphp
                                        <h6 class="text-center mb-0">Pengeluaran</h6>
                                        <span class="text-xs">bulan {{ $currentMonthHuruf." ".$currentYear }}</span>
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
                                            use App\Models\H_Galon;
                                            $totalPemasukanHKamar = H_Kamar::whereMonth('created_at', $currentMonthAngka)
                                            ->whereYear('created_at', $currentYear)
                                            ->sum('total');
                                            $totalPemasukanGalon = H_Galon::whereMonth('created_at', $currentMonthAngka)
                                            ->whereYear('created_at', $currentYear)
                                            ->sum('harga');
                                        @endphp
                                        <h6 class="text-center mb-0">Pemasukan</h6>
                                        <span class="text-xs">bulan {{ $currentMonthHuruf." ".$currentYear }}</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">Rp{{ number_format($totalPemasukanHKamar+$totalPemasukanGalon, 0, ',', '.') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card" id="pdf">
                    <div class="card-header">
                        <h5 class="card-title">Nota Pemasukan dan Pengeluaran Bulan {{ $currentMonthHuruf." ".$currentYear }}</h5>
                    </div>
                    <div class="card-body">
                        <h6 align="center">Pengeluaran</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $pengeluaranInvoices = H_Bulan::where('status', 0)
                                        ->whereMonth('created_at', $currentMonthAngka)
                                        ->whereYear('created_at', $currentYear)
                                        ->get();
                                    @endphp
                                    @foreach ($pengeluaranInvoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->created_at }}</td>
                                            <td>Rp{{ number_format($invoice->total, 0, ',', '.') }}</td>
                                            <td>{{ $invoice->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <h6 align="center">Pemasukan</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $pemasukanInvoices = H_Kamar::whereMonth('created_at', $currentMonthAngka)
                                            ->whereYear('created_at', $currentYear)
                                            ->get();
                                        $pemasukanInvoices = $pemasukanInvoices->merge(H_Galon::whereMonth('created_at', $currentMonthAngka)
                                            ->whereYear('created_at', $currentYear)
                                            ->get());
                                    @endphp
                                    @foreach ($pemasukanInvoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->created_at }}</td>
                                            <td>Rp{{ number_format($invoice->total ?? $invoice->harga, 0, ',', '.') }}</td>
                                            <td>
                                                @if($invoice->harga==20000)
                                                Beli galon
                                                @else
                                                Sewa kamar Kos
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="justify-between align-items-center mt-4">
                            <p class="mb-0"><b>Profit bulan ini: {{ ($totalPemasukanHKamar + $totalPemasukanGalon) - $totalPengeluaran }}</b></p><br>
                            <button class="btn btn-primary ml-auto" id="btn-pdf-print" onclick="generatePDF()">Unduh Nota</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
<script type="text/javascript"> 
    function generatePDF() {
        const btnPdfPrint = document.getElementById('btn-pdf-print');
        btnPdfPrint.style.visibility = 'hidden';

        const x = document.documentElement.clientWidth-300;
        const y = document.documentElement.clientHeight-210;

        setTimeout(function() {
            const { jsPDF } = window.jspdf;

            let doc = new jsPDF('p', 'px', [x, y]);
            let pdfjs = document.querySelector('#pdf');

            doc.html(pdfjs, {
                callback: function(doc) {
                    doc.save("invoice.pdf");
                    btnPdfPrint.style.visibility = 'visible';
                }
            });   
        }, 100);
    }               
</script>  
