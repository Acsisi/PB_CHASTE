@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Tenant'])
    @php
        use App\Models\Tenant;
        use App\Models\User;
        $tenantId = request()->query('tenant_id');
        $Tenant = Tenant::where('tenant_id', $tenantId)->get();
        $listUser= User::where('role', 2)->get();
    @endphp
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h1></h1>
                        <h6>Edit Tenant</h6>
                        @foreach ($Tenant as $key=>$isi)
                        <form action="{{ route('edit-tenant') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="id" id="" class="form-control" value="{{ $isi->tenant_id }}">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Insert Tenant Logo</label>
                                <input class="form-control" type="file" id="formFile" name="photo[]">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" id="" name="name" value="{{ $isi->nama }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input class="form-control" type="number" id="" name="price" value="{{ $isi->harga }}">
                            </div>
                            @if($isi->penyewa_id==NULL)
                            <div class="mb-3">
                                <label class="form-label">Tenant Owner</label>
                                <select class="form-select" aria-label="Default select example" name="penyewa">
                                    <option selected>Select tenant owner</option>
                                    @foreach ($listUser as $key=>$isi)
                                    <option value="{{$isi->user_id}}">{{$isi->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a description here" name="desc" id="floatingTextarea2" style="height: 100px" value="">{{ $isi->deskripsi }}</textarea>
                                <label for="floatingTextarea2">Description</label>
                            </div>
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