<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use App\Exports\PendudukExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\UpdateMemberRequest;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $nomor = ($page - 1) * $limit + 1;
        $qry = Penduduk::leftJoin('provinsis', 'penduduks.provinsi_id', '=', 'provinsis.id')->leftJoin('kabupatens', 'penduduks.kabupaten_id', '=', 'kabupatens.id')->leftJoin('kecamatans', 'penduduks.kecamatan_id', '=', 'kecamatans.id')->leftJoin('kelurahans', 'penduduks.kelurahan_id', '=', 'kelurahans.id');

        $penduduks = $qry->when($request->input('search'), function ($query, $search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('penduduks.nama', 'like', '%' . $search . '%');
            })->orWhere(function ($subQuery) use ($search) {
                $subQuery->where('penduduks.nik', 'like', '%' . $search . '%');
            })->orWhere(function ($subQuery) use ($search) {
                $subQuery->where('penduduks.telpon', 'like', '%' . $search . '%');
            })->orWhere(function ($subQuery) use ($search) {
                $subQuery->where('penduduks.alamat', 'like', '%' . $search . '%');
            });
        })
            ->when($request->input('provinsi'), function ($query, $searchProv) {
                $query->where('provinsis.id', '=', $searchProv);
            })
            ->when($request->input('kabupaten'), function ($query, $searchKab) {
                $query->where('kabupatens.id', '=', $searchKab);
            })
            ->when($request->input('kecamatan'), function ($query, $searchKec) {
                $query->where('kecamatans.id', '=', $searchKec);
            })
            ->when($request->input('kelurahan'), function ($query, $searchKel) {
                $query->where('kelurahans.id', '=', $searchKel);
            })
            ->select('penduduks.*', 'provinsis.name as provinsi', 'kabupatens.name as kabupaten', 'kabupatens.type as tipe_kab', 'kecamatans.name as kecamatan', 'kelurahans.name as kelurahan')
            ->orderBy('penduduks.id', 'desc')
            ->paginate($limit);
        $provinsi = Provinsi::all();
        $title = 'Data Penduduk';
        return view('pages.penduduk.index', compact('penduduks', 'nomor', 'title', 'provinsi'));
    }

    public function exportToExcel(Request $request)
    {
        return Excel::download(new PendudukExport($request), 'data-peserta-pkh-plus.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::where('provinsi_id', $penduduk->provinsi_id)->get();
        $kecamatan = Kecamatan::where('kabupaten_id', $penduduk->kabupaten_id)->get();
        $kelurahan = Kelurahan::where('kecamatan_id', $penduduk->kecamatan_id)->get();
        return view('pages.penduduk.edit')->with(['title' => 'Edit Penduduk', 'pemilih' => $penduduk, 'provinsi' => $provinsi, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Penduduk $penduduk)
    {
        DB::beginTransaction();
        $validate = $request->validated();
        $penduduk->update($validate);
        DB::commit();
        return redirect()->route('penduduk.index')->with('success', 'Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        DB::beginTransaction();

        $clientIP = request()->ip();
        $log = [
            'iduser' => auth()->user()->id,
            'nama' => auth()->user()->username,
            'level' => auth()->user()->roles,
            'datetime' => date('Y-m-d H:i:s'),
            'do' => 'delete ' . $penduduk->nik . ' - ' . $penduduk->nama,
            'ipaddr' => $clientIP,
        ];
        DB::table('userlog')->insert($log);
        $penduduk->delete();
        DB::commit();
        return response()->json([
            'status' => 'success',
            'message' => 'Succesfully Deleted Data'
        ]);
    }
}
