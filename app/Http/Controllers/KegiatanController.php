<?php

namespace App\Http\Controllers;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kegiatan = Kegiatan::create($request->all());
        return response()->json($kegiatan, 201);
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
    public function update(Request $request, Kegiatan $kegiatan, $id)
    {
        $kegiatan = Kegiatan::find($id);
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
}
