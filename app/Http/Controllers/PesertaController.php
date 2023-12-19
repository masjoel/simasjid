<?php

namespace App\Http\Controllers;

use App\Exports\PesertaExport;
use App\Models\Member;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\UpdateMemberRequest;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $nomor = ($page - 1) * $limit + 1;
        $qry = Member::leftJoin('provinsis', 'members.provinsi_id', '=', 'provinsis.id')->leftJoin('kabupatens', 'members.kabupaten_id', '=', 'kabupatens.id')->leftJoin('kecamatans', 'members.kecamatan_id', '=', 'kecamatans.id')->leftJoin('kelurahans', 'members.kelurahan_id', '=', 'kelurahans.id');

        $pesertas = $qry->when($request->input('search'), function ($query, $search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('members.nama', 'like', '%' . $search . '%');
            })->orWhere(function ($subQuery) use ($search) {
                $subQuery->where('members.nik', 'like', '%' . $search . '%');
            })->orWhere(function ($subQuery) use ($search) {
                $subQuery->where('members.telpon', 'like', '%' . $search . '%');
            })->orWhere(function ($subQuery) use ($search) {
                $subQuery->where('members.alamat', 'like', '%' . $search . '%');
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
            ->select('members.*', 'provinsis.name as provinsi', 'kabupatens.name as kabupaten', 'kabupatens.type as tipe_kab', 'kecamatans.name as kecamatan', 'kelurahans.name as kelurahan')
            ->orderBy('members.id', 'desc')
            ->paginate($limit);
        $provinsi = Provinsi::all();
        $title = 'Peserta PKH Plus';
        return view('pages.peserta.index', compact('pesertas', 'nomor', 'title', 'provinsi'));
    }

    public function exportToExcel(Request $request)
    {
        return Excel::download(new PesertaExport($request), 'data-peserta-pkh-plus.xlsx');
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
    public function show(Member $pesertum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $pesertum)
    {
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::where('provinsi_id', $pesertum->provinsi_id)->get();
        $kecamatan = Kecamatan::where('kabupaten_id', $pesertum->kabupaten_id)->get();
        $kelurahan = Kelurahan::where('kecamatan_id', $pesertum->kecamatan_id)->get();
        return view('pages.peserta.edit')->with(['title' => 'Edit Peserta PKH Plus', 'pemilih' => $pesertum, 'provinsi' => $provinsi, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $pesertum)
    {
        DB::beginTransaction();
        $validate = $request->validated();
        $validate['passport'] = $request->nik;
        $pesertum->update($validate);
        DB::commit();
        return redirect()->route('peserta.index')->with('success', 'Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $pesertum)
    {
        DB::beginTransaction();

        $clientIP = request()->ip();
        $log = [
            'iduser' => auth()->user()->id,
            'nama' => auth()->user()->username,
            'level' => auth()->user()->roles,
            'datetime' => date('Y-m-d H:i:s'),
            'do' => 'delete ' . $pesertum->nik . ' - ' . $pesertum->nama,
            'ipaddr' => $clientIP,
        ];
        DB::table('userlog')->insert($log);
        $pesertum->delete();
        DB::commit();
        return response()->json([
            'status' => 'success',
            'message' => 'Succesfully Deleted Data'
        ]);
    }
}
