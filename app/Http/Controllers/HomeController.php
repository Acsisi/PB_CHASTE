<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\H_Menu;
use App\Models\H_Bulan;
use App\Models\Testimony;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.dashboard');
    }

    public function getLanding(){
        // $listTestimony = Testimony::where('status', 1)->orderby('created_at', 'desc')->get();
        // return view('landing', ['listTestimony' => $listTestimony]);
        return view('landing');
    }

    // public function showtenant()
    // {
    //     $activeUser = Auth::user();

    //     $menus = Menu::where('user_id', $activeUser->user_id)->get();
    //     return view('pages.hlmnTenant', compact('menus'));

    // }
    // public function showReportTenant(Request $request)
    // {
    //     $activeUser = Auth::user();
    //     $user_id = $activeUser->user_id;
    //     $tenantId = $this->getTenantId($user_id);

    //     $bulan = $request->input('bulan', date('n'));
    //     $tahun = $request->input('tahun', date('Y'));

    //     $result = $this->kalkulasiduit($tenantId, $bulan, $tahun);


    //     $pengeluaran = H_Bulan::where('user_id', $user_id)
    //     ->where('status', 3)
    //     ->whereMonth('created_at', $bulan)
    //     ->whereYear('created_at', $tahun)
    //     ->get();

    //     $pendapatan = H_Menu::where('tenant_id', $tenantId)
    //     ->where('status', 2)
    //     ->whereMonth('created_at', $bulan)
    //     ->whereYear('created_at', $tahun)
    //     ->select('created_at', 'total')
    //     ->get();

    //     return view('pages.reportTenant', compact('pendapatan','result','pengeluaran', 'bulan', 'tahun'));

    // }

    // public function storePengeluaran(Request $request)
    // {
    //     $request->validate([
    //         'keterangan' => 'required|string',
    //         'nominal' => 'required|numeric',
    //     ]);

    //     $activeUser = Auth::user();
    //     $user_id = $activeUser->user_id;

    //     H_Bulan::create([
    //         'user_id' => $user_id,
    //         'keterangan' => $request->keterangan,
    //         'total' => $request->nominal,
    //         'status' => 3,
    //     ]);

    //     return redirect('/reportTenant');
    // }

    // public function kalkulasiduit($tenantId, $bulan, $tahun)
    // {
    //     $user_id = Auth::id();

    //     $totalPengeluaran = H_Bulan::where('user_id', $user_id)
    //     ->where('status', 3)
    //     ->whereMonth('created_at', $bulan)
    //     ->whereYear('created_at', $tahun)
    //     ->sum('total');

    //     $totalPendapatan = H_Menu::where('tenant_id', $tenantId)
    //     ->where('status', 2)
    //     ->whereMonth('created_at', $bulan)
    //     ->whereYear('created_at', $tahun)
    //     ->sum('total');


    //     $totalKerugian = $totalPengeluaran - $totalPendapatan;
    //     $totalKeuntungan = $totalPendapatan - $totalPengeluaran;

    //     if ($totalKerugian < 0) {
    //         $totalKerugian = 0;
    //     }

    //     if ($totalKeuntungan < 0) {
    //         $totalKeuntungan = 0;
    //     }

    //     return [
    //         'totalKerugian' => $totalKerugian,
    //         'totalPendapatan' => $totalPendapatan,
    //         'totalKeuntungan' => max(0, $totalKeuntungan),
    //         'totalPengeluaran' => $totalPengeluaran,

    //     ];
    // }

    // public function showOrders(Request $request)
    // {
    //     $activeUser = Auth::user();
    //     $user_id = $activeUser->user_id;
    //     $tenantId = $this->getTenantId($user_id);

    //     $tanggal = $request->input('tanggal', now()->toDateString());
    //     $orders = H_Menu::where('tenant_id', $tenantId);

    //     if (!empty($tanggal)) {
    //         $orders->whereDate('created_at', $tanggal);
    //     }

    //     $orders = $orders->get();

    //     return view('pages.ordersTenant', compact('orders'));

    // }
    // public function filter(Request $request)
    // {
    //     $activeUser = Auth::user();
    //     $user_id = $activeUser->user_id;
    //     $tenantId = $this->getTenantId($user_id);

    //     $tanggal = $request->input('tanggal');

    //     $orders = H_Menu::where('tenant_id', $tenantId);

    //     if (!empty($tanggal)) {
    //         $orders->whereDate('created_at', $tanggal);
    //     }

    //     $orders = $orders->get();

    //     return view('pages.ordersTenant', compact('orders'));
    // }

    // private function getTenantId($user_id)
    // {
    //     if ($user_id == 9) {
    //         return 1;
    //     } elseif ($user_id == 10) {
    //         return 2;
    //     } elseif ($user_id == 11) {
    //         return 3;
    //     }
    // }

    // public function terimaOrder($id)
    // {
    //     $menu = H_Menu::find($id);
    //     $activeUser = Auth::user();
    //     $user_id = $activeUser->user_id;
    //     $tenantId = $this->getTenantId($user_id);
    //     $orders = H_Menu::where('tenant_id', $tenantId);
    //     if ($menu) {
    //         $menu->status = 2;
    //         $menu->save();

    //     }

    //     return view('pages.ordersTenant', compact('orders'));
    // }

    // public function tolakOrder($id)
    // {
    //     $menu = H_Menu::find($id);
    //     $activeUser = Auth::user();
    //     $user_id = $activeUser->user_id;
    //     $tenantId = $this->getTenantId($user_id);
    //     $orders = H_Menu::where('tenant_id', $tenantId);
    //     if ($menu) {
    //         $menu->status = 0;
    //         $menu->save();


    //     }
    //     return view('pages.ordersTenant', compact('orders'));

    // }

    // public function editPengeluaran($id)
    // {
    //     $pengeluaran = H_Bulan::find($id);

    //     if (!$pengeluaran) {
    //         return redirect()->route('showReportTenant')->with('error', 'Pengeluaran tidak ditemukan.');
    //     }

    //     return view('pages.editPengeluaran', compact('pengeluaran'));
    // }

    // public function updatePengeluaran(Request $request, $id)
    // {
    //     $request->validate([
    //         'keterangan' => 'required|string',
    //         'nominal' => 'required|numeric',
    //     ]);

    //     $pengeluaran = H_Bulan::find($id);

    //     if (!$pengeluaran) {
    //         return redirect()->route('showReportTenant')->with('error', 'Pengeluaran tidak ditemukan.');
    //     }

    //     $pengeluaran->update([
    //         'keterangan' => $request->keterangan,
    //         'total' => $request->nominal,
    //     ]);

    //     return redirect()->route('showReportTenant')->with('success', 'Pengeluaran berhasil diperbarui.');
    // }

    // public function deletePengeluaran($id)
    // {
    //     $pengeluaran = H_Bulan::find($id);

    //     if ($pengeluaran) {
    //         $pengeluaran->delete();
    //         return redirect()->route('showReportTenant')->with('success', 'Pengeluaran berhasil dihapus.');
    //     }

    //     return redirect()->route('showReportTenant')->with('error', 'Pengeluaran tidak ditemukan.');
    // }


}
