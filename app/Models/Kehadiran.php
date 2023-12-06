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

    public function storeBukti($bukti){
        $path = $bukti->store('bukti_kehadiran', 'public');
        $this->update(['bukti' => $path]);

        return $this;
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }

    public $timestamps = false;


   
}
