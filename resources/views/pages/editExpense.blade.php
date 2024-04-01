@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Expense'])
    @php
        use App\Models\H_Bulan;
        $ExpenseId = request()->query('h_bulan_id');
        $Expense = H_Bulan::where('h_bulan_id', $ExpenseId)->get();
    @endphp
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h1></h1>
                        <h6>Edit Expense</h6>
                        @foreach ($Expense as $key=>$isi)
                        <form action="{{ route('editExpense') }}" method="post">
                        @csrf
                            <input type="hidden" name="id" id="" class="form-control" value="{{ $isi->h_bulan_id }}">
                            <div class="mb-3">
                                <label class="form-label">Total Payment</label>
                                <input class="form-control" type="number" id="" name="total" value="{{ $isi->total }}">
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="desc">{{ $isi->keterangan }}</textarea>
                                <label for="floatingTextarea2">Description</label>
                            </div>
                            <div class="mb-3 my-3">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection