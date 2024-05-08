@extends('main')
@section('content')

  <?php
    use App\Models\Kamar;
    use App\Models\H_Kamar;
    use App\Models\D_Kamar;
  ?>

  <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
    <div class="mb-5 pb-5 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
        <div>
        <h2 class="text-4xl font-semibold text-gray-800" style="display:inline-block; padding-right:20px;">Sejarah Pembayaran</h2>
        </div>
    </div>

    <div class="w-full mb-10 lg:mb-14 mt-10">
        <div class="w-full">

          <!-- Content -->
          <div class="space-y-5 md:space-y-8">
            <form action="{{ route('search-history') }}" method="GET" style="float:right;">
              <input type="text" name="search" value="{{ $search }}" placeholder="Cari..." style="background-color:rgb(223, 223, 223); padding:10px; border-radius:10px;">
              <Button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-600 text-white hover:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none">
                Filter
              </Button>
            </form>
            <br><br><br>

            <table style="text-align:center; width:100%;">
              <tr>
                <th style="padding-bottom:2%;">Tanggal</th>
                <th style="padding-bottom:2%;">Nama</th>
                <th style="padding-bottom:2%;">Total</th>
                <th style="padding-bottom:2%;">Status</th>
                <th style="padding-bottom:2%;">Detail</th>
              </tr>
              @foreach ($listHKamar as $key => $header)
                <tr style="background-color: rgb(223, 223, 223); border-bottom: 10px solid #ffffff;">
                  <td>{{$header->created_at->format('j M Y')}}</td>
                  <td>
                    @php
                      $getD = D_Kamar::where('h_kamar_id', $header->h_kamar_id)->first();
                      $getKamar = Kamar::where('kamar_id', $getD->kamar_id)->first();
                    @endphp
                    {{$getKamar->nama}}
                  </td>
                  <td>Rp {{number_format($header->total , 0, ',', '.')}}</td>
                  <td>
                    @if($header->status == 1)
                      <div class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white disabled:opacity-50 disabled:pointer-events-none">
                        Berhasil
                      </div>
                    @else
                      <div class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white disabled:opacity-50 disabled:pointer-events-none">
                        Gagal
                      </div>
                    @endif
                  </td>
                  <td style="padding-top:1%; padding-bottom:1%;">
                      <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="/user/history/kamar/{{$header->h_kamar_id}}">
                        Lihat Detail
                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                      </a>
                  </td>
                </tr>
            @endforeach
            </table>
            {{ $listHKamar->appends(['search' => $search])->links() }}
        </div>
      </div>
      <!-- End Blog Article -->
  </div>

@endsection