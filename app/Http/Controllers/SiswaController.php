<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = Siswa::all();
        return view('siswa.index', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas,nis',
            'kelas' => 'required',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')
                        ->with('success', 'Siswa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
            'kelas' => 'required',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')
                        ->with('success', 'Siswa updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')
                        ->with('success', 'Siswa deleted successfully.');
    }

    public function nilaiIndex()
    {
    $siswas = Siswa::all();
    return view('siswa.nilai', compact('siswas'));
    }

    public function nilaiUpdate(Request $request, Siswa $siswa)
    {
    $request->validate([
        'nilai' => 'required|numeric|min:0|max:100'
    ]);

    $siswa->update([
        'nilai' => $request->nilai
    ]);

    return redirect('/nilai');
    }

    public function dashboard()
    {
    $siswas = Siswa::whereNotNull('nilai')
        ->orderBy('nilai', 'desc')
        ->get();

    return view('dashboard', compact('siswas'));
    }

}
