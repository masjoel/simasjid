<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\ProfilBisnis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreMemberRequest;

class FormulirContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function formPejuang(Request $request)
    {
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        $profil_usaha = ProfilBisnis::first();
        $title = 'Pendaftaran PKH Plus';
        return view('pejuangsaksi', compact('title', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'profil_usaha'));
    }

    public function storePejuang(StoreMemberRequest $request)
    {
        DB::beginTransaction();
        Member::create([
            'nama' => $request['nama'],
            'nik' => $request['nik'],
            'passport' => $request['nik'],
            'telpon' => $request['telpon'],
            'alamat' => $request['alamat'],
            'rt' => $request['rt'],
            'rw' => $request['rw'],
            'provinsi_id' => $request['provinsi_id'],
            'kabupaten_id' => $request['kabupaten_id'],
            'kecamatan_id' => $request['kecamatan_id'],
            'kelurahan_id' => $request['kelurahan_id'],
        ]);
        DB::commit();
        return redirect(route('form.pejuang'))->with('success', 'Data berhasil ditambahkan');
    }
}
