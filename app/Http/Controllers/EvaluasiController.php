<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evaluasi;

class EvaluasiController extends Controller
{
    // Tampilkan semua data evaluasi (Dashboard)
    public function index()
    {
        // For regular users, show only their evaluations
        // For managers, show all evaluations
        if (Auth::user()->isManager() || Auth::user()->isAdmin()) {
            $evaluasis = Evaluasi::with('user')->latest()->get();
        } else {
            $evaluasis = Evaluasi::where('user_id', Auth::id())->latest()->get();
        }

        return view('evaluasi.index', compact('evaluasis'));
    }

    // Form tambah evaluasi
    public function create()
    {
        return view('evaluasi.create');
    }

    // Simpan data evaluasi ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_tim' => 'required|string|max:255',
            'efektivitas_sistem' => 'required|integer|min:1|max:10',
            'produktivitas_tim' => 'required|integer|min:1|max:10',
            'catatan' => 'nullable|string',
        ]);

        // For managers and admins, they might be creating for other users
        if (Auth::user()->isManager() || Auth::user()->isAdmin()) {
            // If user_id is provided in the request, use that, otherwise use auth user
            $userId = $request->has('user_id') ? $request->user_id : Auth::id();
        } else {
            $userId = Auth::id();
        }

        Evaluasi::create([
            'user_id' => $userId,
            'nama_tim' => $request->nama_tim,
            'efektivitas_sistem' => $request->efektivitas_sistem,
            'produktivitas_tim' => $request->produktivitas_tim,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi berhasil disimpan!');
    }

    // Display specific evaluation
    public function show(Evaluasi $evaluasi)
    {
        // Authorize that the user can view this evaluation
        if (!Auth::user()->isManager() && !Auth::user()->isAdmin() && $evaluasi->user_id !== Auth::id()) {
            abort(403, 'Unauthorized to view this evaluation');
        }

        return view('evaluasi.show', compact('evaluasi'));
    }
}
