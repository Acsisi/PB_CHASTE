{{-- @extends('layouts.app')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                @include('layouts.navbars.guest.navbar')
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login.perform') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email">
                                            @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="password" class="form-control form-control-lg" aria-label="Password" placeholder="Password" >
                                            @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
              background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new
                                    currency"</h4>
                                <p class="text-white position-relative">The more effortless the writing looks, the more
                                    effort the writer actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection --}}

@extends('main')
@section('content')

<!-- Hero -->
<div class="relative overflow-hidden">
    <div class="mx-auto max-w-screen-md py-12 px-4 sm:px-6 md:max-w-screen-xl md:py-20 lg:py-32 md:px-8">
      <div class="md:pe-8 md:w-1/2 xl:pe-0 xl:w-5/12">
        <!-- Title -->
        <h1 class="text-3xl text-gray-800 font-bold md:text-4xl md:leading-tight lg:text-5xl lg:leading-tight ">
          Login to your <span class="text-blue-600" >chaste</span> account
        </h1>
        <p class="mt-3 text-base text-gray-500">
          Built on standard web technology, teams use Preline to build beautiful cross-platform hybrid apps in a fraction of the time.
        </p>
        <!-- End Title -->


        <div class="py-6 flex items-center text-sm text-gray-400 uppercase before:flex-[1_1_0%] before:border-t before:me-6 after:flex-[1_1_0%] after:border-t after:ms-6"></div>

        <!-- Form -->
        <form role="form" method="POST" action="{{ route('login.perform') }}">
            @csrf
            @method('post')

            <div class="mb-4">
                <label for="hs-hero-email-2" class="block text-sm font-medium"><span class="sr-only">Email address</span></label>
                <input type="email" name="email" id="hs-hero-email-2" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " placeholder="Email address">
                @error('email') <p style="color: red" class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
            </div>

            <div class="mb-4">
                <label for="hs-hero-password-2" class="block text-sm font-medium"><span class="sr-only">Password</span></label>
                <input type="password" name="password" id="hs-hero-password-2" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " placeholder="Password">
                @error('password') <p style="color: red" class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
            </div>

            <div class="grid">
                <button type="submit" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Log In</button>
            </div>

            <div class="grid">
                <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md transition-all text-sm" href="{{ url('/register') }}" aria-current="page">Doesn't have an account? <span class="text-blue-600 hover:text-gray-400" >Register</span></a>
            </div>
        </form>
        <!-- End Form -->
      </div>
    </div>

    <div class="hidden md:block md:absolute md:top-0 md:start-1/2 md:end-0 h-full bg-[url('https://images.unsplash.com/photo-1606868306217-dbf5046868d2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1981&q=80')] bg-no-repeat bg-center bg-cover"></div>
    <!-- End Col -->
  </div>
  <!-- End Hero -->

@endsection
