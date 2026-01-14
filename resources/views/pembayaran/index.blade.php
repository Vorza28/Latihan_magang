@extends('layouts.dashboard')
@section('title','Pembayaran SPP')

@section('content')
<x-alert-success />

<div class="flex items-center justify-between mb-4">
<h2 class="text-xl font-bold">Pembayaran SPP</h2>
<a href="{{ route('pembayaran.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
+ Input Pembayaran
</a>
</div>

<form method="GET" class="bg-white p-4 rounded shadow mb-5 grid grid-cols-1 md:grid-cols-4 gap-3">
<select name="kelas_id" class="border p-2 rounded">
<option value="">Semua Kelas</option>
@foreach($kelasList as $k)
    <option value="{{ $k->id }}" @selected(request('kelas_id') == $k->id)>
    {{ $k->nama_kelas }}
    </option>
@endforeach
</select>

<select name="bulan" class="border p-2 rounded">
<option value="">Semua Bulan</option>
@for($b=1;$b<=12;$b++)
    <option value="{{ $b }}" @selected((int)request('bulan') === $b)>{{ $b }}</option>
@endfor
</select>

<input type="number" name="tahun" class="border p-2 rounded" placeholder="Tahun (mis. 2026)" value="{{ request('tahun') }}">

<button class="bg-gray-800 text-white rounded px-4 py-2 hover:bg-gray-900">Filter</button>
</form>

<div class="bg-white rounded shadow overflow-x-auto">
<table class="w-full">
<thead class="bg-gray-100">
<tr>
    <th class="p-3 text-left">Siswa</th>
    <th class="p-3 text-left">Kelas</th>
    <th class="p-3 text-left">Bulan/Tahun</th>
    <th class="p-3 text-left">SPP</th>
    <th class="p-3 text-left">Jumlah</th>
    <th class="p-3 text-left">Tanggal</th>
    <th class="p-3 text-center">Status</th>
    <th class="p-3 text-center">Aksi</th>
</tr>
</thead>
<tbody>
@forelse($pembayarans as $p)
    <tr class="border-t">
    <td class="p-3">
        <div class="font-semibold">{{ $p->siswa->nama }}</div>
        <div class="text-sm text-gray-500">{{ $p->siswa->nis }}</div>
        <a class="text-blue-600 text-sm" href="{{ route('pembayaran.siswa', $p->siswa_id) }}">Riwayat</a>
    </td>
    <td class="p-3">{{ $p->siswa->kelas?->nama_kelas ?? '-' }}</td>
    <td class="p-3">{{ $p->bulan }}/{{ $p->tahun }}</td>
    <td class="p-3">
        @if($p->spp)
        {{ $p->spp->tahun }} - Rp {{ number_format($p->spp->nominal) }}
        @else
        -
        @endif
    </td>
    <td class="p-3">Rp {{ number_format($p->jumlah_bayar) }}</td>
    <td class="p-3">{{ $p->tanggal_bayar?->format('Y-m-d') ?? '-' }}</td>
    <td class="p-3 text-center">
        <x-badge-status value="{{ $p->status }}" />
    </td>
    <td class="p-3 text-center whitespace-nowrap">
        <a href="{{ route('pembayaran.edit', $p->id) }}" class="text-blue-600 mr-2">Edit</a>
        <form action="{{ route('pembayaran.destroy', $p->id) }}" method="POST" class="inline">
        @csrf @method('DELETE')
        <button onclick="return confirm('Hapus pembayaran ini?')" class="text-red-600">Hapus</button>
        </form>
    </td>
    </tr>
@empty
    <tr>
    <td colspan="8" class="p-4 text-center text-gray-500">Belum ada data pembayaran.</td>
    </tr>
@endforelse
</tbody>
</table>
</div>
@endsection
