<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::where('status', 'active')->get();
        return view('subjects.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subjects',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Mata pelajaran berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $subjects = Subject::where('status', 'active')->get();
        return view('subjects.edit', compact('subject', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subjects,code,' . $subject->id,
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        // Check if subject is used in any schedules
        if ($subject->schedules()->count() > 0) {
            return redirect()->route('subjects.index')
                ->with('error', 'Mata pelajaran tidak dapat dihapus karena sedang digunakan dalam jadwal');
        }

        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Mata pelajaran berhasil dihapus');
    }
}