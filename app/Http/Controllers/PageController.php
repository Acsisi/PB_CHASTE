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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}");
        }

        return abort(404);
    }

    public function vr()
    {
        return view("pages.virtual-reality");
    }

    public function rtl()
    {
        return view("pages.rtl");
    }

    public function profile()
    {
        return view("pages.profile-static");
    }

    public function profileTenant()
    {
        $user = Auth::user();

        return view("pages.profileTenant", compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email',
            'nama' => 'required',
            'telephone' => 'required',
            'password' => 'nullable|min:6',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->no_telp = $request->input('telephone');
        
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotoprofil','public');
    
            $user->foto = $path;
        }

        $user->save();

        return view("pages.profileTenant", compact('user'));    
    }

    public function signin()
    {
        return view("pages.sign-in-static");
    }

    public function signup()
    {
        return view("pages.sign-up-static");
    }

    public function dashboard(Request $request)
    {
        $currentDate = now();
        $month = $currentDate->month;
        $year = $currentDate->year;

        $listKamar = Kamar::where('penyewa_id', Session::get('login_id'))->where('status', 2)->get();
        $arrayKamar = $listKamar->pluck('kamar_id')->toArray();

        $listDKamar = D_Kamar::whereIn('kamar_id', $arrayKamar)->get();
        $arrayDKamar = $listDKamar->pluck('h_kamar_id')->toArray();

        $listHKamar = H_Kamar::whereIn('h_kamar_id', $arrayDKamar)
        ->where('status', 1)
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->get();
        $arrayHKamar = $listHKamar->pluck('h_kamar_id')->toArray();

        $listPembayaran = D_Kamar::whereIn('h_kamar_id', $arrayHKamar)->get();
        
        if($listPembayaran->isNotEmpty()){
            $cekPembayaran = 1;
        }
        else{
            $cekPembayaran = null;
        }

        return view("userDashboard", ['listPembayaran'=>$listPembayaran, 'cekPembayaran' => $cekPembayaran, 'listKamar' => $listKamar]);
    }

    public function user_history(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $listKamar = Kamar::where('penyewa_id', Session::get('login_id'))->where('nama', 'like', '%' . $search . '%')->get();
            $arrayKamar = $listKamar->pluck('kamar_id')->toArray();

            $listDKamar = D_Kamar::whereIn('kamar_id', $arrayKamar)->get();
            $arrayDKamar = $listDKamar->pluck('h_kamar_id')->toArray();

            $listHKamar = H_Kamar::where('penyewa_id', Session::get('login_id'))
                ->whereIn('h_kamar_id', $arrayDKamar)
                ->orWhereRaw("DATE_FORMAT(created_at, '%e %b %Y') LIKE ?", ['%' . $search . '%'])
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        }
        else{
            $listHKamar = H_Kamar::where('penyewa_id', Session::get('login_id'))->orderBy('updated_at', 'desc')->paginate(10);
        }

        return view("userHistory", ['listHKamar' => $listHKamar, 'search' => $search]);
    }

    public function user_history_detail(Request $request)
    {
        $HKamar = H_Kamar::where('h_kamar_id', $request->id)->first();
        $DKamar = D_Kamar::where('h_kamar_id', $request->id)->first();
        $Kamar = Kamar::where('kamar_id', $DKamar->kamar_id)->first();

        return view("userHistoryDetail", ['HKamar' => $HKamar, 'DKamar' => $DKamar, 'Kamar'=>$Kamar]);
    }

    public function user_history_food(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $listTenant = Tenant::where('nama', 'like', '%' . $search . '%')->get();
            $arrayTenant = $listTenant->pluck('tenant_id')->toArray();

            $listHMenu = H_Menu::where('customer_id', Session::get('login_id'))
                ->whereIn('tenant_id', $arrayTenant)
                ->orWhereRaw("DATE_FORMAT(created_at, '%e %b %Y') LIKE ?", ['%' . $search . '%'])
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        }
        else{
            $listHMenu = H_Menu::where('customer_id', Session::get('login_id'))->orderBy('updated_at', 'desc')->paginate(10);
        }

        return view("userHistoryFood", ['listHMenu' => $listHMenu, 'search' => $search]);
    }

    public function user_history_detail_food(Request $request)
    {
        $HMenu = H_Menu::where('h_menu_id', $request->id)->first();
        $Tenant = Tenant::where('tenant_id', $HMenu->tenant_id)->first();

        $DMenu = D_Menu::where('h_menu_id', $request->id)->get();
        $arrayDMenu = $DMenu->pluck('menu_id')->toArray();

        $Menu = Menu::whereIn('menu_id', $arrayDMenu)->get();

        return view("userHistoryDetailFood", ['toggle'=>0, 'HMenu' => $HMenu, 'DMenu' => $DMenu, 'Tenant'=>$Tenant, 'Menu'=>$Menu]);
    }

    public function cart()
    {
        return view("cart");
    }
}
