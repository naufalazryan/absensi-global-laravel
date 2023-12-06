<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kehadiran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class KehadiranController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index()
{
    $data = Kehadiran::with('kegiatan')->get();

    // Menambahkan URL gambar dan nama_kegiatan ke hasil query
    $data->each(function ($kehadiran) {
        // Menggunakan asset untuk menghasilkan URL gambar dari penyimpanan Laravel
        $kehadiran->image_url = asset(Storage::url("bukti_kehadiran/{$kehadiran->image_url}"));
        $kehadiran->nama_kegiatan = $kehadiran->kegiatan->nama_kegiatan;
    });

    return response()->json($data);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(Request $request)
    {
        $user = User::where('nis', $request->nis)->first();

        if (!$user) {
            return response()->json(['error' => 'NIS tidak ditemukan di tabel pengguna'], 404);
        }

        $request->validate([
            'id_kegiatan' => 'required|exists:kegiatan,id', 
            'nis' => 'required|integer',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $kegiatan = Kegiatan::findOrFail($request->id_kegiatan);

        $kehadiran = new Kehadiran([
            'nis' => $request->nis,
            'bukti' => uniqid() . '.' . $request->file('bukti')->getClientOriginalExtension(),
        ]);

        $url = asset('storage/bukti_kehadiran/' . $kehadiran->bukti);

        $kegiatan->kehadirans()->save($kehadiran);

        // Simpan file bukti kehadiran di storage
        $path = $request->file('bukti')->storeAs('public/bukti_kehadiran', $kehadiran->bukti);

        return response()->json(['message' => 'Kehadiran berhasil disimpan', 'url' => $url], 201);
    }

    



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kehadiran = Kehadiran::find($id);
    
        if (!$kehadiran) {
            return response()->json(['error' => 'Kehadiran not found.', 'id' => $id], 404);
        }
    
        // Mendapatkan nama file gambar dari kolom 'bukti'
        $imageName = $kehadiran->bukti;
    
        // Membuat URL gambar berdasarkan nama file
        $imageUrl = url('storage/bukti_kehadiran/' . $imageName);
    
        // Menambahkan URL gambar ke respons
        $kehadiran->imageUrl = $imageUrl;
    
        return response()->json($kehadiran);
    }
    

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kehadiran $kehadiran)
    {
        //
    }
}
