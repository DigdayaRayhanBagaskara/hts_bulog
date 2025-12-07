<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jabatan_area.area.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_area' => 'required|string|max:100',
            'tipe_area' => 'required|in:entitas,gudang',
        ]);

        $done = Area::create($data);
        
        if ($done) {
            return redirect('/admin/jabatan_area')->with('area_berhasil', 'Data Area berhasil ditambahkan!');
        } else {
            return redirect('/admin/jabatan_area')->with('area_gagal', 'Data Area gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area, $id)
    {
        $data = Area::where('id', $id)->first();
        return view('admin.jabatan_area.area.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, Area $area)
    {
        $data = $request->validate([
            'nama_area' => 'required|string|max:100',
            'tipe_area' => 'required|in:entitas,gudang',
        ]);

        $area = Area::findOrFail($id);
        $done = $area->update($data);
        
        if ($done) {
            return redirect('/admin/jabatan_area')->with('area_berhasil', 'Data Area berhasil diperbarui!');
        } else {
            return redirect('/admin/jabatan_area')->with('area_gagal', 'Data Area gagal diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area, $id)
    {
        $area = Area::findOrFail($id);
        $done = $area->delete();
        
        if ($done) {
            return redirect('/admin/jabatan_area')->with('area_berhasil', 'Data Area berhasil dihapus!');
        } else {
            return redirect('/admin/jabatan_area')->with('area_gagal', 'Data Area gagal dihapus!');
        }
    }
}
