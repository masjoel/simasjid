<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use App\Models\ProfilBisnis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $qry = Member::orderBy('id', 'desc');
        $profil_usaha = ProfilBisnis::first();
        $search = $request->input('search');
        $nomorArray =  str_replace("\r", "", explode("\n", $search));
        // $members = [];
        // $msg = 'Data lebih dari 200 baris, silakan periksa file Excel!';
        // if (count($nomorArray) <= 200) {
            $msg = '';
            $members = $qry->whereIn('nik', $nomorArray)->get();
        // }
        $title = 'Cek NIK';
        return view('ceknik', compact('members', 'title', 'profil_usaha', 'msg'));
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
    public function cek(string $nik)
    {
        return Member::where('nik', $nik)->get();
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
