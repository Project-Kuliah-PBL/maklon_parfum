<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aroma;
use App\Models\Kemasan;


class KomponenProduksiController extends Controller
{
    //
    public function storeAroma(Request $request)
    {
        $request->validate([
            'nama_kategori'=>'required',
            'biaya_kategori'=>'required|numeric'
        ]);

        Aroma::create($request->all());

        return back()->with('success','Aroma berhasil ditambahkan');
    }


    public function updateAroma(Request $request,$id)
    {
        $aroma=Aroma::findOrFail($id);

        $aroma->update($request->all());

        return back()->with('success','Aroma berhasil diupdate');
    }


    public function deleteAroma($id)
    {
        Aroma::findOrFail($id)->delete();

        return back()->with('success','Aroma berhasil dihapus');
    }



    public function storeKemasan(Request $request)
    {
        $request->validate([
            'jenis_botol'=>'required',
            'ukuran'=>'required',
            'biaya_kemasan'=>'required|numeric'
        ]);

        Kemasan::create($request->all());

        return back()->with('success','Kemasan berhasil ditambahkan');
    }


    public function updateKemasan(Request $request,$id)
    {
        $kemasan=Kemasan::findOrFail($id);

        $kemasan->update($request->all());

        return back()->with('success','Kemasan berhasil diupdate');
    }


    public function deleteKemasan($id)
    {
        Kemasan::findOrFail($id)->delete();

        return back()->with('success','Kemasan berhasil dihapus');
    }

}
