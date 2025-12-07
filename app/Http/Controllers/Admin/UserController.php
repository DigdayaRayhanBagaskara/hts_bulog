<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::orderBy('created_at', 'DESC')->get();
        return view('admin.data_user.index', compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatan = Jabatan::orderBy('created_at', 'DESC')->get();
        $area = Area::orderBy('created_at', 'DESC')->get();
        return view('admin.data_user.create', compact('jabatan', 'area'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'username_nip' => 'required|string|max:20|unique:users,username_nip',
            'nama' => 'required|string|max:100',
            'no_telp' => 'required|string|max:15',
            'id_jabatan' => 'required|exists:jabatan,id',
            'id_area' => 'required|exists:area,id',
            'password' => 'required|string|min:8|same:konfirmasi_password',
            'konfirmasi_password' => 'required|string|min:8',
            'tipe_user' => 'required|in:user,manajer,admin',
        ]);

        $data['password'] = Hash::make($data['password']);
        
        // Create the user
        $done = User::create($data);
        
        if ($done) {
            return redirect('/admin/data_user')->with('berhasil', 'Data berhasil ditambahkan!');
        } else {
            return redirect('/admin/data_user')->with('gagal', 'Data gagal ditambahkan!');
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, $id)
    {
        $data = User::where('id', $id)->first();
        $jabatan = Jabatan::orderBy('created_at', 'DESC')->get();
        $area = Area::orderBy('created_at', 'DESC')->get();

        return view('admin.data_user.edit', compact('data','jabatan', 'area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id ,User $user)
    {
        
        $rules = [
            'username_nip' => 'required|string|max:20|unique:users,username_nip,' . $id,
            'nama' => 'required|string|max:100',
            'no_telp' => 'required|string|max:15',
            'id_jabatan' => 'required|exists:jabatan,id',
            'id_area' => 'required|exists:area,id',
            'tipe_user' => 'required|in:user,manajer,admin',
        ];
        
        // Validasi password hanya jika diisi
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|same:konfirmasi_password';
            $rules['konfirmasi_password'] = 'required|string|min:8';
        }
        
        $data = $request->validate($rules);
        
        // Jika password diisi, hash dan masukkan ke data
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // jangan update password jika kosong
        }
        
        // Update data user
        $user = User::findOrFail($id);
        $done = $user->update($data);
        
        if ($done) {
            return redirect('/admin/data_user')->with('berhasil', 'Data berhasil diubah!');
        } else {
            return redirect('/admin/data_user')->with('gagal', 'Data gagal diubah!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $id)
    {
        $user = User::findOrFail($id);
        $done = $user->delete();
        
        if ($done) {
            return redirect('/admin/data_user')->with('berhasil', 'Data berhasil dihapus!');
        } else {
            return redirect('/admin/data_user')->with('gagal', 'Data gagal dihapus!');
        }
    }
}
