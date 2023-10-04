<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'tabel_kegiatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'kelas'
    ];
}
