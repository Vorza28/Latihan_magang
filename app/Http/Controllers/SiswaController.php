<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with(['kelas','spp'])->latest()->get();
        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $spps  = Spp::orderBy('tahun','desc')->get();

        return view('siswa.create', compact('kelas','spps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'nis'      => 'required|unique:siswas,nis',
            'kelas_id' => 'required|exists:kelas,id',
            'spp_id'   => 'required|exists:spps,id',
        ]);

        Siswa::create($request->only(['nama','nis','kelas_id','spp_id']));
        return redirect('/siswa')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $spps  = Spp::orderBy('tahun','desc')->get();

        return view('siswa.edit', compact('siswa','kelas','spps'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama'     => 'required',
            'nis'      => 'required|unique:siswas,nis,' . $siswa->id,
            'kelas_id' => 'required|exists:kelas,id',
            'spp_id'   => 'required|exists:spps,id',
        ]);

        $siswa->update($request->only(['nama','nis','kelas_id','spp_id']));
        return redirect('/siswa')->with('success', 'Siswa berhasil diubah');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return back()->with('success', 'Siswa berhasil dihapus');
    }

    // TAB: Input Nilai
    public function nilaiIndex()
    {
        $siswas = Siswa::with(['kelas','spp'])->orderBy('nama')->get();
        return view('siswa.nilai', compact('siswas'));
    }

    public function nilaiUpdate(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100'
        ]);

        $siswa->update(['nilai' => $request->nilai]);
        return back()->with('success', 'Nilai berhasil disimpan');
    }

    // TAB: Ranking
    public function dashboard()
    {
        $siswas = Siswa::with(['kelas','spp'])
            ->whereNotNull('nilai')
            ->orderByDesc('nilai')
            ->get();

        return view('dashboard', compact('siswas'));
    }
}
