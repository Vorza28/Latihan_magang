@extends('layouts.dashboard')
@section('title','Edit Pembayaran')

@section('content')
<h2 class="text-xl font-bold mb-4">Edit Pembayaran</h2>

@if($errors->any())
<div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
    <ul class="list-disc ml-5">
    @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
</div>
@endif

<div class="bg-white p-5 rounded shadow max-w-2xl">
    <div class="mb-4">
    <div class="font-semibold">{{ $pembayaran->siswa->nama }} ({{ $pembayaran->siswa->nis }})</div>
    <div class="text-sm text-gray-500">Kelas: {{ $pembayaran->siswa->kelas?->nama_kelas ?? '-' }}</div>
    </div>

    <form action="{{ route('pembayaran.update',$pembayaran->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="grid grid-cols-2 gap-4">
        <div>
        <label class="block mb-2 font-semibold">Bulan</label>
        <input type="number" min="1" max="12" name="bulan" class="border p-2 rounded w-full"
                value="{{ old('bulan', $pembayaran->bulan) }}" required>
        </div>
        <div>
        <label class="block mb-2 font-semibold">Tahun</label>
        <input type="number" name="tahun" class="border p-2 rounded w-full"
                value="{{ old('tahun', $pembayaran->tahun) }}" required>
        </div>
    </div>

    <label class="block mt-4 mb-2 font-semibold">Jumlah Bayar</label>
    <input type="number" name="jumlah_bayar" class="border p-2 rounded w-full"
            value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar) }}" required>

    <label class="block mt-4 mb-2 font-semibold">Tanggal Bayar</label>
    <input type="date" name="tanggal_bayar" class="border p-2 rounded w-full"
            value="{{ old('tanggal_bayar', optional($pembayaran->tanggal_bayar)->format('Y-m-d')) }}">

    <label class="block mt-4 mb-2 font-semibold">Status</label>
    <select name="status" class="border p-2 rounded w-full" required>
        <option value="belum" @selected(old('status', $pembayaran->status)=='belum')>Belum</option>
        <option value="lunas" @selected(old('status', $pembayaran->status)=='lunas')>Lunas</option>
    </select>

    <label class="block mt-4 mb-2 font-semibold">Keterangan</label>
    <input type="text" name="keterangan" class="border p-2 rounded w-full"
            value="{{ old('keterangan', $pembayaran->keterangan) }}">

    <div class="mt-5 flex gap-3">
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('pembayaran.index') }}" class="px-4 py-2 rounded border">Kembali</a>
    </div>
    </form>
</div>
@endsection
