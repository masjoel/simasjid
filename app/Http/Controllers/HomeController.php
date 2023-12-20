<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Models\ProfilBisnis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function index(Request $request)
    {
        $profil_usaha = ProfilBisnis::first();
        $title = 'Aplikasi Masjid';
        return view('home', compact('title', 'profil_usaha'));
    }
}
