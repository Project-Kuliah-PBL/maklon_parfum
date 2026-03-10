<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Traking extends Model
{
    use HasFactory;

    protected $table = 'trakings';

    protected $fillable = [
        'pengajuan_id',
        'tahapan',
        'catatan',
        'status',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
