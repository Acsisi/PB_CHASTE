@extends('layouts.appTenant', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Add Menu</h6>
                        <form action="{{ route('insertmenu') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Insert Food Picture</label>
                                <input class="form-control" type="file" id="formFile" name="foto">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" id="" name="nama">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input class="form-control" type="text" id="" name="harga">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="makanan" value="makanan" checked>
                                    <label class="form-check-label" for="makanan">
                                        Makanan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="minuman" value="minuman">
                                    <label class="form-check-label" for="minuman">
                                        Minuman
                                    </label>
                                </div>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="deskripsi"></textarea>
                                <label for="floatingTextarea2">Description</label>
                            </div>
                            <div class="mb-3 my-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>List Food</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Foto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Harga</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Deskripsi</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-secondary opacity-7">Edit</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @foreach($menus as $menu)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/' . $menu->foto) }}" alt="Menu Image" width="50" height="50">
                                                </td>
                                                <td>{{ $menu->nama }}</td>
                                                <td>Rp {{ number_format($menu->harga , 0, ',', '.');}}</td>
                                                <td>{{ $menu->deskripsi }}</td>
                                                <td>
                                                    @if ($menu->status == 1)
                                                        <form action="{{ route('updateStatus.menu', ['id' => $menu->menu_id]) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="status" value="0"> 
                                                            <button class="btn btn-danger" type="submit">Nonaktif</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('updateStatus.menu', ['id' => $menu->menu_id]) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="status" value="1">
                                                            <button class="btn btn-primary" type="submit">Aktif</button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td class="text-secondary opacity-7">
                                                    <form action="{{ route('edit.menu', ['id' => $menu->menu_id]) }}" method="get">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-warning">Edit</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection