@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Laporan Keuangan'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12"">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Expense Information</h6>
                    </div>
                    @php
                        use App\Models\H_Bulan;
                        use App\Models\User;
                        $listPengeluaran = H_Bulan::where('status', 0)->get();
                        $listUser= User::where('role', 2)->get();
                        $listPenyewaKost= User::where('role', 3)->get();
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
                                        <button class="btn btn-primary"><a href="/pengeluaranOwner/edit/{{$d->h_bulan_id}}" style="text-decoration: none;color: inherit;">Edit</a></button>
                                        <button style="background-color: red;" class="btn btn-primary"><a href="/pengeluaranOwner/delete/{{$d->h_bulan_id}}" style="text-decoration: none;color: inherit;">Delete</a></button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h1></h1>
                        <h6>Add Income</h6>
                        <form action="{{ route('add-income') }}" method="post">
                        @csrf
                            <div class="mb-3">
                                <label class="form-label">Total Payment</label>
                                <input class="form-control" type="number" id="" name="total">
                            </div>
                            <!-- <div class="mb-3">
                                <label>Date</label>
                                <input  class="form-control" type="date" name="date" id="">
                            </div> -->
                            <div class="mb-3 my-3 d-flex">
                                <label class="form-label">Source</label>&nbsp;&nbsp;
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
                                <label class="form-label">Kost Owner</label>
                                <select class="form-select" aria-label="Default select example" name="penyewa">
                                    <option>Select kost owner</option>
                                    @foreach ($listPenyewaKost as $key=>$isi)
                                    <option value="{{$isi->user_id}}">{{$isi->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 my-3">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h1></h1>
                        <h6>Add Expense</h6>
                        <form action="{{ route('add-expense') }}" method="post">
                        @csrf
                            <div class="mb-3">
                                <label class="form-label">Total Payment</label>
                                <input class="form-control" type="number" id="" name="total">
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="desc"></textarea>
                                <label for="floatingTextarea2">Description</label>
                            </div>
                            <div class="mb-3 my-3">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Income from kost</h6>
                    </div>
                    @php
                        use App\Models\H_Kamar;
                        $listSewaKamar= H_Kamar::get();
                    @endphp
                    <div class="card-body pt-4 p-3" style="height: 300px; overflow-y: auto;">
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
                                        <span class="mb-2 text-xs">Total Payment: <span
                                                class="text-dark font-weight-bold ms-sm-2">Rp{{ number_format($d->total, 0, ',', '.') }}</span></span>
                                        <span class="mb-2 text-xs">Date: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $date }}</span></span>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('input[name="exampleRadio"]').change(function() {
                    if ($(this).val() == "2") {
                        $('#kostOwnerSelect').hide();
                        $('#tenantOwnerSelect').show();
                    } else {
                        $('#tenantOwnerSelect').hide();
                        $('#kostOwnerSelect').show();
                    }
                });
            });
        </script>
        @include('layouts.footers.auth.footer')
    </div>
@endsection