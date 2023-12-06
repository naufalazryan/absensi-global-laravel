<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kehadiran;
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
        $kehadiran = Kehadiran::all();

        if ($kehadiran->isEmpty()) {
            return response()->json(['message' => 'Tidak ada kehadiran yang tersedia.'], 404);
        }

        return response()->json($kehadiran);
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
        $request->validate([
            'id_kegiatan' => 'required|exists:kegiatan,id',
            'nis' => 'required|integer',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $kegiatan = Kegiatan::findOrFail($request->id_kegiatan);

        $kehadiran = new Kehadiran([
            'nis' => $request->nis,
            'bukti' => $request->file('bukti')->getClientOriginalName(),
        ]);

        $kegiatan->kehadirans()->save($kehadiran);

        $path = $request->file('bukti')->storeAs('public/bukti_kehadiran', uniqid() . '.' . $request->file('bukti')->getClientOriginalExtension());

        return response()->json(['message' => 'Kehadiran berhasil disimpan', 'path' => $path], 201);
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
