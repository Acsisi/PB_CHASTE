@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Role'])
    @php
        use App\Models\User;
        $userId = request()->query('user_id');
        $User = User::where('user_id', $userId)->get();
    @endphp
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h1></h1>
                        <h6>Edit Role</h6>
                        @foreach ($User as $key=>$isi)
                        <form action="{{ route('edit-role') }}" method="post">
                        @csrf
                            <input type="hidden" name="id" id="" class="form-control" value="{{ $isi->user_id }}">
                            @if($isi->role == 2)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadio" id="radioOption1" value="2" checked>
                                <label class="form-check-label" for="radioOption1">
                                    Penyewa Tenant
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadio" id="radioOption2" value="3">
                                <label class="form-check-label" for="radioOption2">
                                    Penyewa Kamar
                                </label>
                            </div>
                            @else
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadio" id="radioOption1" value="2" >
                                <label class="form-check-label" for="radioOption1">
                                    Penyewa Tenant
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadio" id="radioOption2" value="3" checked>
                                <label class="form-check-label" for="radioOption2">
                                    Penyewa Kamar
                                </label>
                            </div>
                            @endif
                            <div class="mb-3 my-3">
                                <button class="btn btn-primary">Save Changes</button>
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