@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Kamar Kos'])
    <div class="container-fluid py-4">
    <div class="row">
            <div class="col-7">
                <div class="card mb-4">
                    @php
                        use App\Models\Kamar;
                        $listKamar = Kamar::where('status', '!=', 0)->get();
                    @endphp
                    <div class="card-header pb-0">
                        <h6>List Kamar</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2"  style="height: 530px; overflow-y: auto;">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Price</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listKamar as $key=>$d)
                                    @if ($d->status == 1)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ Storage::url("$d->foto") }}" class="avatar avatar-lg me-3"
                                                        alt="kamar1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $d->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-m font-weight-bold mb-0">Rp{{ number_format($d->harga, 0, ',', '.') }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">Available</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button class="btn btn-primary"><a href="/kos/edit/{{$d->kamar_id}}" style="text-decoration: none;color: inherit;">Edit</a></button>
                                        </td>
                                        <td class="align-middle">
                                            <button style="background-color: red;" class="btn btn-primary"><a href="/kos/delete/{{$d->kamar_id}}" style="text-decoration: none;color: inherit;">Delete</a></button>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ Storage::url("$d->foto") }}" class="avatar avatar-lg me-3"
                                                        alt="kamar1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $d->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-m font-weight-bold mb-0">Rp{{ number_format($d->harga, 0, ',', '.') }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-secondary">Unavailable</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button class="btn btn-primary"><a href="/kos/edit/{{$d->kamar_id}}" style="text-decoration: none;color: inherit;">Edit</a></button>
                                        </td>
                                        <td class="align-middle">
                                            <button style="background-color: red;" class="btn btn-primary"><a href="/kos/delete/{{$d->kamar_id}}" style="text-decoration: none;color: inherit;">Delete</a></button>
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
            <div class="col-5">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Add Kamar Kos</h6>
                        <form action="{{ route('add-kos') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Insert Room Picture</label>
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
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadio" id="radioOption1" value="AC" checked>
                                <label class="form-check-label" for="radioOption1">
                                    AC
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadio" id="radioOption2" value="Non-AC">
                                <label class="form-check-label" for="radioOption2">
                                    Non-AC
                                </label>
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
