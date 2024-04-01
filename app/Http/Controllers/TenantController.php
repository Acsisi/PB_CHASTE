<?php

namespace App\Http\Controllers;

use App\Models\H_Tenant;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    public function addTenant(Request $request){
        $namaFolderPhoto = ""; $namaFilePhoto = "";
        foreach ($request->file("photo") as $photo) {
            $namaFilePhoto  = $photo->getClientOriginalName();
            $namaFolderPhoto = "tenant/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }

        DB::table('tenant')->insert([
            'user_id' => 1,
            'nama' => $request->name,
            'harga' => $request->price,
            'foto' => $namaFolderPhoto.$namaFilePhoto,
            'deskripsi' => $request->desc,
            'status' => 1
        ]);

        return redirect('/tenant');
    }

    public function editTenant(Request $request){
        return redirect('/editTenant?tenant_id=' . ($request->id));
    }

    public function changeTenant(Request $request){
        $request->validate(
            [
                "photo" => "required",
                'name' => 'required',  
                'price' => 'required',
                'desc'=> 'required',  
            ],
            [
                "required" => "Fill the blank",
            ]
        );
        $namaFolderPhoto = ""; $namaFilePhoto = "";
        foreach ($request->file("photo") as $photo) {
            $namaFilePhoto  = $photo->getClientOriginalName();
            $namaFolderPhoto = "tenant/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }

        $id = $request->id;

        if(isset($request->penyewa)){
            DB::table('tenant')->where('tenant_id', '=', $id)->update([
                'nama' => $request->name,
                'harga' => $request->price,
                'penyewa_id' => $request->penyewa,
                'foto' => $namaFolderPhoto.$namaFilePhoto,
                'deskripsi' => $request->desc,
            ]);

            DB::table('h_tenant')->insert([
                'user_id' => 1,
                'penyewa_id' => $request->penyewa,
                'total' => $request->price,
                'status' => 1
                //status 1 sudah dibayar
            ]);
    
            $h_tenant = H_Tenant::latest()->first();
            DB::table('d_tenant')->insert([
                'h_tenant_id' => $h_tenant->h_tenant_id,
                'tenant_id' => $request->id,
                'harga' =>  $request->price,
                'status' => 1
                //status 1 sudah dibayar
            ]);
    
        }else{
            DB::table('tenant')->where('tenant_id', '=', $id)->update([
                'nama' => $request->name,
                'harga' => $request->price,
                'foto' => $namaFolderPhoto.$namaFilePhoto,
                'deskripsi' => $request->desc,
            ]);
        }
        return redirect('/tenant');
    }

    public function deleteTenant(Request $request){
        $Tenant = Tenant::where('tenant_id', $request->id)->first();
        DB::table('tenant')->where('tenant_id', '=', $Tenant->tenant_id)->update([
            'status' => 0 //DIHAPUS
        ]);

        return redirect('/tenant');
    }
}
