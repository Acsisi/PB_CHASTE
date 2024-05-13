@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Manajemen User'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                @php
                    use App\Models\User;
                    $listUser = User::get();
                @endphp
                <div class="card-header pb-0">
                    <h6>User</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2"  style="height: 300px; overflow-y: auto;">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status Akun</th>
                                    <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status Galon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listUser as $key=>$isi)
                                @if($isi->status == 1)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            @if ($isi->foto != NULL)
                                            <div>
                                                <img src="{{ Storage::url("$isi->foto") }}" class="avatar me-3" alt="image">
                                            </div>
                                            @else
                                            <div>
                                                <img src="./img/defaultpic.png" class="avatar me-3" alt="image">
                                            </div>
                                            @endif
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $isi->nama }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    @if ($isi->role == 1)
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Admin</p>
                                    </td>
                                    @elseif ($isi->role == 3)
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Penyewa Kamar</p>
                                    </td>
                                    @endif
                                    @if($isi->role != 1)
                                    <td class="align-middle">
                                        <button style="background-color: red;" class="btn btn-primary"><a href="/user-management/delete/{{$isi->user_id}}" style="text-decoration: none;color: inherit;">Nonaktifkan Akun</a></button>
                                    </td>
                                    @endif
                                    @if($isi->status_galon == 2 && $isi->role != 1)
                                    <td class="align-middle">
                                        <button style="background-color: orange;" class="btn btn-warning"><a href="/user-management/update/{{$isi->user_id}}" style="text-decoration: none;color: inherit;">Pinjam Galon</a></button>
                                    </td>
                                    @elseif($isi->status_galon == 1 && $isi->role != 1)
                                    <td class="align-middle">
                                        <button style="background-color: green;" class="btn btn-success">Tidak pinjam galon </button>
                                    </td>
                                    @endif
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
