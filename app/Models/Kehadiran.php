<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;
    protected $table = 'kehadiran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kegiatan',
        'nis',
        'bukti'
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id');
    }
}
