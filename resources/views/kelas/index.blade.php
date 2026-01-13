@extends('layouts.app')

@section('content')
<h3>Data Kelas</h3>
<a href="{{ route('kelas.create') }}">Tambah</a>

<table border="1">
<tr>
    <th>Nama Kelas</th>
    <th>Kompetensi</th>
    <th>Aksi</th>
</tr>
@foreach($kelas as $k)
<tr>
    <td>{{ $k->nama_kelas }}</td>
    <td>{{ $k->kompetensi_keahlian }}</td>
    <td>
        <a href="{{ route('kelas.edit',$k->id) }}">Edit</a>
        <form action="{{ route('kelas.destroy',$k->id) }}" method="POST">
            @csrf @method('DELETE')
            <button>Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endsection
