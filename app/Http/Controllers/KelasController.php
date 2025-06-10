<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::where('status', 'active')->get();
        return view('kelas.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:kelas',
            'capacity' => 'nullable|integer|min:1',
            'grade_level' => 'required|string|max:10',
            'major' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kela)
    {
        return view('kelas.show', compact('kela'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela)
    {
        $kelas = Kelas::where('status', 'active')->get();
        return view('kelas.edit', compact('kela', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:kelas,code,' . $kela->id,
            'capacity' => 'nullable|integer|min:1',
            'grade_level' => 'required|string|max:10',
            'major' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $kela->update($request->all());

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        // Check if class has students
        if ($kela->murids()->count() > 0) {
            return redirect()->route('kelas.index')
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki siswa');
        }

        $kela->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil dihapus');
    }
}