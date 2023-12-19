<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Member;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\ImageResize;
use App\Http\Requests\StoreMemberRequest;
use App\Models\Dante;
use App\Models\ProfilBisnis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function index(Request $request)
    {
        $profil_usaha = ProfilBisnis::first();
        $title = 'Calon Pemilih';
        return view('home', compact('title', 'profil_usaha'));
    }
    function save(StoreMemberRequest $request)
    {
        DB::beginTransaction();
        $avatarPath = null;
        $imagePath = null;
        // if ($request->hasFile('avatar_url')) {
        //     $avatar_url = $request->file('avatar_url');
        //     $extFile = $avatar_url->getClientOriginalExtension();
        //     $fileSize = $avatar_url->getSize();
        //     $fileSizeInKB = $fileSize / 1024;
        //     $fileSizeInMB = $fileSizeInKB / 1024;

        //     if (!in_array($extFile, ['jpeg', 'png', 'jpg', 'gif', 'svg', 'webp']) || $fileSizeInMB > 8) {
        //         return back()->with('error', 'File harus berupa image (jpeg, png, jpg, gif, svg, webp) max. size 8 MB')->withInput();
        //     }
        //     $nameFile = Uuid::uuid1()->getHex() . '.' . $extFile;
        //     $avatarPath = $avatar_url->storeAs('profile_img', $nameFile, 'public');
        //     $smallthumbnailpath = public_path('storage/profile_img/' . $nameFile);

        //     $imageInfo = ImageResize::getFileImageSize($smallthumbnailpath);
        //     if ($imageInfo) {
        //         $width = $imageInfo['width'];
        //         $height = $imageInfo['height'];
        //     }
        //     if ($width >= 800 || $height >= 600) {
        //         ImageResize::createThumbnail($smallthumbnailpath, 800, 600);
        //     }
        // }
        // if ($request->hasFile('image_url')) {
        //     $image_url = $request->file('image_url');
        //     $extFile = $image_url->getClientOriginalExtension();
        //     $fileSize = $image_url->getSize();
        //     $fileSizeInKB = $fileSize / 1024;
        //     $fileSizeInMB = $fileSizeInKB / 1024;

        //     if (!in_array($extFile, ['jpeg', 'png', 'jpg', 'gif', 'svg', 'webp']) || $fileSizeInMB > 8) {
        //         return back()->with('error', 'File harus berupa image (jpeg, png, jpg, gif, svg, webp) max. size 8 MB')->withInput();
        //     }
        //     $nameFile = Uuid::uuid1()->getHex() . '.' . $extFile;
        //     $imagePath = $image_url->storeAs('profile_img', $nameFile, 'public');
        //     $smallthumbnailpath = public_path('storage/profile_img/' . $nameFile);

        //     $imageInfo = ImageResize::getFileImageSize($smallthumbnailpath);
        //     if ($imageInfo) {
        //         $width = $imageInfo['width'];
        //         $height = $imageInfo['height'];
        //     }
        //     if ($width >= 800 || $height >= 600) {
        //         ImageResize::createThumbnail($smallthumbnailpath, 800, 600);
        //     }
        // }
        // if ($request['dante_id'] == 0) {
        //     $dante = Dante::create([
        //         'nama' => $request['dante_lain'],
        //     ]);
        //     $request['dante_id'] = $dante->id;
        // }
        Member::create([
            'nama' => $request['nama'],
            'nik' => $request['nik'],
            'passport' => $request['nik'],
            'telpon' => $request['telpon'],
            'dante_id' => $request['dante_id'],
            'provinsi_id' => $request['provinsi_id'],
            'kabupaten_id' => $request['kabupaten_id'],
            'kecamatan_id' => $request['kecamatan_id'],
            'kelurahan_id' => $request['kelurahan_id'],
            'avatar' => $avatarPath,
            'image' => $imagePath,
            'nomor_tps' => $request['nomor_tps'],
            'tipe' => 'dante',
        ]);
        DB::commit();
        return redirect(route('home'))->with('success', 'Data berhasil ditambahkan');
    }
}
