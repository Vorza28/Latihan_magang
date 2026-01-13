@extends('layouts.app')
@section('content')
<h3>Tambah Kelas</h3>

<form method="POST" action="{{ route('kelas.store') }}">
@csrf
<input name="nama_kelas" placeholder="Nama Kelas"><br>
<input name="kompetensi_keahlian" placeholder="Kompetensi"><br>
<button>Simpan</button>
</form>
@endsection
