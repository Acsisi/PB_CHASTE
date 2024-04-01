@extends('layouts.appTenant', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        @if ($user->foto)
                            <img src="{{ asset('storage/' . $user->foto) }}" alt="profile_image" class="w-100 h-100 border-radius-lg shadow-sm">
                        @else
                            <img src="/img/Admin.jpg" alt="default_profile_image" class="w-100 border-radius-lg shadow-sm">
                        @endif
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{$user -> nama}}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            Hai aku  {{$user -> username}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Profile</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">User Information</p>
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username" class="form-control-label">Username</label>
                                        <input id="username" name="username" class="form-control" type="text" value="{{ $user->username }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Name</label>
                                        <input id="nama" name="nama" class="form-control" type="text" value="{{ $user->nama }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email address</label>
                                        <input id="email" name="email" class="form-control" type="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telephone" class="form-control-label">Telephone Number</label>
                                        <input id="telephone" name="telephone" class="form-control" type="text" value="{{ $user->no_telp }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Password</label>
                                        <input id="password" name="password" class="form-control" type="password" placeholder="Enter new password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profile_picture" class="form-control-label">Profile Picture</label>
                                        <input id="profile_picture" name="foto" class="form-control" type="file">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Save Changes</button>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection