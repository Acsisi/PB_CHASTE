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
        $title = "dengan AC";
        $deskripsi = "Opsi kamar sudah termasuk AC sehingga memberikan suhu yang sejuk dan nyaman.";

        return view('kos', ['listKamar' => $listKamar, 'title'=>$title, 'deskripsi'=>$deskripsi]);
    }

    public function getKamarNonAC(){
        $listKamar = Kamar::where('status', 1)->where('penyewa_id', NULL)->where('AC', 'Non-AC')->get();
        $title = "Tanpa AC";
        $deskripsi = "Opsi kamar tidak termasuk AC sehingga memberikan harga yang lebih murah.";

        return view('kos', ['listKamar' => $listKamar, 'title'=>$title, 'deskripsi'=>$deskripsi]);
    }

    public function getKamarDetail(Request $request){
        $kamar = Kamar::where('kamar_id', $request->id)->first();

        return view('kos-detail', ['kamar' => $kamar]);
    }

    public function addKos(Request $request){
        $namaFolderPhoto = ""; $namaFilePhoto = "";
        $namaFolderPhoto2 = ""; $namaFilePhoto2 = "";
        $namaFolderPhoto3 = ""; $namaFilePhoto3 = "";
        $namaPhoto2 = NULL;
        $namaPhoto3 = NULL;

        foreach ($request->file("photo") as $photo) {
            $namaFilePhoto  = $photo->getClientOriginalName();
            $namaFolderPhoto = "kamar/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }

        if ($request->file("photo2")){
            foreach ($request->file("photo2") as $photo2) {
                $namaFilePhoto2  = $photo2->getClientOriginalName();
                $namaFolderPhoto2 = "kamar/";

                $photo2->storeAs($namaFolderPhoto2,$namaFilePhoto2, 'public');
            }
            $namaPhoto2 = $namaFolderPhoto2.$namaFilePhoto2;
        }
        if ($request->file("photo3")){
            foreach ($request->file("photo3") as $photo3) {
                $namaFilePhoto3  = $photo3->getClientOriginalName();
                $namaFolderPhoto3 = "kamar/";

                $photo3->storeAs($namaFolderPhoto3,$namaFilePhoto3, 'public');
            }
            $namaPhoto3 = $namaFolderPhoto3.$namaFilePhoto3;
        }

        DB::table('kamar')->insert([
            'user_id' => 1,
            'nama' => $request->name,
            'harga' => $request->price,
            'foto' => $namaFolderPhoto.$namaFilePhoto,
            'foto2' => $namaPhoto2,
            'foto3' => $namaPhoto3,
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
        $namaFolderPhoto2 = ""; $namaFilePhoto2 = "";
        $namaFolderPhoto3 = ""; $namaFilePhoto3 = "";
        $namaPhoto2 = NULL;
        $namaPhoto3 = NULL;

        foreach ($request->file("photo") as $photo) {
            $namaFilePhoto  = $photo->getClientOriginalName();
            $namaFolderPhoto = "kamar/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }

        if ($request->file("photo2")){
            foreach ($request->file("photo2") as $photo2) {
                $namaFilePhoto2  = $photo2->getClientOriginalName();
                $namaFolderPhoto2 = "kamar/";

                $photo2->storeAs($namaFolderPhoto2,$namaFilePhoto2, 'public');
            }
            $namaPhoto2 = $namaFolderPhoto2.$namaFilePhoto2;
        }
        if ($request->file("photo3")){
            foreach ($request->file("photo3") as $photo3) {
                $namaFilePhoto3  = $photo3->getClientOriginalName();
                $namaFolderPhoto3 = "kamar/";

                $photo3->storeAs($namaFolderPhoto3,$namaFilePhoto3, 'public');
            }
            $namaPhoto3 = $namaFolderPhoto3.$namaFilePhoto3;
        }

        $id = $request->id;
        DB::table('kamar')->where('kamar_id', '=', $id)->update([
            'nama' => $request->name,
            'harga' => $request->price,
            'foto' => $namaFolderPhoto.$namaFilePhoto,
            'foto2' => $namaPhoto2,
            'foto3' => $namaPhoto3,
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
