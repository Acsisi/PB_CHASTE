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
            Kamar {{$kamar->nama}}
          </p>
          <p class="mt-1 text-2xl text-gray-800 ">
            Rp.
            @php
              echo number_format($kamar->harga , 0, ',', '.');
            @endphp
          </p>
        </blockquote>

        <figure>
          <img class="w-1/2 mx-auto object-cover rounded-xl" src="{{ Storage::url("$kamar->foto") }}" alt="Image Description">
          {{-- <div class="grid grid-cols-2 w-full mt-10">
            <div>
                <img class="w-1/2  object-cover rounded-xl" src="{{ Storage::url("$kamar->foto") }}" alt="Image Description">
            </div>

            <div>
                <img class="w-1/2  object-cover rounded-xl" src="{{ Storage::url("$kamar->foto") }}" alt="Image Description">
            </div>
          </div> --}}

        </figure>

        <div class="container mx-auto">
            <!-- Slider -->
            <div data-hs-carousel='{
                "loadingClasses": "opacity-0"
            }' class="relative">
            <div class="hs-carousel relative overflow-hidden w-full min-h-96 bg-white rounded-lg">
                <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
                <div class="hs-carousel-slide">
                    <div class="flex justify-center h-full bg-gray-100 p-6 ">
                    <span class="self-center text-4xl text-gray-800 transition duration-700">First slide</span>
                    </div>
                </div>
                <div class="hs-carousel-slide">
                    <div class="flex justify-center h-full bg-gray-200 p-6 ">
                    <span class="self-center text-4xl text-gray-800 transition duration-700">Second slide</span>
                    </div>
                </div>
                <div class="hs-carousel-slide">
                    <div class="flex justify-center h-full bg-gray-300 p-6 ">
                    <span class="self-center text-4xl text-gray-800 transition duration-700">Third slide</span>
                    </div>
                </div>
                </div>
            </div>

            <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 space-x-2">
                <span class="hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer"></span>
                <span class="hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer"></span>
                <span class="hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer"></span>
            </div>
            </div>
            <!-- End Slider -->
        </div>




        <!-- Icon Blocks -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 items-center gap-6">
      <!-- Card -->
      <a class="group flex gap-y-6 size-full" href="#">
        <i class="fa-solid fa-money-bill fa-2x flex-shrink-0 size-8 text-gray-800 mt-4 me-6" ></i>
        <div>
          <div>
            <h3 class="block font-bold text-gray-800 ">Harga Terjangkau</h3>
            <p class="text-gray-600 ">Gratis biaya listrik dan air</p>
          </div>


        </div>
      </a>
      <!-- End Card -->

      <!-- Card -->
      <a class="group flex gap-y-6 size-full" href="#">

        <i class="fa-solid fa-shop fa-2x flex-shrink-0 size-8 text-gray-800 mt-4 me-6" ></i>

        <div>
          <div>
            <h3 class="block font-bold text-gray-800">Kantin di Area Kost</h3>
            <p class="text-gray-600">Dengan beberapa pilihan tenant</p>
          </div>


        </div>
      </a>
      <!-- End Card -->

      <!-- Card -->
      <a class="group flex gap-y-6 size-full " href="#">
        <i class="fa-solid fa-street-view fa-2x flex-shrink-0 size-8 text-gray-800 mt-4 me-6" ></i>

        <div>
          <div>
            <h3 class="block font-bold text-gray-800">Lokasi Strategis</h3>
            <p class="text-gray-600">Terletak di pusat Kota Surabaya</p>
          </div>

        </div>
      </a>
      <!-- End Card -->

    </div>

    <div class="grid grid-cols-2 w-full mt-10">
      <div class="">
          <h3 class="text-2xl font-semibold mt-5">Fasilitas Kamar: </h3>
          <ul class="list-disc list-outside space-y-5 ps-5 text-lg text-gray-800 mt-5">

            @if ($kamar->AC == "AC")
            <li class="flex space-x-3">
                <span class="h-5 w-5 flex justify-center items-center rounded-full ">
                  <img class="flex-shrink-0 h-5.5 w-5.5" src="{{ Storage::url("/kamar/aircon.png") }}" alt="">
                </span>

                <span class="text-gray-800">
                    AC
                </span>
            </li>
            @endif
            <li class="flex space-x-3">
            <span class="h-5 w-5 flex justify-center items-center rounded-full ">
                <img class="flex-shrink-0 h-5.5 w-5.5" src="{{ Storage::url("/kamar/double-bed.png") }}" alt="">
            </span>
            <span class="text-gray-800">
                Tempat Tidur
            </span>
            </li>

            <li class="flex space-x-3">
            <span class="h-5 w-5 flex justify-center items-center rounded-full ">
                <img class="flex-shrink-0 h-5.5 w-5.5" src="{{ Storage::url("/kamar/desk.png") }}" alt="">
            </span>
            <span class="text-gray-800">
                Meja Tulis
            </span>
            </li>

            <li class="flex space-x-3">
            <span class="h-5 w-5 flex justify-center items-center rounded-full ">
                <img class="flex-shrink-0 h-5.5 w-5.5" src="{{ Storage::url("/kamar/cupboard.png") }}" alt="">
            </span>
            <span class="text-gray-800">
                Lemari
            </span>
            </li>
          </ul>
      </div>
      <div class="">
          <h3 class="text-2xl font-semibold mt-5">Fasilitas Publik: </h3>
          <ul class="list-disc list-outside space-y-5 ps-5 text-lg text-gray-800 mt-5">
              <li class="flex space-x-3">
              <span class="h-5 w-5 flex justify-center items-center rounded-full ">
                  <img class="flex-shrink-0 h-5.5 w-5.5" src="{{ Storage::url("/kamar/rice.png") }}" alt="">
              </span>
              <span class="text-gray-800">
                  Nasi Gratis Setiap Hari
              </span>
              </li>

              <li class="flex space-x-3">
                <span class="h-5 w-5 flex justify-center items-center rounded-full ">
                    <img class="flex-shrink-0 h-5.5 w-5.5" src="{{ Storage::url("/kamar/motorcycle.png") }}" alt="">
                </span>
                <span class="text-gray-800">
                  Parkir Sepeda Motor
                </span>
                </li>

              <li class="flex space-x-3">
              <span class="h-5 w-5 flex justify-center items-center rounded-full ">
                  <img class="flex-shrink-0 h-5.5 w-5.5" src="{{ Storage::url("/kamar/shower.png") }}" alt="">
              </span>
              <span class="text-gray-800">
                  Kamar Mandi
              </span>
              </li>

              <li class="flex space-x-3">
              <span class="h-5 w-5 flex justify-center items-center rounded-full ">
                  <img class="flex-shrink-0 h-5.5 w-5.5" src="{{ Storage::url("/kamar/kitchen-set.png") }}" alt="">
              </span>
              <span class="text-gray-800">
                  Dapur
              </span>
              </li>
          </ul>
      </div>
    </div>
    <h3 class="text-2xl font-semibold mt-10">Maps : </h3>
    <div class="grid grid-cols-2 gap-x-10 mt-10">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5508163972804!2d112.75609507500002!3d-7.291835892715616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbe715469163%3A0x4c971e01042a26c5!2sChaste%20Kost%20%26%20Pujasera!5e0!3m2!1sen!2sid!4v1713946914959!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" class="w-full object-cover rounded-xl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        <img class="w-full object-cover rounded-xl" src="{{ Storage::url("/kamar/loc.png") }}" alt="">

    </div>


  </div>
  <!-- End Icon Blocks -->





      </div>


      <!-- End Content -->
      {{-- button  --}}
      @php
        use App\Models\Kamar;
        $cekKamar = null;
        if(Session::get('login_id')) $cekKamar = Kamar::where('penyewa_id', Session::get('login_id'))->first();
      @endphp
      @if ($cekKamar != null)
      <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14 mt-10" style="pointer-events: none;">
        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-slate-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="kos-invoice">
          Anda Sudah Sewa Kamar
        </a>
      </div>
      @elseif ($kamar->penyewa_id == NULL)
      <form action="{{ route('payment') }}" method="post">
        @csrf
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14 mt-10">
          <button type="submit" name="id" value="{{$kamar->kamar_id}}" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
            Buat Reservasi
            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
          </button>
        </div>
      </form>
      @else
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14 mt-10" style="pointer-events: none;">
          <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-slate-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="kos-invoice">
            Kamar ini Sudah Diambil
          </a>
        </div>
      @endif
      {{-- end button  --}}
    </div>
  </div>
  <!-- End Blog Article -->



@endsection
