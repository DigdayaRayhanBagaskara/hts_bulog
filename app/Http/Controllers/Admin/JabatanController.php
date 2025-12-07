<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_jabatan = Jabatan::orderBy('created_at', 'DESC')->get();
        $data_area = Area::orderBy('created_at', 'DESC')->get();
        return view('admin.jabatan_area.index', compact('data_jabatan','data_area'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jabatan_area.jabatan.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_jabatan' => 'required|string|max:100',
        ]);

        $done = Jabatan::create($data);
        
        if ($done) {
            return redirect('/admin/jabatan_area')->with('jabatan_berhasil', 'Data Jabatan berhasil ditambahkan!');
        } else {
            return redirect('/admin/jabatan_area')->with('jabatan_gagal', 'Data Jabatan gagal ditambahkan!');
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan, $id)
    {
        $data = Jabatan::where('id', $id)->first();
        return view('admin.jabatan_area.jabatan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, Jabatan $jabatan)
    {
        $data = $request->validate([
            'nama_jabatan' => 'required|string|max:100',
        ]);

        $jabatan = Jabatan::findOrFail($id);
        $done = $jabatan->update($data);
        
        if ($done) {
            return redirect('/admin/jabatan_area')->with('jabatan_berhasil', 'Data Jabatan berhasil diperbarui!');
        } else {
            return redirect('/admin/jabatan_area')->with('jabatan_gagal', 'Data Jabatan gagal diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan, $id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $done = $jabatan->delete();
        
        if ($done) {
            return redirect('/admin/jabatan_area')->with('jabatan_berhasil', 'Data Jabatan berhasil dihapus!');
        } else {
            return redirect('/admin/jabatan_area')->with('jabatan_gagal', 'Data Jabatan gagal dihapus!');
        }
    }
}
