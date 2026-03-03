<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Aroma;
use App\Models\Kemasan;
use App\Models\User;
use App\Models\HargaParfum;
use App\Models\Traking;
use App\Models\Pembayaran;

class Pengajuan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'harga_parfum_id',
        'jenis_parfum',
        'jumlah',
        'target_market',
        'catatan',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hargaParfum()
    {
        return $this->belongsTo(HargaParfum::class);
    }

    public function trakings()
    {
        return $this->hasMany(Traking::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
    public function aromas()
    {
        return $this->belongsToMany(Aroma::class, 'pengajuan_aromas')
                    ->withPivot('note_id')
                    ->withTimestamps();
    }

    public function kemasans()
    {
        return $this->belongsToMany(Kemasan::class, 'pengajuan_kemasans')
                    ->withPivot('aroma_id','logo_label')
                    ->withTimestamps();
    }
}
