@extends('layouts.appTenant', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Menu'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Menu</h6>
                        <form action="{{ route('update.menu', ['id' => $menu->menu_id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Insert Food Picture</label>
                                <input class="form-control" type="file" id="formFile" name="foto">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" name="nama" value="{{ $menu->nama }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input class="form-control" type="text" name="harga" value="{{ $menu->harga }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="makanan" value="makanan" {{ $menu->kategori == 'makanan' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="makanan">
                                        Makanan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="minuman" value="minuman" {{ $menu->kategori == 'minuman' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="minuman">
                                        Minuman
                                    </label>
                                </div>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="deskripsi">{{ $menu->deskripsi }}</textarea>
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
        @include('layouts.footers.auth.footer')
    </div>
@endsection