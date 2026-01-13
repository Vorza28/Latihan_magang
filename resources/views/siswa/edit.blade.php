@extends('layouts.dashboard')
@section('title','Edit Siswa')

@section('content')
<form method="POST" action="/siswa/{{ $siswa->id }}" class="bg-white p-6 rounded shadow max-w-xl">
@csrf @method('PUT')
<input name="nama" value="{{ $siswa->nama }}" class="border p-3 w-full mb-3 rounded">
<input name="nis" value="{{ $siswa->nis }}" class="border p-3 w-full mb-3 rounded">
<select name="kelas_id" class="border p-3 w-full mb-3 rounded">
    @foreach($kelas as $k)
        <option value="{{ $k->id }}" @selected($siswa->kelas_id == $k->id)>
        {{ $k->nama_kelas }}
        </option>
    @endforeach
</select>

<select name="spp_id" class="border p-3 w-full mb-3 rounded">
    @foreach($spps as $s)
        <option value="{{ $s->id }}" @selected($siswa->spp_id == $s->id)>
        {{ $s->tahun }} - {{ number_format($s->nominal) }}
        </option>
    @endforeach
</select>


<button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
<a href="/siswa" class="ml-3 text-gray-600">Batal</a>
</form>
@endsection
