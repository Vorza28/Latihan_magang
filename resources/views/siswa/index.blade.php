@extends('layouts.dashboard')

@section('title','Data Siswa')

@section('content')
<a href="/siswa/create" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
+ Tambah Siswa
</a>

<table class="w-full mt-6 bg-white shadow rounded overflow-hidden">
<thead class="bg-gray-100">
<tr>
    <th class="p-3 text-left">Nama</th>
    <th class="p-3 text-left">NIS</th>
    <th class="p-3 text-left">Kelas</th>
    <th class="p-3 text-center">Aksi</th>
</tr>
</thead>
<tbody>
@foreach($siswas as $s)
<tr class="border-t hover:bg-gray-50">
    <td class="p-3">{{ $s->nama }}</td>
    <td class="p-3">{{ $s->nis }}</td>
    <td class="p-3">{{ $s->kelas }}</td>
    <td class="p-3 text-center">
        <a href="/siswa/{{ $s->id }}/edit" class="text-blue-600 mr-3">Edit</a>
        <form action="/siswa/{{ $s->id }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button class="text-red-600">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
@endsection
