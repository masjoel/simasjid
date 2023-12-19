<?php

namespace App\Exports;

use App\Models\Member;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class PesertaExport implements FromView
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $params = $this->request->all();
        $data = [
            'dataRows' => Member::leftJoin('provinsis', 'members.provinsi_id', '=', 'provinsis.id')->leftJoin('kabupatens', 'members.kabupaten_id', '=', 'kabupatens.id')->leftJoin('kecamatans', 'members.kecamatan_id', '=', 'kecamatans.id')->leftJoin('kelurahans', 'members.kelurahan_id', '=', 'kelurahans.id')->when($params['search'], function ($query, $search) {
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
                ->when($params['provinsi'], function ($query, $searchProv) {
                    $query->where('provinsis.id', '=', $searchProv);
                })
                ->when($params['kabupaten'], function ($query, $searchKab) {
                    $query->where('kabupatens.id', '=', $searchKab);
                })
                ->when($params['kecamatan'], function ($query, $searchKec) {
                    $query->where('kecamatans.id', '=', $searchKec);
                })
                ->when($params['kelurahan'], function ($query, $searchKel) {
                    $query->where('kelurahans.id', '=', $searchKel);
                })
                ->select('members.*', 'provinsis.name as provinsi', 'kabupatens.name as kabupaten', 'kabupatens.type as tipe_kab', 'kecamatans.name as kecamatan', 'kelurahans.name as kelurahan')
                ->orderBy('members.id', 'desc')->get(),
        ];
        if ($params['nik'] == 0) {
            return view('pages.peserta.export-tanpa-nik', $data);
        }
        return view('pages.peserta.export', $data);
    }
}
