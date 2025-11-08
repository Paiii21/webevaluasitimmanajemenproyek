<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_tim',
        'efektivitas_sistem',
        'produktivitas_tim',
        'catatan',
    ];
}
