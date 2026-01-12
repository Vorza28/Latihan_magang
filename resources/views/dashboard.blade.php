@extends('layouts.dashboard')
@section('title','Ranking Nilai Siswa')

@section('content')

<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-blue-600 text-white p-4 rounded shadow">
        <div class="text-sm">Total Siswa</div>
        <div class="text-3xl font-bold">{{ $siswas->count() }}</div>
    </div>

    <div class="bg-blue-600 text-white p-4 rounded shadow">
        <div class="text-sm">Nilai Tertinggi</div>
        <div class="text-3xl font-bold">{{ $siswas->max('nilai') }}</div>
    </div>

    <div class="bg-blue-600 text-white p-4 rounded shadow">
        <div class="text-sm">Rata-rata Nilai</div>
        <div class="text-3xl font-bold">
            {{ number_format($siswas->avg('nilai'),1) }}
        </div>
    </div>
</div>

<table class="w-full bg-white shadow rounded">
<thead class="bg-gray-100">
<tr>
    <th class="p-3">Ranking</th>
    <th>Nama</th>
    <th>NIS</th>
    <th>Kelas</th>
    <th>Nilai</th>
</tr>
</thead>
<tbody>
@foreach($siswas as $i => $s)
<tr class="border-t hover:bg-gray-50">
    <td class="p-3 font-bold text-center">
        {{ $i+1 }}
    </td>
    <td>{{ $s->nama }}</td>
    <td>{{ $s->nis }}</td>
    <td>{{ $s->kelas }}</td>
    <td class="font-bold text-center">
        {{ $s->nilai }}
    </td>
</tr>
@endforeach
</tbody>
</table>

@endsection
