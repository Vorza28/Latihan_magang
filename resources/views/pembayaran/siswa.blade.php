@extends('layouts.dashboard')
@section('title','Riwayat Pembayaran')

@section('content')
<h2 class="text-xl font-bold mb-2">Riwayat Pembayaran</h2>
<div class="mb-4 text-gray-700">
    <div class="font-semibold">{{ $siswa->nama }} ({{ $siswa->nis }})</div>
    <div>Kelas: {{ $siswa->kelas?->nama_kelas ?? '-' }}</div>
    <div>SPP: @if($siswa->spp) {{ $siswa->spp->tahun }} - Rp {{ number_format($siswa->spp->nominal) }} @else - @endif</div>
</div>

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-100">
    <tr>
        <th class="p-3 text-left">Bulan/Tahun</th>
        <th class="p-3 text-left">Jumlah</th>
        <th class="p-3 text-left">Tanggal</th>
        <th class="p-3 text-center">Status</th>
        <th class="p-3 text-left">Ket</th>
    </tr>
    </thead>
    <tbody>
    @forelse($riwayat as $p)
        <tr class="border-t">
        <td class="p-3">{{ $p->bulan }}/{{ $p->tahun }}</td>
        <td class="p-3">Rp {{ number_format($p->jumlah_bayar) }}</td>
        <td class="p-3">{{ $p->tanggal_bayar?->format('Y-m-d') ?? '-' }}</td>
        <td class="p-3 text-center">
            <span class="px-2 py-1 rounded text-white {{ $p->status === 'lunas' ? 'bg-green-600' : 'bg-red-600' }}">
            {{ strtoupper($p->status) }}
            </span>
        </td>
        <td class="p-3">{{ $p->keterangan ?? '-' }}</td>
        </tr>
    @empty
        <tr><td colspan="5" class="p-4 text-center text-gray-500">Belum ada riwayat pembayaran.</td></tr>
    @endforelse
    </tbody>
</table>

<div class="mt-4">
    <a href="{{ route('pembayaran.index') }}" class="px-4 py-2 rounded border">Kembali</a>
</div>
@endsection
