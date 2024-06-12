@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Kos'])
    @php
        use App\Models\Kamar;
        $KosId = request()->query('kamar_id');
        $Kos = Kamar::where('kamar_id', $KosId)->get();
        
    @endphp
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h1></h1>
                        <h6>Edit Kos</h6>
                        @foreach ($Kos as $key=>$isi)
                        <form action="{{ route('edit-kos') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="id" id="" class="form-control" value="{{ $isi->kamar_id }}">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Masukkan gambar kamar 1</label>
                                <input class="form-control" type="file" id="formFile" name="photo[]">
                            </div>
                            <div class="mb-3">
                                <label for="formFile2" class="form-label">Masukkan gambar kamar 2 (boleh kosong)</label>
                                <input class="form-control" type="file" id="formFile2" name="photo2[]">
                            </div>
                            <div class="mb-3">
                                <label for="formFile3" class="form-label">Masukkan gambar kamar 3 (boleh kosong)</label>
                                <input class="form-control" type="file" id="formFile3" name="photo3[]">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input class="form-control" type="text" id="" name="name" value="{{ $isi->nama }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input class="form-control" type="text" id="" name="price" value="{{ $isi->harga }}">
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a description here" name="desc" id="floatingTextarea2" style="height: 100px" value="">{{ $isi->deskripsi }}</textarea>
                                <label for="floatingTextarea2">Deskripsi</label>
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
                                <button class="btn btn-primary">Simpan Perubahan</button>
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