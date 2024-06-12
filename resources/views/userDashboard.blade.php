@extends('main')
@section('content')

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
@vite('resources/css/app.css')
@vite('resources/js/app.js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- If Payment Failed --}}
@if(session('payment_failed'))
    <script>
        Swal.fire({
            title: "Pembayaran Gagal",
            text: "Pembayaran Anda gagal. Silakan coba lagi atau hubungi salah satu staf kami.",
            icon: "error",
            confirmButtonText: "OK"
        });
    </script>
@endif

<!-- Announcement Banner -->
@php
    $currentDate = now();
    $showNotif = $currentDate->day >= 5 && $currentDate->day <= $currentDate->daysInMonth; //Harusnya mulai tgl 25, tp mulai tgl 5 aja spy bisa demo saat presentasi

    $month = $currentDate->format('F');
    $year = $currentDate->year;

    if($showNotif && !$cekPembayaran && $listKamar){
      echo
      '<div class="bg-gradient-to-r from-red-500 via-purple-400 to-blue-500">
        <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 mx-auto">
          <!-- Grid -->
          <div class="grid justify-center md:grid-cols-2 md:justify-between md:items-center gap-2">
            <div class="text-center md:text-start">
              <p class="text-xs text-white/[.8] uppercase tracking-wider">
                Pemberitahuan!
              </p>
              <p class="mt-1 text-white font-medium">
                Anda belum melakukan pembayaran kos periode '.$month.' '.$year.'
              </p>
            </div>
            <!-- End Col -->
            <!-- End Col -->
          </div>
          <!-- End Grid -->
        </div>
      </div>

      ';
    }
@endphp
<!-- End Announcement Banner -->


  <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
    <div class="mb-5 pb-5 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
        <div>
        <h2 class="text-4xl font-semibold text-gray-800">Halo, {{Session::get('login_username')}}</h2>
        </div>
        <div>
          <form id="BayarSewaForm" action="{{ route("payment-sewa-success") }}" method="post" enctype="multipart/form-data">
            @csrf
            @php
                if($showNotif && !$cekPembayaran && $listKamar){
                  echo
                  '<button type="submit" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 disabled:opacity-50 disabled:pointer-events-none">
                      Bayar Sewa Bulanan
                      <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                  ';
                }
            @endphp
        </form>
      </div>
    </div>

    <div class="max-w-2xl mb-10 lg:mb-14 mt-10">
        <div class="max-w-2xl">

          <!-- Content -->
          <div class="space-y-5 md:space-y-8">
            {{-- <form action="{{ route('payment') }}" method="post">
              @csrf
              @foreach ($listKamar as $kamar)
                <figure>
                  <img class=" object-cover rounded-xl" src="{{ Storage::url("$kamar->foto") }}" alt="Image Description">
                  <figcaption class="mt-3 text-sm text-center text-gray-500">
                    Room {{$kamar->nama}}
                    @php
                      if($showNotif && !$cekPembayaran && $listKamar){
                        $cek = 0;
                        foreach ($listPembayaran as $DKamar) {
                          if($DKamar->kamar_id == $kamar->kamar_id){
                            $cek = 1;
                          }
                        }
                        if($cek==0){
                          echo '&nbsp;
                                <button type="submit" name="id" value="'.$kamar->kamar_id.'" class="py-1 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-black bg-red-500 text-white shadow-sm hover:bg-red-900 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                  Bayar
                                  <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                </button>';
                        }
                      }
                    @endphp
                  </figcaption>
                </figure>
                <br>
              @endforeach
            </form> --}}
        </div>
      </div>
      <!-- End Blog Article -->
  </div>

  {{-- new code design --}}
  @if($listKamar != null)
  <blockquote class="">
    <p class="text-2xl font-semibold  text-gray-800 md:text-2xl md:leading-normal xl:text-2xl xl:leading-normal ">
      Kamar {{$listKamar->nama}}
    </p>
  </blockquote>
    <div class="grid grid-cols-2 w-full mt-5">
        <div>
            <img class="object-cover rounded-3xl" src="{{ Storage::url($listKamar->foto) }}" alt="Image Description">
        </div>
        <div class="mx-auto">
            <p class="text-xl font-semibold">19L AQUA GALON</p>
            <img class="mt-10 object-cover rounded-3xl" src="{{ Storage::url('kamar/galon.jpg') }}" alt="Image Description">
            <p class="text-lg mt-5">Rp. 20.000/galon</p>
            <form id="BayarGalonForm" action="{{ route('payment-galon-success') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if($cekGalon->status_galon == 1)
                    <button type="submit" name="id" value="{{ $listKamar->kamar_id }}" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-spacing-3 bg-blue-400 text-white hover:bg-blue-700 hover:text-white">
                        Beli Galon
                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                @else
                    <button type="submit" name="id" value="{{ $listKamar->kamar_id }}" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-spacing-3 bg-slate-700 disabled:pointer-events-none text-white" disabled>
                        Galon Belum Dikembalikan
                    </button>
                @endif
            </form>
        </div>
    </div>

    <script>
      document.getElementById('BayarSewaForm').addEventListener('submit', function(event) {
          event.preventDefault(); // Prevent the default form submission
    
          // Serialize form data
          var formData = new FormData(this);
    
          // Perform the Snap.js payment process
          snap.pay('{{ $snapToken }}', {
              onSuccess: function (result) {
                  // Send form data via AJAX after successful payment
                  fetch('{{ route('payment-sewa-success') }}', {
                      method: 'POST',
                      body: formData
                  })
                  .then(response => {
                      if (response.ok) {
                          // Handle successful payment response
                          alert("Pembayaran berhasil!"); 
                          console.log(result);
                          window.location.href = '/payment/success';
                      } else {
                          // Handle payment error
                          alert("Pembayaran gagal!");
                          console.log(result);
                          window.location.href = '/payment/failed';
                      }
                  })
                  .catch(error => {
                      // Handle fetch error
                      alert("Error memproses pembayaran.");
                      console.error('Error:', error);
                  });
              },
              onPending: function (result) {
                  // Handle pending payment
                  alert("Menunggu konfirmasi pembayaran.");
                  console.log(result);
              },
              onError: function (result) {
                  // Handle payment error
                  alert("Pembayaran gagal!");
                  console.log(result);
                  window.location.href = '/payment/failed';
              },
              onClose: function () {
                  // Handle closure of payment popup
                  alert('Proses pembayaran ditutup tanpa menyelesaikan transaksi');
              }
          });
      });
    </script>
    
    <script>
      document.getElementById('BayarGalonForm').addEventListener('submit', function(event) {
          event.preventDefault(); // Prevent the default form submission
    
          // Serialize form data
          var formDataGalon = new FormData(this);
    
          // Perform the Snap.js payment process
          snap.pay('{{ $snapTokenGalon }}', {
              onSuccess: function (result) {
                  // Send form data via AJAX after successful payment
                  fetch('{{ route('payment-galon-success') }}', {
                      method: 'POST',
                      body: formDataGalon
                  })
                  .then(response => {
                      if (response.ok) {
                          // Handle successful payment response
                          alert("Pembayaran berhasil!"); 
                          console.log(result);
                          window.location.href = '/paymentgalon/success';
                      } else {
                          // Handle payment error
                          alert("Pembayaran gagal!");
                          console.log(result);
                          window.location.href = '/payment/failed';
                      }
                  })
                  .catch(error => {
                      // Handle fetch error
                      alert("Error memproses pembayaran.");
                      console.error('Error:', error);
                  });
              },
              onPending: function (result) {
                  // Handle pending payment
                  alert("Menunggu konfirmasi pembayaran.");
                  console.log(result);
              },
              onError: function (result) {
                  // Handle payment error
                  alert("Pembayaran gagal!");
                  console.log(result);
                  window.location.href = '/payment/failed';
              },
              onClose: function () {
                  // Handle closure of payment popup
                  alert('Proses pembayaran ditutup tanpa menyelesaikan transaksi');
              }
          });
      });
    </script>
@endif
  




@endsection

