@extends('layouts.app')
@section('content')
<h3>Data SPP</h3>
<a href="{{ route('spp.create') }}">Tambah</a>

<table border="1">
<tr>
    <th>Tahun</th>
    <th>Nominal</th>
    <th>Aksi</th>
</tr>
@foreach($spps as $s)
<tr>
    <td>{{ $s->tahun }}</td>
    <td>{{ number_format($s->nominal) }}</td>
    <td>
        <a href="{{ route('spp.edit',$s->id) }}">Edit</a>
        <form action="{{ route('spp.destroy',$s->id) }}" method="POST">
            @csrf @method('DELETE')
            <button>Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endsection
