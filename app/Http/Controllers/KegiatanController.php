<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatan = Kegiatan::all();

        if ($kegiatan->isEmpty()) {
            return response()->json(['message' => 'Tidak ada kegiatan yang tersedia.'], 404);
        }

        return response()->json($kegiatan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'waktu_kegiatan' => 'required|date',
            'kelas_x' => 'required|boolean',
            'kelas_xi' => 'required|boolean',
            'kelas_xii' => 'required|boolean',
            'jumlah_kehadiran' => 'required|integer',
        ]);

        $kegiatan = new Kegiatan([
            'nama_kegiatan' => $request->nama_kegiatan,
            'waktu_kegiatan' => $request->waktu_kegiatan,
            'kelas_x' => $request->kelas_x,
            'kelas_xi' => $request->kelas_xi,
            'kelas_xii' => $request->kelas_xii,
            'jumlah_kehadiran' => $request->jumlah_kehadiran,
        ]);

        $kegiatan->save();

        return response()->json([
            'message' => 'Data Kegiatan Berhasil Ditambahkan',
            'data' => $kegiatan,
        ], 201);
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan) {
            return response()->json(['message' => 'Data Kegiatan Tidak Ditemukan'], 404);
        }

        return response()->json($kegiatan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'waktu_kegiatan' => 'required|date',
            'kelas_x' => 'required|boolean',
            'kelas_xi' => 'required|boolean',
            'kelas_xii' => 'required|boolean',
            'jumlah_kehadiran' => 'required|integer',
        ]);

        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan) {
            return response()->json(['message' => 'Data Kegiatan Tidak Ditemukan'], 404);
        }

        $kegiatan->update($request->all());

        return response()->json([
            'message' => 'Data Kegiatan Berhasil Diperbarui',
            'data' => $kegiatan,
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan) {
            return response()->json(['error' => 'Data Kegiatan not found.'], 404);
        }

        $kegiatan->delete();

        return response()->json(['message' => 'Data Kegiatan Berhasil Dihapus'], 204);
    }
}
