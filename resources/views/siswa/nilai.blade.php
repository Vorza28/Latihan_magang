@extends('layouts.dashboard')
@section('title','Input Nilai Siswa')

@section('content')
<table class="w-full bg-white shadow rounded">
<thead class="bg-gray-100">
<tr>
    <th class="p-3">Nama</th>
    <th>NIS</th>
    <th>Kelas</th>
    <th>Nilai</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
@foreach($siswas as $s)
<tr class="border-t">
<td class="p-2">{{ $s->nama }}</td>
<td>{{ $s->nis }}</td>
<td>{{ $s->kelas }}</td>
<td>{{ $s->nilai ?? '-' }}</td>
<td>
<form action="/nilai/{{ $s->id }}" method="POST" class="flex gap-2">
@csrf
<input type="number" name="nilai" value="{{ $s->nilai }}" class="border p-1 w-20">
<button class="bg-blue-600 text-white px-3 rounded">Simpan</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
@endsection
