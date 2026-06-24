<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Venue;

class AdminFieldController extends Controller
{
    public function index()
    {
        $courts = Field::orderBy('created_at', 'desc')->get();
        // Calculate average price if courts exist, otherwise 0
        $avgPrice = $courts->count() > 0 ? $courts->avg('harga') : 0;
        
        return view('admin.courts', compact('courts', 'avgPrice'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'jenis_olahraga' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ensure a venue exists to satisfy the foreign key constraint
        $venue = Venue::first();
        if (!$venue) {
            $venue = Venue::create([
                'nama_venue' => 'SportOps Arena',
                'alamat' => 'Jl. Olahraga No. 1, Jakarta',
                'kontak' => '081234567890',
            ]);
        }
        $venueId = $venue->id;

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fields', 'public');
        }

        Field::create([
            'venue_id' => $venueId,
            'nama_lapangan' => $validated['nama_lapangan'],
            'jenis_olahraga' => $validated['jenis_olahraga'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'],
            'foto' => $fotoPath,
            'status' => 'aktif',
        ]);

        return redirect()->route('admin.courts.index')->with('success', 'Court added successfully!');
    }

    public function update(Request $request, $id)
    {
        $court = Field::findOrFail($id);

        $validated = $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'jenis_olahraga' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,maintenance',
        ]);

        $data = [
            'nama_lapangan' => $validated['nama_lapangan'],
            'jenis_olahraga' => $validated['jenis_olahraga'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($court->foto && \Storage::disk('public')->exists($court->foto)) {
                \Storage::disk('public')->delete($court->foto);
            }
            $data['foto'] = $request->file('foto')->store('fields', 'public');
        }

        $court->update($data);

        return redirect()->route('admin.courts.index')->with('success', 'Court updated successfully!');
    }

    public function destroy($id)
    {
        $court = Field::findOrFail($id);
        $court->delete();

        return redirect()->route('admin.courts.index')->with('success', 'Court deleted successfully!');
    }

    public function toggleStatus(Request $request, $id)
    {
        $court = Field::findOrFail($id);
        $court->status = $court->status === 'aktif' ? 'maintenance' : 'aktif';
        $court->save();

        return redirect()->route('admin.courts.index')->with('success', 'Court status updated!');
    }
}
