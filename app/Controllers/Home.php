<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('index');
    }
    public function inventarisasi()
    {
        return view('inventarisasi');
    }
    public function jadwal_imam()
    {
        return view('jadwal-imam');
    }
    public function kegiatan()
    {
        return view('kegiatan');
    }
    public function penduduk()
    {
        return view('penduduk');
    }
}
