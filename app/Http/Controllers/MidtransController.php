<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Kamar;
use App\Models\H_Kamar;
use App\Models\D_Kamar;
use App\Models\Menu;
use App\Models\H_Menu;
use App\Models\D_Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function payment(Request $request)
    {
        if(Session::get('login_id')){
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$clientKey = config('services.midtrans.client_key');
            Config::$isProduction = config('services.midtrans.is_production');
            Config::$isSanitized = config('services.midtrans.is_sanitized');
            Config::$is3ds = config('services.midtrans.is_3ds');

            $kamar = Kamar::where('kamar_id', $request->id)->first();
            Session::put('kamar_id', $request->id);
            Session::put('kamar_harga', $kamar->harga);

            $transactionDetails = [
                'order_id' => 'ORDER-' . time(),
                'gross_amount' => $kamar->harga
            ];

            $snapToken = Snap::getSnapToken(['transaction_details' => $transactionDetails]);

            return view('payment', ['snapToken' => $snapToken, 'kamar'=>$kamar]);
        }
        else{
            return redirect('/login');
        }
    }

    public function payment_success(Request $request)
    {
        //INSERT
        DB::table('h_kamar')->insert([
            'user_id' => 1,
            'penyewa_id' => Session::get('login_id'),
            'total' => Session::get('kamar_harga'),
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 1
        ]);

        $h_kamar = H_Kamar::latest()->first();
        DB::table('d_kamar')->insert([
            'h_kamar_id' => $h_kamar->h_kamar_id,
            'kamar_id' => Session::get('kamar_id'),
            'harga' => Session::get('kamar_harga'),
            'status' => 1
        ]);

        Session::forget('kamar_id');
        Session::forget('kamar_harga');

        //GET
        $HKamar = H_Kamar::latest()->first();
        $DKamar = D_Kamar::where('h_kamar_id', $HKamar->h_kamar_id)->first();
        $Kamar = Kamar::where('kamar_id', $DKamar->kamar_id)->first();

        //UPDATE (apabila sewa pertama kali)
        if($Kamar->status==1){
            DB::table('kamar')->where('kamar_id', '=', $Kamar->kamar_id)->update([
                'penyewa_id' => Session::get('login_id'),
                'status' => 2 //DISEWA
            ]);
        }

        return view("userHistoryDetail", ['HKamar' => $HKamar, 'DKamar' => $DKamar, 'Kamar'=>$Kamar]);
    }

    public function payment_fail(Request $request)
    {
        //INSERT
        DB::table('h_kamar')->insert([
            'user_id' => 1,
            'penyewa_id' => Session::get('login_id'),
            'total' => Session::get('kamar_harga'),
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 0
        ]);

        $h_kamar = H_Kamar::latest()->first();
        DB::table('d_kamar')->insert([
            'h_kamar_id' => $h_kamar->h_kamar_id,
            'kamar_id' =>  Session::get('kamar_id'),
            'harga' =>  Session::get('kamar_harga'),
            'status' => 0
        ]);

        Session::forget('kamar_id');
        Session::forget('kamar_harga');

        Session::flash('payment_failed', true);
        return redirect()->route('user');
    }

    public function foodMidtrans(Request $request){
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        if (Session::has('pnow')) {
            $pnow = Session::get('pnow') ?? [];
            $total = $pnow->harga;

            $transactionDetails = [
                'order_id' => 'ORDER-' . time(),
                'gross_amount' => $total+$total/10
            ];


            $snapToken = Snap::getSnapToken(['transaction_details' => $transactionDetails]);

            return view('food-midtrans', ['snapToken' => $snapToken,
            'pnow'=>$pnow,
            'total' => $total,
            'tax' => $total * 0.1,
            'grandtotal' => $total + ($total * 0.1)
            ]);
        }

        elseif (Session::has('cart')) {
            $cart = Session::get('cart') ?? [];
            $total = 0;
            foreach ($cart as $key => $value) {
                $total += $value->subtotal;
            }

            $transactionDetails = [
                'order_id' => 'ORDER-' . time(),
                'gross_amount' => $total+$total/10
            ];

            $snapToken = Snap::getSnapToken(['transaction_details' => $transactionDetails]);

            return view('food-midtrans', ['snapToken' => $snapToken,
            'cart'=>$cart,
            'total' => $total,
            'tax' => $total * 0.1,
            'grandtotal' => $total + ($total * 0.1)
            ]);
        }
    }

    public function food_payment_success(Request $request)
    {
        if (Session::has('pnow')) {
            //INSERT
            DB::table('h_menu')->insert([
                'tenant_id' => Session::get('pnow')->tenant_id,
                'customer_id' => Session::get('login_id') ?? null,
                'total' => Session::get('pnow')->harga,
                'created_at' => now(),
                'updated_at' => now(),
                'status' => 1
            ]);

            $h_menu = H_Menu::latest()->first();
            DB::table('d_menu')->insert([
                'h_menu_id' => $h_menu->h_menu_id,
                'menu_id' => Session::get('pnow')->menu_id,
                'qty' => 1,
                'harga' => Session::get('pnow')->harga,
                'status' => 1 
            ]);

            //GET
            $HMenu = H_Menu::where('h_menu_id', $h_menu->h_menu_id)->first();
            $Tenant = Tenant::where('tenant_id', $HMenu->tenant_id)->first();
            $DMenu = D_Menu::where('h_menu_id', $h_menu->h_menu_id)->get();
            $arrayDMenu = $DMenu->pluck('menu_id')->toArray();
            $Menu = Menu::whereIn('menu_id', $arrayDMenu)->get();

            Session::forget('pnow');

            $toggle = 0;
        }

        elseif (Session::has('cart')) {

            // Ambil data dari session "cart"
            $cart = Session::get('cart') ?? [];
            $total = 0;
            foreach ($cart as $key => $value) {
                $total += $value->subtotal;
            }

            //INSERT

            $tenant = null;
            $cek = 0;
            foreach ($cart as $key => $value) {
                if($tenant){
                    foreach ($tenant as $k => $t) {
                        if($value->tenant_id == $t){
                            $cek = $k;
                        }
                    }
                }
                if($key == 0){
                    $tenant[] = $value->tenant_id;
                    DB::table('h_menu')->insert([
                        'tenant_id' => $value->tenant_id,
                        'customer_id' => Session::get('login_id') ?? null,
                        'total' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'status' => 1
                    ]);
                }
                else if($value->tenant_id != $tenant[$cek]){
                    $tenant[] = $value->tenant_id;
                    DB::table('h_menu')->insert([
                        'tenant_id' => $value->tenant_id,
                        'customer_id' => Session::get('login_id') ?? null,
                        'total' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'status' => 1
                    ]);
                }
            }

            $cek = 0;
            $h_menu = H_Menu::orderBy('h_menu_id', 'DESC')->latest()->first();
            $h_menu_id = $h_menu->h_menu_id;
            foreach ($cart as $c) {
                foreach ($tenant as $k => $t) {
                    if($c->tenant_id == $t){
                        $id = $h_menu_id - (sizeOf($tenant)-1 - $k);
                        DB::table('d_menu')->insert([
                            'h_menu_id' => $id,
                            'menu_id' => $c->menu_id,
                            'qty' => $c->qty,
                            'harga' => $c->subtotal,
                            'status' => 1
                        ]);

                        //UPDATE total di H_Menu
                        $total = H_Menu::where('h_menu_id', '=', $id)->first()->total;
                        DB::table('h_menu')->where('h_menu_id', '=', $id)->update([
                            'total' => $total + $c->subtotal
                        ]);
                    }
                }
            }

            //GET
            foreach ($tenant as $key => $value) {
                $id = $h_menu_id - (sizeOf($tenant)-1 - $key);
                $HMenu[] = H_Menu::where('h_menu_id', $id)->first();
                $Tenant[] = Tenant::where('tenant_id', $HMenu[$key]->tenant_id)->first();
                $DMenu[] = D_Menu::where('h_menu_id', $id)->get();
                $arrayDMenu = $DMenu[$key]->pluck('menu_id')->toArray();
                $Menu[] = Menu::whereIn('menu_id', $arrayDMenu)->get();
            }

            Session::forget('cart');

            $toggle = sizeOf($tenant)-1;
        }
        
        return view("userHistoryDetailFood", ['toggle'=>$toggle, 'HMenu' => $HMenu, 'DMenu' => $DMenu,'Tenant'=>$Tenant, 'Menu'=>$Menu]);
    }
}
