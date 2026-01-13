@extends('layouts.dashboard')
@section('title','Input Nilai Siswa')

@section('content')

@if(session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
    {{ session('success') }}
</div>
@endif

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">Nama</th>
            <th class="p-3 text-left">NIS</th>
            <th class="p-3 text-left">Kelas</th>
            <th class="p-3 text-left">SPP</th>
            <th class="p-3 text-center w-32">Nilai</th>
            <th class="p-3 text-center w-40">Aksi</th>
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

            <td class="p-3 text-center">{{ $s->nilai ?? '-' }}</td>

            <td class="p-3">
                <form action="/nilai/{{ $s->id }}" method="POST" class="flex gap-2 justify-center">
                    @csrf
                    <input type="number" name="nilai" value="{{ $s->nilai }}" min="0" max="100"
                            class="border p-2 w-24 rounded text-center">
                    <button class="bg-blue-600 text-white px-3 rounded hover:bg-blue-700">
                        Simpan
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="p-4 text-center text-gray-500">Belum ada data siswa.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
