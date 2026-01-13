@extends('layouts.app')
@section('content')
<h3>Edit Kelas</h3>

<form method="POST" action="{{ route('kelas.update',$kelas->id) }}">
@csrf @method('PUT')
<input name="nama_kelas" value="{{ $kelas->nama_kelas }}"><br>
<input name="kompetensi_keahlian" value="{{ $kelas->kompetensi_keahlian }}"><br>
<button>Update</button>
</form>
@endsection
