<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id'      => 'required|exists:siswas,id',
            'bulan'         => 'required|integer|min:1|max:12',
            'tahun'         => 'required|digits:4',
            'jumlah_bayar'  => 'required|integer|min:0',
            'tanggal_bayar' => 'nullable|date',
            'status'        => ['required', Rule::in(['lunas','belum'])],
            'keterangan'    => 'nullable|string|max:255',
        ]);

        $siswa = Siswa::with('spp')->findOrFail($request->siswa_id);

        // spp_id disimpan sebagai snapshot
        Pembayaran::create([
            'siswa_id'      => $siswa->id,
            'spp_id'        => $siswa->spp_id, // penting
            'bulan'         => (int) $request->bulan,
            'tahun'         => (int) $request->tahun,
            'jumlah_bayar'  => (int) $request->jumlah_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'status'        => $request->status,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    // EDIT
    public function edit(Pembayaran $pembayaran)
    {
        $pembayaran->load(['siswa.kelas','spp']);
        return view('pembayaran.edit', compact('pembayaran'));
    }

    // UPDATE
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'bulan'         => 'required|integer|min:1|max:12',
            'tahun'         => 'required|digits:4',
            'jumlah_bayar'  => 'required|integer|min:0',
            'tanggal_bayar' => 'nullable|date',
            'status'        => ['required', Rule::in(['lunas','belum'])],
            'keterangan'    => 'nullable|string|max:255',
        ]);

        // validasi unique (siswa_id, bulan, tahun) saat update
        $exists = Pembayaran::where('siswa_id', $pembayaran->siswa_id)
            ->where('bulan', (int)$request->bulan)
            ->where('tahun', (int)$request->tahun)
            ->where('id', '!=', $pembayaran->id)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['bulan' => 'Data pembayaran bulan & tahun ini sudah ada untuk siswa tersebut.'])
                ->withInput();
        }

        $pembayaran->update([
            'bulan'         => (int) $request->bulan,
            'tahun'         => (int) $request->tahun,
            'jumlah_bayar'  => (int) $request->jumlah_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'status'        => $request->status,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diupdate');
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
