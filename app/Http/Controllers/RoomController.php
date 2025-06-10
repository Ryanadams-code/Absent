<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::where('status', 'active')->get();
        return view('rooms.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:rooms',
            'capacity' => 'nullable|integer|min:1',
            'building' => 'nullable|string|max:100',
            'floor' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Ruangan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $rooms = Room::where('status', 'active')->get();
        return view('rooms.edit', compact('room', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:rooms,code,' . $room->id,
            'capacity' => 'nullable|integer|min:1',
            'building' => 'nullable|string|max:100',
            'floor' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Ruangan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        // Check if room is used in any schedules
        if ($room->schedules()->count() > 0) {
            return redirect()->route('rooms.index')
                ->with('error', 'Ruangan tidak dapat dihapus karena sedang digunakan dalam jadwal');
        }

        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Ruangan berhasil dihapus');
    }
}