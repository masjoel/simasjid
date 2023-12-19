<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provinsi extends Model
{
    use HasFactory;
    public function dante(): HasMany
    {
        return $this->hasMany(Dante::class);
    }
    public function member(): HasMany
    {
        return $this->hasMany(Member::class);
    }
    public function ketuatim(): HasMany
    {
        return $this->hasMany(KetuaTim::class);
    }
}
