@extends('main')
@section('content')

{{-- testing --}}
<!-- Blog Article -->
<div class="max-w-5xl mx-auto mb-10 lg:mb-14 mt-10">
    <div class="max-w-5xl">


      <!-- Content -->
      <div class="space-y-5 md:space-y-2">

        <blockquote class="text-start p-4 sm:px-7">
          <p class="text-9xl font-semibold mt-5 text-gray-800 md:text-2xl md:leading-normal xl:text-4xl xl:leading-normal ">
            Room {{$kamar->nama}}
          </p>
          <p class="mt-1 text-2xl text-gray-800 ">
            Rp.
            @php
              echo number_format($kamar->harga , 0, ',', '.');
            @endphp
          </p>
        </blockquote>

        <figure>
          <img class="w-1/2 m-auto object-cover rounded-xl" src="{{ Storage::url("$kamar->foto") }}" alt="Image Description">
        </figure>


        <!-- Icon Blocks -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 items-center gap-6">
      <!-- Card -->
      <a class="group flex gap-y-6 size-full" href="#">
        <i class="fa-solid fa-money-bill fa-2x flex-shrink-0 size-8 text-gray-800 mt-4 me-6" ></i>
        <div>
          <div>
            <h3 class="block font-bold text-gray-800 ">Harga dijamin murah</h3>
            <p class="text-gray-600 ">Bebas biaya biaya lain seperti biaya air dan listrik</p>
          </div>


        </div>
      </a>
      <!-- End Card -->

      <!-- Card -->
      <a class="group flex gap-y-6 size-full" href="#">

        <i class="fa-solid fa-shop fa-2x flex-shrink-0 size-8 text-gray-800 mt-4 me-6" ></i>

        <div>
          <div>
            <h3 class="block font-bold text-gray-800">Foodcourt didalam kos</h3>
            <p class="text-gray-600">Foodcourt dengan berbagai pilihan stall di dalam area kos</p>
          </div>


        </div>
      </a>
      <!-- End Card -->

      <!-- Card -->
      <a class="group flex gap-y-6 size-full " href="#">
        <i class="fa-solid fa-street-view fa-2x flex-shrink-0 size-8 text-gray-800 mt-4 me-6" ></i>

        <div>
          <div>
            <h3 class="block font-bold text-gray-800">Lokasi strategis </h3>
            <p class="text-gray-600">Lokasi strategis di tengah kota Surabaya</p>
          </div>

        </div>
      </a>
      <!-- End Card -->

      <div class="">
        <h3 class="text-2xl font-semibold mt-5">Fasilitas Kamar : </h3>
        <ul class="list-disc list-outside space-y-5 ps-5 text-lg text-gray-800 mt-5">

            @php
              if($kamar->AC == "AC"){
                echo '<li class="flex space-x-3">
                      <span class="h-5 w-5 flex justify-center items-center rounded-full bg-blue-600 text-white">
                          <svg class="flex-shrink-0 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                      </span>

                      <span class="text-gray-800">
                          AC
                      </span>
                      </li>';
              }
            @endphp

            <li class="flex space-x-3">
                <i class="fa-solid fa-bed"></i>
            <span class="text-gray-800">
                Bed
            </span>
            </li>

            <li class="flex space-x-3">
            <span class="h-5 w-5 flex justify-center items-center rounded-full bg-blue-600 text-white">
                <svg class="flex-shrink-0 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <span class="text-gray-800">
                Desk
            </span>
            </li>

            <li class="flex space-x-3">
            <span class="h-5 w-5 flex justify-center items-center rounded-full bg-blue-600 text-white">
                <svg class="flex-shrink-0 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <span class="text-gray-800">
                Cupboard
            </span>
            </li>
        </ul>

        <h3 class="text-2xl font-semibold mt-5">Fasilitas Umum : </h3>
        <ul class="list-disc list-outside space-y-5 ps-5 text-lg text-gray-800 mt-5">

            @php
              if($kamar->AC == "AC"){
                echo '<li class="flex space-x-3">
                      <span class="h-5 w-5 flex justify-center items-center rounded-full bg-blue-600 text-white">
                          <svg class="flex-shrink-0 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                      </span>

                      <span class="text-gray-800">
                          AC
                      </span>
                      </li>';
              }
            @endphp

            <li class="flex space-x-3">
                <i class="fa-solid fa-bed"></i>
            <span class="text-gray-800">
                Bed
            </span>
            </li>

            <li class="flex space-x-3">
            <span class="h-5 w-5 flex justify-center items-center rounded-full bg-blue-600 text-white">
                <svg class="flex-shrink-0 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <span class="text-gray-800">
                Desk
            </span>
            </li>

            <li class="flex space-x-3">
            <span class="h-5 w-5 flex justify-center items-center rounded-full bg-blue-600 text-white">
                <svg class="flex-shrink-0 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <span class="text-gray-800">
                Cupboard
            </span>
            </li>
        </ul>

      </div>
    </div>

    <h3 class="text-2xl font-semibold mt-5">Maps : </h3>
    <div class="grid grid-cols-2 gap-x-10 mt-10">
        <img class="w-full object-cover rounded-xl" src="{{ Storage::url("/kamar/GPS.png") }}" alt="">

        <img class="w-full object-cover rounded-xl" src="{{ Storage::url("/kamar/LOC.png") }}" alt="">

    </div>


  </div>
  <!-- End Icon Blocks -->





      </div>


      <!-- End Content -->
      {{-- button  --}}
      @if ($kamar->penyewa_id == NULL)
      <form action="{{ route('payment') }}" method="post">
        @csrf
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14 mt-10">
          <button type="submit" name="id" value="{{$kamar->kamar_id}}" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
            Make Reservation
            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
          </button>
        </div>
      </form>
      @else
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14 mt-10" style="pointer-events: none;">
          <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-slate-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="kos-invoice">
            This Room is Taken
          </a>
        </div>
      @endif
      {{-- end button  --}}
    </div>
  </div>
  <!-- End Blog Article -->



@endsection
