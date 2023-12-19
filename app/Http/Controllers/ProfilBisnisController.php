<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\ImageResize;
use App\Models\ProfilBisnis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfilBizRequest;

class ProfilBisnisController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ProfilBisnis::class, 'profil_bisni');        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(ProfilBisnis $profil_bisni)
    {
        $profil = $profil_bisni;
        return response()->json(['profil' => $profil]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfilBisnis $profil_bisni)
    {
        return view('pages.profile.edit')->with(['profilBisnis' => $profil_bisni, 'title' => 'Profil']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfilBizRequest $request, ProfilBisnis $profil_bisni)
    {
        DB::beginTransaction();
        $imagePath = $profil_bisni->logo;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $extFile = $logo->getClientOriginalExtension();
            $fileSize = $logo->getSize();
            $fileSizeInKB = $fileSize / 1024;
            $fileSizeInMB = $fileSizeInKB / 1024;

            if (!in_array($extFile, ['jpeg', 'png', 'jpg', 'gif', 'svg', 'webp']) || $fileSizeInMB > 8) {
                return back()->with('error', 'File harus berupa image (jpeg, png, jpg, gif, svg, webp) max. size 8 MB')->withInput();
            }
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $nameFile = Uuid::uuid1()->getHex() . '.' . $extFile;
            $imagePath = $logo->storeAs('profile_img', $nameFile, 'public');

            $smallthumbnailpath = public_path('storage/profile_img/' . $nameFile);
            $imageInfo = ImageResize::getFileImageSize($smallthumbnailpath);
            if ($imageInfo) {
                $width = $imageInfo['width'];
                $height = $imageInfo['height'];
            }
            if ($width >= 185 || $height >= 185) {
                ImageResize::createThumbnail($smallthumbnailpath, 185, 185);
            }
        }
        $validate = $request->validated();
        $validate['logo'] = $imagePath;
        $profil_bisni->update($validate);
        DB::commit();
        return back()->with('success', 'Edit Profil Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfilBisnis $profil_bisni)
    {
        //
    }
}
