<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Member;
use App\Models\Category;
use App\Models\Customer;
use App\Models\ImageResize;
use App\Models\ProfilBisnis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(User::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')->when($request->input('search'), function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('username', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('roles', 'like', '%' . $search . '%');
        })->paginate(10);
        $title = 'User';
        return view('pages.user.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'New User';
        return view('pages.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        $new = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'roles' => $request['roles'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'perusahaan_id' => 1,
        ]);
        Member::where('nama', $request['name'])->update([
            'dante_id' => $new->id,
        ]);
        DB::commit();
        return redirect(route('user.index'))->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('pages.user.edit')->with(['user' => $user, 'title' => 'Edit User']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $imagePath = $user->avatar;
        $pass = $user->password;
        if ($request->password) {
            $pass = Hash::make($request->password);
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $extFile = $avatar->getClientOriginalExtension();
            $fileSize = $avatar->getSize();
            $fileSizeInKB = $fileSize / 1024;
            $fileSizeInMB = $fileSizeInKB / 1024;

            if (!in_array($extFile, ['jpeg', 'png', 'jpg', 'gif', 'svg', 'webp']) || $fileSizeInMB > 8) {
                return back()->with('error', 'File harus berupa image (jpeg, png, jpg, gif, svg, webp) max. size 8 MB')->withInput();
            }
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $nameFile = Uuid::uuid1()->getHex() . '.' . $extFile;
            $imagePath = $avatar->storeAs('profile_img', $nameFile, 'public');

            $smallthumbnailpath = public_path('storage/profile_img/' . $nameFile);
            $imageInfo = ImageResize::getFileImageSize($smallthumbnailpath);
            if ($imageInfo) {
                $width = $imageInfo['width'];
                $height = $imageInfo['height'];
            }
            if ($width >= 300 || $height >= 185) {
                ImageResize::createThumbnail($smallthumbnailpath, 300, 185);
            }
        }
        $validate = $request->validated();
        $validate['avatar'] = $imagePath;
        $validate['password'] = $pass;
        $user->update($validate);
        return redirect()->route('user.index')->with('success', 'Edit User Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        $clientIP = request()->ip();
        $log = [
            'iduser' => auth()->user()->id,
            'nama' => auth()->user()->username,
            'level' => auth()->user()->roles,
            'datetime' => date('Y-m-d H:i:s'),
            'do' => 'delete '.$user->nik.' - '.$user->nama,
            'ipaddr' => $clientIP,
        ];
        DB::table('userlog')->insert($log);
        $user->delete();
        DB::commit();
        return response()->json([
            'status' => 'success',
            'message' => 'Succesfully Deleted Data'
        ]);
    }
}
