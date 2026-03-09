<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kemasan extends Model
{
    use HasFactory;

    protected $table = 'kemasans';

    protected $fillable = [
        'jenis_botol',
        'ukuran',
        'jenis_box',
        'catatan',
        'biaya_kemasan'
    ];
}
