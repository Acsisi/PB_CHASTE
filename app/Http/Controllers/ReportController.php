<?php

namespace App\Http\Controllers;

use App\Models\H_Bulan;
use App\Models\H_Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function addExpense(Request $request){
        DB::table('h_bulan')->insert([
            'user_id' => 1,
            'total' => $request->total,
            'status' => 0,
            'keterangan' => $request->desc,
            'created_at' => $request->income_date
            //expense status 0
        ]);

        $h_bulan = H_Bulan::latest()->first();
        DB::table('d_bulan')->insert([
            'h_bulan_id' => $h_bulan->h_bulan_id,
            'harga' => $request->total,
            'status' => 0,
            'keterangan' => $request->desc,
        ]);

        return redirect('/pengeluaranOwner');
    }

    public function addIncome(Request $request){
        if($request->exampleRadio == 1){
            // DB::table('h_kamar')->insert([
            //     'user_id' => 1,
            //     'penyewa_id' => intval($request->penyewa),
            //     'total' => intval($request->total),
            //     //status 1 sudah dibayar
            //     'created_at' => $request->income_date
            // ]);

            // $hKamarId = DB::table('h_kamar')->insertGetId([
            //     'user_id' => 1,
            //     'penyewa_id' => intval($request->penyewa),
            //     'total' => intval($request->total),
            //     'created_at' => $request->income_date
            // ]);

            // $kamarId = DB::table('d_kamar')
            // ->join('h_kamar', 'd_kamar.h_kamar_id', '=', 'h_kamar.h_kamar_id')
            // ->where('h_kamar.penyewa_id', $request->penyewa)
            // ->orderBy('d_kamar.d_kamar_id', 'desc')
            // ->value('d_kamar.kamar_id'); 

            // DB::table('d_kamar')->insert([
            //     'h_kamar_id' => $hKamarId,
            //     'kamar_id' => $kamarId,
            //     'harga' => intval($request->total)
            //     //status 1 sudah dibayar
            // ]);

            // Mengambil data dari request
            $userId = 1;
            $penyewaId = intval($request->penyewa);
            $total = intval($request->total);
            $incomeDate = $request->income_date;

            // Insert ke tabel h_kamar dan mendapatkan h_kamar_id yang baru diinsertkan
            $hKamarId = DB::table('h_kamar')->insertGetId([
                'user_id' => $userId,
                'penyewa_id' => $penyewaId,
                'total' => $total,
                'created_at' => $incomeDate
            ]);

            // Mengambil kamar_id dari pembayaran user sebelumnya di tabel d_kamar
            $kamarId = DB::table('d_kamar')
            ->join('h_kamar', 'd_kamar.h_kamar_id', '=', 'h_kamar.h_kamar_id')
            ->where('h_kamar.penyewa_id', $request->penyewa)
            ->orderBy('d_kamar.d_kamar_id', 'desc')
            ->value('d_kamar.kamar_id');

            // Pastikan untuk memeriksa apakah $kamarId ada sebelum insert
            if ($kamarId !== null) {
                DB::table('d_kamar')->insert([
                    'h_kamar_id' => $hKamarId,
                    'kamar_id' => $kamarId,
                    'harga' => $total,
                ]);
            } else {
            }

        }else{
            DB::table('h_galon')->insert([
                'penyewa_id' => $request->penyewa2,
                // 'pcs' => $request->pcs,
                'pcs' => 1,
                'harga' => 20000,
                'status' => 1,
                //status 1 sudah dibayar,
                'created_at' => $request->income_date
            ]);

            DB::table('user')
            ->where('user_id', '=', $request->penyewa2)
            ->update([
                'status_galon' => 2,
            ]);
        }

        return redirect('/pengeluaranOwner');
    }

    public function changeExpense(Request $request){
        return redirect('/editExpense?h_bulan_id=' . ($request->id));
    }

    public function editExpense(Request $request){
        $request->validate(
            [
                'total' => 'required',
                'desc'=> 'required',
            ],
            [
                "required" => "Fill the blank",
            ]
        );
        $id = $request->id;
        DB::table('h_bulan')->where('h_bulan_id', '=', $id)->update([
            'total' => $request->total,
            'keterangan' => $request->desc,
        ]);
        return redirect('/pengeluaranOwner');
    }

    public function deleteExpense(Request $request){
        $Expense = H_Bulan::where('h_bulan_id', $request->id)->first();
        DB::table('h_bulan')->where('h_bulan_id', '=', $Expense->h_bulan_id)->update([
            'status' => 4 //DIHAPUS
        ]);

        return redirect('/pengeluaranOwner');
    }
}
