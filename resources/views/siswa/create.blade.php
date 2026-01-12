@extends('layouts.dashboard')
@section('title','Tambah Siswa')

@section('content')
<form method="POST" action="/siswa" class="bg-white p-6 rounded shadow max-w-xl">
@csrf
<input name="nama" placeholder="Nama" class="border p-3 w-full mb-3 rounded">
<input name="nis" placeholder="NIS" class="border p-3 w-full mb-3 rounded">
<input name="kelas" placeholder="Kelas" class="border p-3 w-full mb-3 rounded">

<button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
<a href="/siswa" class="ml-3 text-gray-600">Batal</a>
</form>
@endsection
