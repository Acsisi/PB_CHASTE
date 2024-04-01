@extends('main')
@section('content')

<!-- Blog Article -->
<div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14 mt-10">
    <div class="max-w-2xl">


      <!-- Content -->
      <div class="space-y-5 md:space-y-8">

        <blockquote class="text-center p-4 sm:px-7">
          <p class="text-2xl font-semibold mt-5 text-gray-800 md:text-2xl md:leading-normal xl:text-2xl xl:leading-normal ">
            Room {{$kamar->nama}}
          </p>
          <p class="mt-1 text-xl text-gray-800 ">
            Rp. 
            @php
              echo number_format($kamar->harga , 0, ',', '.');
            @endphp
          </p>
        </blockquote>

        <figure>
          <img class="w-full object-cover rounded-xl" src="{{ Storage::url("$kamar->foto") }}" alt="Image Description">
          <figcaption class="mt-3 text-sm text-center text-gray-500">
            Room {{$kamar->nama}}
          </figcaption>
        </figure>

        <div class="flex space-x-3">
          <h3 class="text-2xl font-semibold mt-5">Facilities : </h3>
        </div>

        <ul class="list-disc list-outside space-y-5 ps-5 text-lg text-gray-800 mt-5">

            @php
              if($kamar->AC == "AC"){
                echo '<li class="flex space-x-3">
                      <span class="h-5 w-5 flex justify-center items-center rounded-full bg-blue-600 text-white dark:bg-blue-500">
                          <svg class="flex-shrink-0 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                      </span>
                      <span class="text-gray-800 dark:text-gray-400">
                          AC
                      </span>
                      </li>';
              }  
            @endphp

            <li class="flex space-x-3">
            <span class="h-5 w-5 flex justify-center items-center rounded-full bg-blue-600 text-white dark:bg-blue-500">
                <svg class="flex-shrink-0 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <span class="text-gray-800 dark:text-gray-400">
                FAQ
            </span>
            </li>

            <li class="flex space-x-3">
            <span class="h-5 w-5 flex justify-center items-center rounded-full bg-blue-600 text-white dark:bg-blue-500">
                <svg class="flex-shrink-0 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <span class="text-gray-800 dark:text-gray-400">
                License
            </span>
            </li>

            <li class="flex space-x-3">
            <span class="h-5 w-5 flex justify-center items-center rounded-full bg-blue-600 text-white dark:bg-blue-500">
                <svg class="flex-shrink-0 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <span class="text-gray-800 dark:text-gray-400">
                Terms & Conditions
            </span>
            </li>
        </ul>


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
