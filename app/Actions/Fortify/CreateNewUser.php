<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Category;
use App\Models\Customer;
use App\Models\ProfilBisnis;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $input['email'] = $input['username'].'@'.$input['username'].'.com';
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', Rule::unique(User::class)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => $this->passwordRules(),
        ])->validate();
        // $username = "User_Name/With Spaces!123";
        // $username = preg_replace('/[^a-zA-Z0-9]+/', '.', $username);
        // $username = strtolower($username);
        $perusahaan = ProfilBisnis::create([
            'nama_client' => $input['name'],
            'nama_app' => 'Outlet Toko',
            'versi_app' => '1.0',
            'desc_app' => 'Aplikasi untuk menampilkan produk dan jasa di toko',
            'alamat_client' => 'Jl. Raya No.1',
            'signature' => $input['username'],
            'email' => $input['email'],
            'logo' => null,
            'jam' => now(),
            'mcad' => null,
            'init' => null,
            'bank' => null,
            'footnot' => 'Terimakasih atas kedatangan Anda',
            'jdigit' => 0,
            'jdelay' => 0,
        ]);
        $save = User::create([
            'perusahaan_id' => $perusahaan->id,
            'reff_id' => session('sess_outlet_id'),
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        session(['sess_prsh_id' => $perusahaan->id]);
        session(['sess_outlet_id' => $save->id]);
        return $save;
    }
}
