<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
@vite('resources/css/app.css')
@vite('resources/js/app.js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .center{
        position:absolute;
        left:30%;
        top:20%;
    }
</style>

<form id="paymentForm" action="{{ route('payment-success') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="center" style="border: 2px solid #ccc; padding: 10px 0px 20px 20px;">
        <p class="mt-1 text-black font-medium">
            {{-- Bayar Rp{{number_format($kamar->harga , 0, ',', '.')}} untuk kamar kos {{$kamar->nama}}? --}}
            <p style="font-size: 24px;margin-bottom:10px;"><b>Rp{{number_format($kamar->harga , 0, ',', '.')}}/bulan</b></p>
            <table>
                <tr>
                    <td><label for="mulai">Mulai Kos: </label></td>
                    <td><input type="datetime-local" id="mulai" name="mulai" placeholder="Mulai kos" style="border:2px solid;border-radius: 5px;padding: 8px;margin-bottom:10px;" required></td>
                </tr>
                <tr>
                    <td><label for="ktp">Foto KTP: </label></td>
                    <td><input type="file" id="ktp" name="ktp[]" style="margin-bottom:10px;" required></td>
                </tr>
                <tr>
                    <td><label for="kk">Foto Kartu Keluarga:&nbsp;</label></td>
                    <td><input type="file" id="kk" name="kk[]" style="margin-bottom:10px;" required></td>
                </tr>
            </table>
            <br>
        </p>
        <a href="https://api.whatsapp.com/send?phone=6282232323656" target="_blank" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-red-500 bg-white text-red-500 shadow-sm hover:bg-red-100 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 justify-center" style="width: 200px;">
            Kontak Pemilik
            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </a>
        <button type="submit" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-black bg-red-500 text-white shadow-sm hover:bg-red-900 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 justify-center" style="width: 200px;">
            Bayar
            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </button>
    </div>
</form>

<script>
    document.getElementById('mulai').addEventListener('change', function() {
        var selectedDate = new Date(this.value); // Get the selected date
        var tomorrow = new Date(); // Get tomorrow's date
        tomorrow.setDate(tomorrow.getDate() + 1); // Increment tomorrow's date by 1 day

        selectedDate.setHours(0, 0, 0, 0);
        tomorrow.setHours(0, 0, 0, 0);

        if (selectedDate < tomorrow) {
            alert('Tanggal harus setelah hari ini.');
            this.value = ''; // Clear the input field if the selected date is before tomorrow
        }
    });
</script>

<script>
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize form data
        var formData = new FormData(this);

        // Perform the Snap.js payment process
        snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                // Send form data via AJAX after successful payment
                fetch('{{ route('payment-success') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        // Handle successful payment response
                        alert("Payment successful!"); 
                        console.log(result);
                        window.location.href = '/payment/success';
                    } else {
                        // Handle payment error
                        alert("Payment failed!");
                        console.log(result);
                        window.location.href = '/payment/failed';
                    }
                })
                .catch(error => {
                    // Handle fetch error
                    alert("Error processing payment.");
                    console.error('Error:', error);
                });
            },
            onPending: function (result) {
                // Handle pending payment
                alert("Waiting for payment confirmation.");
                console.log(result);
            },
            onError: function (result) {
                // Handle payment error
                alert("Payment failed!");
                console.log(result);
                window.location.href = '/payment/failed';
            },
            onClose: function () {
                // Handle closure of payment popup
                alert('Payment process closed without completing the transaction');
            }
        });
    });
</script>

{{-- <script>
    document.getElementById('payButton').addEventListener('click', function(e) {
        e.preventDefault();
        snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
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
</script> --}}