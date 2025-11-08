<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluasiController extends Controller
{
    public function index()
    {
        $data = Evaluasi::where('user_id', Auth::id())->get();
        return view('evaluasi.index', compact('data'));
    }

    public function create()
    {
        return view('evaluasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tim' => 'required',
            'efektivitas_sistem' => 'required|integer|min:1|max:10',
            'produktivitas_tim' => 'required|integer|min:1|max:10',
            'catatan' => 'nullable'
        ]);

        Evaluasi::create([
            'user_id' => Auth::id(),
            'nama_tim' => $request->nama_tim,
            'efektivitas_sistem' => $request->efektivitas_sistem,
            'produktivitas_tim' => $request->produktivitas_tim,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi berhasil disimpan.');
    }

    public function show($id)
    {
        $evaluasi = Evaluasi::findOrFail($id);
        return view('evaluasi.show', compact('evaluasi'));
    }
}
