@extends('main')
@section('content')

<!-- component -->
<!-- Create By Joker Banny -->


<div>
  <div class="h-full bg-gray-100 pt-20">
    <h1 class="mb-10 text-center text-2xl">Cart Items</h1>
    <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
        <div class="rounded-lg md:w-2/3">

        @foreach ($cart as $c)
        <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
          <img src="{{ Storage::url("$c->foto") }}" alt="product-image" class="w-full rounded-lg sm:w-40" />
          <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
            <div class="mt-5 sm:mt-0">
              <h2 class="text-lg font-bold text-gray-900">{{ $c->nama }}</h2>
              <p class="mt-1 text-xs text-gray-700">Rp. {{ number_format($c->harga) }}</p>
              <a href="/remove-cart/{{$c->menu_id}}"><p class="mt-16 text-base text-red-700 hover:underline">Remove</p></a>
            </div>
            <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-2">
                <div class="flex items-center border-gray-100 ml-7">
                    <a href="/minus-cart/{{$c->menu_id}}"><span class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"> - </span></a>
                    <span class="w-5 text-center">{{$c->qty}}</span>
                    <a href="/add-cart/{{$c->menu_id}}"><span class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50">+</span></a>


                </div>
              <div class="">
                <p class="text-sm">Subtotal : Rp. {{number_format($c->subtotal)}}</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach

      </div>
      <!-- Sub total -->
      <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
        <div class="mb-2 flex justify-between">
          <p class="text-gray-700">Subtotal</p>
          <p class="text-gray-700">
            Rp. {{number_format($total)}}
          </p>
        </div>
        <div class="flex justify-between">
          <p class="text-gray-700">TAX</p>
          <p class="text-gray-700">
            Rp. {{number_format($tax)}}
          </p>
        </div>
        <hr class="my-4" />
        <div class="flex justify-between">
          <p class="text-lg font-bold">Total</p>
          <div class="">
            <p class="mb-1 text-lg font-bold">Rp {{ number_format($grandtotal) }}</p>
            <p class="text-sm text-gray-700">including TAX</p>
          </div>
        </div>
        <a href="/payCart">
            <button class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Check out</button>
        </a>
      </div>
    </div>
  </div>
</div>

@endsection
