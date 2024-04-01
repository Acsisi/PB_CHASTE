@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tenant'])
    <div class="container-fluid py-4">
    <div class="row">
            <div class="col-8">
                <div class="card mb-4">
                    @php
                        use App\Models\Tenant;
                        $listTenant = Tenant::where('status', 1)->get();
                    @endphp
                    <div class="card-header pb-0">
                        <h6>List Tenant</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 " style="height: 460px; overflow-y: auto;">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Price</th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listTenant as $key=>$d)
                                    @if ($d->status == 1 && $d->penyewa_id == NULL)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ Storage::url("$d->foto") }}" class="avatar avatar-lg me-3"
                                                        alt="tenant1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $d->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-m font-weight-bold mb-0">
                                                Rp{{ number_format($d->harga, 0, ',', '.') }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">Available</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button class="btn btn-primary"><a href="/tenant/edit/{{$d->tenant_id}}" style="text-decoration: none;color: inherit;">Edit</a></button>
                                        </td>
                                        <td class="align-middle">
                                            <button style="background-color: red;" class="btn btn-primary"><a href="/tenant/delete/{{$d->tenant_id}}" style="text-decoration: none;color: inherit;">Delete</a></button>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ Storage::url("$d->foto") }}" class="avatar avatar-lg me-3"
                                                        alt="tenant1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $d->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-m font-weight-bold mb-0">
                                                Rp{{ number_format($d->harga, 0, ',', '.') }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-secondary">Unavailable</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button class="btn btn-primary"><a href="/tenant/edit/{{$d->tenant_id}}" style="text-decoration: none;color: inherit;">Edit</a></button>
                                        </td>
                                        <td class="align-middle">
                                            <button style="background-color: red;" class="btn btn-primary"><a href="/tenant/delete/{{$d->tenant_id}}" style="text-decoration: none;color: inherit;">Delete</a></button>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h1></h1>
                        <h6>Add Tenant</h6>
                        <form action="{{ route('add-tenant') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Insert Tenant Logo</label>
                                <input class="form-control" type="file" id="formFile" name="photo[]">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" id="" name="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input class="form-control" type="text" id="" name="price">
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a description here" name="desc" id="floatingTextarea2" style="height: 100px"></textarea>
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
        @include('layouts.footers.auth.footer')
    </div>
@endsection