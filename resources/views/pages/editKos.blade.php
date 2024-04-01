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
                                <label for="formFile" class="form-label">Insert Room Picture</label>
                                <input class="form-control" type="file" id="formFile" name="photo[]">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" id="" name="name" value="{{ $isi->nama }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input class="form-control" type="text" id="" name="price" value="{{ $isi->harga }}">
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a description here" name="desc" id="floatingTextarea2" style="height: 100px" value="">{{ $isi->deskripsi }}</textarea>
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