<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class HargaParfum extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'jenis_parfum',
        'harga_per_ml',
    ];

    // Alias agar view bisa panggil $hargaParfum->nama_parfum
    // (sebelumnya view salah pakai 'nama_parfum', padahal kolom = 'jenis_parfum')
    public function getNamaParfumAttribute(): string
    {
        return $this->jenis_parfum;
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
