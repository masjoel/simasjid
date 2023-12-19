<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Member;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', date('m'));
        $searchProv = $request->input('search_prov');
        $searchKab = $request->input('search_kab');
        $searchKec = $request->input('search_kec');
        $searchKel = $request->input('search_kel');
        $limit = $request->input('limit', 5);
        $data_provinsi = Provinsi::all();
        $data_kabupaten = Kabupaten::where('provinsi_id', $searchProv == null ? 1 : $searchProv)->get();
        $data_kecamatan = Kecamatan::where('kabupaten_id', $searchKab == null ? 1 : $searchKab)->get();
        $data_kelurahan = Kelurahan::where('kecamatan_id', $searchKec == null ? 1 : $searchKec)->get();


        if ($searchProv == '') {
            $provinsi = Member::select(
                'provinsis.id',
                'provinsis.name',
                Member::raw('count(members.provinsi_id) as jumlah'),
                Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                
            )
                ->leftJoin('provinsis', 'provinsis.id', '=', 'members.provinsi_id')
                ->when($searchProv, function ($query, $searchProv) {
                    $query->where('provinsis.id', '=', $searchProv);
                })
                ->groupBy('provinsis.id', 'provinsis.name')
                ->orderBy('jumlah', 'desc')
                ->paginate($limit);
            $kabupaten = Member::select(
                'kabupatens.id',
                'type',
                'name',
                Member::raw('count(members.kabupaten_id) as jumlah'),
                Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                
            )->leftJoin('kabupatens', 'members.kabupaten_id', '=', 'kabupatens.id')
                ->groupBy('id', 'type', 'name')
                ->limit(5)
                ->orderBy('jumlah', 'desc')
                ->get();
            $kecamatan = Member::select(
                'kecamatans.id',
                'name',
                Member::raw('count(members.kecamatan_id) as jumlah'),
                Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                
            )->leftJoin('kecamatans', 'members.kecamatan_id', '=', 'kecamatans.id')
                ->groupBy('id', 'name')
                ->limit(5)
                ->orderBy('jumlah', 'desc')
                ->get();
            $kelurahan = Member::select(
                'kelurahans.id',
                'name',
                Member::raw('count(members.kelurahan_id) as jumlah'),
                Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                
            )->leftJoin('kelurahans', 'kelurahans.id', '=', 'members.kelurahan_id')
                ->groupBy('id', 'name')
                ->orderBy('jumlah', 'desc')
                ->limit(5)
                ->get();
        } else {
            $provinsi = Member::select(
                'provinsis.id',
                'name',
                Member::raw('count(members.provinsi_id) as jumlah'),
                Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                
            )->leftJoin('provinsis', 'members.provinsi_id', '=', 'provinsis.id')
                ->where('provinsis.id', '=', $searchProv)
                ->groupBy('id', 'name')
                ->orderBy('jumlah', 'desc')
                ->get();

            if ($searchKab == '') {
                $kabupaten = Member::select(
                    'kabupatens.id',
                    'type',
                    'name',
                    Member::raw('count(members.kabupaten_id) as jumlah'),
                    Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                    Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                    
                )->leftJoin('kabupatens', 'members.kabupaten_id', '=', 'kabupatens.id')
                    ->when($searchKab, function ($query, $searchKab) {
                        $query->where('kabupatens.id', '=', $searchKab);
                    })
                    ->where('kabupatens.provinsi_id', '=', $searchProv)
                    ->groupBy('id', 'type', 'name')
                    ->orderBy('jumlah', 'desc')
                    ->paginate($limit);
                $kecamatan = Member::select(
                    'kecamatans.id',
                    'name',
                    Member::raw('count(members.kecamatan_id) as jumlah'),
                    Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                    Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                    
                )->leftJoin('kecamatans', 'members.kecamatan_id', '=', 'kecamatans.id')
                    ->groupBy('id', 'name')
                    ->limit(5)
                    ->orderBy('jumlah', 'desc')
                    ->get();
                $kelurahan = Member::select(
                    'kelurahans.id',
                    'name',
                    Member::raw('count(members.kelurahan_id) as jumlah'),
                    Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                    Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                    
                )->leftJoin('kelurahans', 'kelurahans.id', '=', 'members.kelurahan_id')
                    ->groupBy('id', 'name')
                    ->orderBy('jumlah', 'desc')
                    ->limit(5)
                    ->get();
            } else {
                $kabupaten = Member::select(
                    'kabupatens.id',
                    'type',
                    'name',
                    Member::raw('count(members.kabupaten_id) as jumlah'),
                    Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                    Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                    
                )->leftJoin('kabupatens', 'members.kabupaten_id', '=', 'kabupatens.id')
                    ->where('kabupatens.id', '=', $searchKab)
                    ->groupBy('id', 'type', 'name')
                    ->orderBy('jumlah', 'desc')
                    ->get();
                if ($searchKec == '') {
                    $kecamatan = Member::select(
                        'kecamatan_id',
                        'name',
                        Member::raw('count(members.kecamatan_id) as jumlah'),
                        Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                        Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                        
                    )->leftJoin('kecamatans', 'kecamatans.id', '=', 'members.kecamatan_id')
                        ->when($searchKec, function ($query, $searchKec) {
                            $query->where('kecamatans.id', '=', $searchKec);
                        })
                        ->where('kecamatans.kabupaten_id', '=', $searchKab)
                        ->groupBy('kecamatan_id', 'name')
                        ->orderBy('jumlah', 'desc')
                        ->paginate($limit);

                    $kelurahan = Member::select(
                        'kelurahans.id',
                        'name',
                        Member::raw('count(members.kelurahan_id) as jumlah'),
                        Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                        Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                        
                    )->leftJoin('kelurahans', 'kelurahans.id', '=', 'members.kelurahan_id')
                        ->groupBy('id', 'name')
                        ->orderBy('jumlah', 'desc')
                        ->limit(5)
                        ->get();
                } else {
                    $kecamatan = Member::select(
                        'kecamatans.id',
                        'name',
                        Member::raw('count(members.kecamatan_id) as jumlah'),
                        Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                        Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                        
                    )->leftJoin('kecamatans', 'kecamatans.id', '=', 'members.kecamatan_id')
                        ->where('kecamatans.id', '=', $searchKec)
                        ->groupBy('id', 'name')
                        ->orderBy('jumlah', 'desc')
                        ->get();

                    $kelurahan = Member::select(
                        'kelurahans.id',
                        'name',
                        Member::raw('count(members.kelurahan_id) as jumlah'),
                        Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as total_daeng'),
                        Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as total_anjar'),
                        
                    )->leftJoin('kelurahans', 'kelurahans.id', '=', 'members.kelurahan_id')
                        ->when($searchKel, function ($query, $searchKel) {
                            $query->where('kelurahans.id', '=', $searchKel);
                        })
                        ->where('kelurahans.kecamatan_id', '=', $searchKec)
                        ->groupBy('id', 'name')
                        ->orderBy('jumlah', 'desc')
                        ->paginate($limit);
                }
            }
        }
        $new_member = Member::limit(5)->orderBy('created_at', 'desc')->get();
        $totalMembers = Member::select(
            DB::raw('count(distinct provinsi_id) as total_provinsi'),
            DB::raw('count(distinct kabupaten_id) as total_kabupaten'),
            DB::raw('count(distinct kecamatan_id) as total_kecamatan'),
            DB::raw('count(distinct kelurahan_id) as total_kelurahan'),
            DB::raw('count(id) as total_saksi'),
            Member::raw('count(case when members.tipe = "daengfaqih" then 1 else null end) as grand_total_daeng'),
            Member::raw('count(case when members.tipe = "anjar" then 1 else null end) as grand_total_anjar'),
        )->first();

        $qry = Member::select(
            Member::raw('distinct DATE(created_at) as tanggal'),
            Member::raw('COUNT(id) as qty'),
        );
        $qry->when($search, function ($query, $search) {
            $query->whereMonth('created_at', '=', $search)
                ->whereYear('created_at', '=', date('Y'));
        })->groupBy('tanggal')->orderBy('tanggal', 'asc')->get();
        $tgl = $qry->pluck('tanggal')->toArray();
        $qty = $qry->pluck('qty')->toArray();
        $title = 'Dashboard';
        return view('pages.dashboard-general', compact('title',  'new_member', 'tgl', 'qty', 'provinsi', 'data_provinsi', 'search', 'searchProv', 'kabupaten', 'data_kabupaten', 'searchKab', 'kecamatan', 'data_kecamatan', 'searchKec', 'kelurahan', 'data_kelurahan', 'searchKel', 'totalMembers'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
