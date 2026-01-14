<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;

class PembayaranController extends Controller
{
    // LIST + FILTER
    public function index(Request $request)
    {
        $kelasList = Kelas::orderBy('nama_kelas')->get();

        $query = Pembayaran::with(['siswa.kelas', 'spp'])
            ->latest();

        if ($request->filled('kelas_id')) {
            $query->whereHas('siswa', fn($q) => $q->where('kelas_id', $request->kelas_id));
        }

        if ($request->filled('bulan')) {
            $query->where('bulan', (int) $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', (int) $request->tahun);
        }

        $pembayarans = $query->get();

        return view('pembayaran.index', compact('pembayarans', 'kelasList'));
    }

    // FORM INPUT PEMBAYARAN
    public function create()
    {
        $siswas = Siswa::with(['kelas','spp'])->orderBy('nama')->get();

        // default tahun ini
        $defaultTahun = (int) date('Y');

        return view('pembayaran.create', compact('siswas', 'defaultTahun'));
    }

    // SIMPAN PEMBAYARAN
    public function store(StorePembayaranRequest $request)
    {
    $siswa = Siswa::findOrFail($request->siswa_id);

    Pembayaran::create([
        'siswa_id'      => $siswa->id,
        'spp_id'        => $siswa->spp_id,
        'bulan'         => $request->bulan,
        'tahun'         => $request->tahun,
        'jumlah_bayar'  => $request->jumlah_bayar,
        'tanggal_bayar' => $request->tanggal_bayar,
        'status'        => $request->status,
        'keterangan'    => $request->keterangan,
    ]);

    return redirect()->route('pembayaran.index')
        ->with('success', 'Pembayaran berhasil ditambahkan');
    }

    // EDIT
    public function edit(Pembayaran $pembayaran)
    {
        $pembayaran->load(['siswa.kelas','spp']);
        return view('pembayaran.edit', compact('pembayaran'));
    }

    // UPDATE
    public function update(UpdatePembayaranRequest $request, Pembayaran $pembayaran)
    {
    // Cegah dobel pembayaran (siswa_id, bulan, tahun)
    $exists = Pembayaran::where('siswa_id', $pembayaran->siswa_id)
        ->where('bulan', $request->bulan)
        ->where('tahun', $request->tahun)
        ->where('id', '!=', $pembayaran->id)
        ->exists();

    if ($exists) {
        return back()
            ->withErrors(['bulan' => 'Data pembayaran bulan & tahun ini sudah ada untuk siswa tersebut.'])
            ->withInput();
    }

    $pembayaran->update($request->only([
        'bulan', 'tahun', 'jumlah_bayar', 'tanggal_bayar', 'status', 'keterangan'
    ]));

    return redirect()->route('pembayaran.index')
        ->with('success', 'Pembayaran berhasil diupdate');
    }

    // HAPUS
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return back()->with('success', 'Pembayaran berhasil dihapus');
    }

    // RIWAYAT PER SISWA
    public function siswa(Siswa $siswa)
    {
        $siswa->load(['kelas','spp']);
        $riwayat = Pembayaran::with('spp')
            ->where('siswa_id', $siswa->id)
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        return view('pembayaran.siswa', compact('siswa','riwayat'));
    }
}
