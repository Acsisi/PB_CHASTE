<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
@vite('resources/css/app.css')
@vite('resources/js/app.js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .center{
        position:absolute;
        left:35%;
        top:40%;
        text-align: center;
    }
</style>

<div class="center">
    <p class="mt-1 text-black font-medium">
        Bayar Rp{{number_format($kamar->harga , 0, ',', '.')}} untuk kamar kos {{$kamar->nama}}?
    </p>
    <button type="submit" id="payButton" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-black bg-red-500 text-white shadow-sm hover:bg-red-900 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
        Bayar
        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
    </button>
</div>

<script>
    document.getElementById('payButton').addEventListener('click', function(e) {
        e.preventDefault();
        snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
            window.location.href = '/payment/success';
            },
            onPending: function (result) {
            /* You may add your own implementation here */
            alert("wating your payment!"); console.log(result);
            },
            onError: function (result) {
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
            window.location.href = '/payment/failed';
            },
            onClose: function () {
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
            }
        });
    });
</script>
