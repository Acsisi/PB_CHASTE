<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Menu;
use App\Models\Tenant;
use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KosController extends Controller
{
    //
    public function getKamarAC(){
        $listKamar = Kamar::where('status', 1)->where('penyewa_id', NULL)->where('AC', 'AC')->get();
        $title = "With AC";
        $deskripsi = "The room options include AC, providing a cool and more comfortable temperature.";

        return view('kos', ['listKamar' => $listKamar, 'title'=>$title, 'deskripsi'=>$deskripsi]);
    }

    public function getKamarNonAC(){
        $listKamar = Kamar::where('status', 1)->where('penyewa_id', NULL)->where('AC', 'Non-AC')->get();
        $title = "Without AC";
        $deskripsi = "The room options do not include AC, providing a cheaper price for your wallet.";

        return view('kos', ['listKamar' => $listKamar, 'title'=>$title, 'deskripsi'=>$deskripsi]);
    }

    public function getKamarDetail(Request $request){
        $kamar = Kamar::where('kamar_id', $request->id)->first();

        return view('kos-detail', ['kamar' => $kamar]);
    }

    public function addKos(Request $request){
        $namaFolderPhoto = ""; $namaFilePhoto = "";
        foreach ($request->file("photo") as $photo) {
            $namaFilePhoto  = $photo->getClientOriginalName();
            $namaFolderPhoto = "kamar/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }

        DB::table('kamar')->insert([
            'user_id' => 1,
            'nama' => $request->name,
            'harga' => $request->price,
            'foto' => $namaFolderPhoto.$namaFilePhoto,
            'deskripsi' => $request->desc,
            'AC' => $request->exampleRadio,
            'status' => 1
        ]);

        return redirect('/kamarkos');
    }

    public function editKos(Request $request){
        return redirect('/editKos?kamar_id=' . ($request->id));
    }

    public function changeKos(Request $request){
        $request->validate(
            [
                "photo" => "required",
                'name' => 'required',  
                'price' => 'required',
                'desc'=> 'required',
                'exampleRadio'=> 'required',
            ],
            [
                "required" => "Fill the blank",
            ]
        );
        $namaFolderPhoto = ""; $namaFilePhoto = "";
        foreach ($request->file("photo") as $photo) {
            $namaFilePhoto  = $photo->getClientOriginalName();
            $namaFolderPhoto = "kamar/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }

        $id = $request->id;
        DB::table('kamar')->where('kamar_id', '=', $id)->update([
            'nama' => $request->name,
            'harga' => $request->price,
            'foto' => $namaFolderPhoto.$namaFilePhoto,
            'deskripsi' => $request->desc,
            'AC' =>$request->exampleRadio,
        ]);
        return redirect('/kamarkos');
    }

    public function deleteKos(Request $request){
        $Kos = Kamar::where('kamar_id', $request->id)->first();
        DB::table('kamar')->where('kamar_id', '=', $Kos->kamar_id)->update([
            'status' => 0 //DIHAPUS
        ]);

        return redirect('/kamarkos');
    }
}
