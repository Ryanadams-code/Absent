<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MuridController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $murids = Murid::active()->get();
        return view('murids.index', compact('murids'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('murids.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|max:20|unique:murids',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'kelas' => 'required|string|max:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Buat user terlebih dahulu
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'murid',
        ]);

        // Buat data murid
        Murid::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'kelas' => $request->kelas,
            'user_id' => $user->id,
        ]);

        return redirect()->route('murids.index')
            ->with('success', 'Data murid berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Murid $murid)
    {
        return view('murids.show', compact('murid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Murid $murid)
    {
        return view('murids.edit', compact('murid'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Murid $murid)
    {
        $request->validate([
            'nis' => 'required|string|max:20|unique:murids,nis,' . $murid->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'kelas' => 'required|string|max:10',
        ]);

        $murid->update($request->all());

        // Update nama user jika ada perubahan
        if ($murid->user && $murid->nama !== $request->nama) {
            $murid->user->update(['name' => $request->nama]);
        }

        return redirect()->route('murids.index')
            ->with('success', 'Data murid berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Murid $murid)
    {
        // Update record_flag menjadi 'delete'
        $murid->update(['record_flag' => 'delete']);

        return redirect()->route('murids.index')
            ->with('success', 'Data murid berhasil dihapus');
    }
}
