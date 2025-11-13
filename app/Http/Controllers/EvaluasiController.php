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
        $evaluasis = Evaluasi::where('user_id', Auth::id())->latest()->get();
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

        Evaluasi::create([
            'user_id' => Auth::id(),
            'nama_tim' => $request->nama_tim,
            'efektivitas_sistem' => $request->efektivitas_sistem,
            'produktivitas_tim' => $request->produktivitas_tim,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi berhasil disimpan!');
    }
}
