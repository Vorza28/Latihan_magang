@extends('layouts.dashboard')
@section('title','Data Siswa')

@section('content')

@if(session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
    {{ session('success') }}
</div>
@endif

<a href="/siswa/create" class="inline-block bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
    + Tambah Siswa
</a>

<table class="w-full mt-6 bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">Nama</th>
            <th class="p-3 text-left">NIS</th>
            <th class="p-3 text-left">Kelas</th>
            <th class="p-3 text-left">SPP</th>
            <th class="p-3 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($siswas as $s)
        <tr class="border-t">
            <td class="p-3">{{ $s->nama }}</td>
            <td class="p-3">{{ $s->nis }}</td>
            <td class="p-3">{{ $s->kelas?->nama_kelas ?? '-' }}</td>
            <td class="p-3">
                @if($s->spp)
                    {{ $s->spp->tahun }} - Rp {{ number_format($s->spp->nominal) }}
                @else
                    -
                @endif
            </td>
            <td class="p-3 text-center">
                <a href="/siswa/{{ $s->id }}/edit" class="text-blue-600 mr-3">Edit</a>
                <form action="/siswa/{{ $s->id }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-600" onclick="return confirm('Hapus siswa ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data siswa.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
