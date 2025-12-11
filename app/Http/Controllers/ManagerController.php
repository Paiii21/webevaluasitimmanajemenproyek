<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:manager');
    }

    /**
     * Display a listing of the evaluations for teams managed by the manager.
     */
    public function index()
    {
        // Manager can see all evaluations
        $evaluasis = Evaluasi::with('user')->latest()->get();

        return view('manager.index', compact('evaluasis'));
    }

    /**
     * Show the form for creating a new evaluation.
     */
    public function create()
    {
        $users = User::where('role', 'user')->get(); // Only regular users can have evaluations added for them

        return view('manager.create', compact('users'));
    }

    /**
     * Store a newly created evaluation in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_tim' => 'required|string|max:255',
            'efektivitas_sistem' => 'required|integer|min:1|max:10',
            'produktivitas_tim' => 'required|integer|min:1|max:10',
            'catatan' => 'nullable|string',
        ]);

        Evaluasi::create([
            'user_id' => $request->user_id,
            'nama_tim' => $request->nama_tim,
            'efektivitas_sistem' => $request->efektivitas_sistem,
            'produktivitas_tim' => $request->produktivitas_tim,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('manager.index')->with('success', 'Evaluasi berhasil ditambahkan!');
    }

    /**
     * Display the specified evaluation.
     */
    public function show(Evaluasi $evaluasi)
    {
        // Load the evaluation with user data
        $evaluasi->load('user');

        return view('manager.show', compact('evaluasi'));
    }

    /**
     * Show the form for editing the specified evaluation.
     */
    public function edit(Evaluasi $evaluasi)
    {
        $users = User::where('role', 'user')->get();

        return view('manager.edit', compact('evaluasi', 'users'));
    }

    /**
     * Update the specified evaluation in storage.
     */
    public function update(Request $request, Evaluasi $evaluasi)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_tim' => 'required|string|max:255',
            'efektivitas_sistem' => 'required|integer|min:1|max:10',
            'produktivitas_tim' => 'required|integer|min:1|max:10',
            'catatan' => 'nullable|string',
        ]);

        $evaluasi->update([
            'user_id' => $request->user_id,
            'nama_tim' => $request->nama_tim,
            'efektivitas_sistem' => $request->efektivitas_sistem,
            'produktivitas_tim' => $request->produktivitas_tim,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('manager.index')->with('success', 'Evaluasi berhasil diperbarui!');
    }

    /**
     * Remove the specified evaluation from storage.
     */
    public function destroy(Evaluasi $evaluasi)
    {
        $evaluasi->delete();

        return redirect()->route('manager.index')->with('success', 'Evaluasi berhasil dihapus!');
    }
}
