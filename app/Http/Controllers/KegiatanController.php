<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatan = Kegiatan::all();
        return response()->json($kegiatan);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nama_kegiatan' => 'required|max:50|unique:kegiatan',
        'waktu_kegiatan' => 'required|date',
        'kelas_x' => 'required|boolean',
        'kelas_xi' => 'required|boolean',
        'kelas_xii' => 'required|boolean',
        'jumlah_kehadiran' => 'required|integer',
    ]);

    Kegiatan::create($request->all());

    // Laravel will automatically regenerate and include the CSRF token in the response.
    // You don't need to manually update the token in the cookie.

    return response()->json([
        'message' => 'Data Kegiatan Berhasil Ditambahkan',
    ], 200);
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kegiatan = Kegiatan::find($id);
        return response()->json($kegiatan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
{
    $kegiatan->update($request->all());
    return response()->json($kegiatan);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kegiatan::find($id)->delete();
        return response()->json(null, 204);
    }

    public function getUserRole()
    {
        $user = auth()->user();

        if ($user) {
            return response()->json(['role' => $user->role]);
        }

        return response()->json(['role' => 'guest']);
    }
}
