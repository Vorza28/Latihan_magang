@extends('layouts.dashboard')
@section('title','Ranking Nilai Siswa')

@section('content')

@if(session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-blue-600 text-white p-4 rounded shadow">
        <div class="text-sm">Total Siswa (dinilai)</div>
        <div class="text-3xl font-bold">{{ $siswas->count() }}</div>
    </div>

    <div class="bg-green-600 text-white p-4 rounded shadow">
        <div class="text-sm">Nilai Tertinggi</div>
        <div class="text-3xl font-bold">{{ $siswas->max('nilai') ?? 0 }}</div>
    </div>

    <div class="bg-yellow-600 text-white p-4 rounded shadow">
        <div class="text-sm">Nilai Rata-rata</div>
        <div class="text-3xl font-bold">
            {{ $siswas->count() ? round($siswas->avg('nilai'), 1) : 0 }}
        </div>
    </div>
</div>

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-center w-20">Rank</th>
            <th class="p-3 text-left">Nama</th>
            <th class="p-3 text-left">NIS</th>
            <th class="p-3 text-left">Kelas</th>
            <th class="p-3 text-center">Nilai</th>
        </tr>
    </thead>
    <tbody>
        @forelse($siswas as $i => $s)
        <tr class="border-t">
            <td class="p-3 text-center font-bold">{{ $i+1 }}</td>
            <td class="p-3">{{ $s->nama }}</td>
            <td class="p-3">{{ $s->nis }}</td>
            <td class="p-3">{{ $s->kelas?->nama_kelas ?? '-' }}</td>
            <td class="p-3 font-bold text-center">{{ $s->nilai }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="p-4 text-center text-gray-500">Belum ada ranking (nilai masih kosong).</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
