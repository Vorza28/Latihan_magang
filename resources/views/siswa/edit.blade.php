@extends('layouts.dashboard')
@section('title','Edit Siswa')

@section('content')
<form method="POST" action="/siswa/{{ $siswa->id }}" class="bg-white p-6 rounded shadow max-w-xl">
@csrf @method('PUT')
<input name="nama" value="{{ $siswa->nama }}" class="border p-3 w-full mb-3 rounded">
<input name="nis" value="{{ $siswa->nis }}" class="border p-3 w-full mb-3 rounded">
<input name="kelas" value="{{ $siswa->kelas }}" class="border p-3 w-full mb-3 rounded">

<button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
<a href="/siswa" class="ml-3 text-gray-600">Batal</a>
</form>
@endsection
