<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kegiatan', 'waktu_kegiatan', 'kelas_x', 'kelas_xi', 'kelas_xii', 'jumlah_kehadiran'
    ];

    public $timestamps = false;


    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_kegiatan', 'id');
    }
}
