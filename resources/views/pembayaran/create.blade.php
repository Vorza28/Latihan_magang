@extends('layouts.dashboard')
@section('title','Input Pembayaran')

@section('content')
<h2 class="text-xl font-bold mb-4">Input Pembayaran SPP</h2>

<x-alert-errors />

<form action="{{ route('pembayaran.store') }}" method="POST" class="bg-white p-5 rounded shadow max-w-2xl">
@csrf

<label class="block mb-2 font-semibold">Pilih Siswa</label>
<select name="siswa_id" class="border p-2 rounded w-full mb-4" required>
<option value="">- pilih -</option>
@foreach($siswas as $s)
    <option value="{{ $s->id }}" @selected(old('siswa_id')==$s->id)>
    {{ $s->nama }} ({{ $s->nis }}) - {{ $s->kelas?->nama_kelas ?? '-' }}
    </option>
@endforeach
</select>

<div class="grid grid-cols-2 gap-4">
<div>
    <label class="block mb-2 font-semibold">Bulan (1-12)</label>
    <input type="number" min="1" max="12" name="bulan" class="border p-2 rounded w-full"
            value="{{ old('bulan') }}" required>
</div>
<div>
    <label class="block mb-2 font-semibold">Tahun</label>
    <input type="number" name="tahun" class="border p-2 rounded w-full"
            value="{{ old('tahun', date('Y')) }}" required>
</div>
</div>

<label class="block mt-4 mb-2 font-semibold">Jumlah Bayar</label>
<input type="number" name="jumlah_bayar" class="border p-2 rounded w-full"
        value="{{ old('jumlah_bayar', 0) }}" required>

<label class="block mt-4 mb-2 font-semibold">Tanggal Bayar</label>
<input type="date" name="tanggal_bayar" class="border p-2 rounded w-full"
        value="{{ old('tanggal_bayar') }}">

<label class="block mt-4 mb-2 font-semibold">Status</label>
<select name="status" class="border p-2 rounded w-full" required>
<option value="belum" @selected(old('status')=='belum')>Belum</option>
<option value="lunas" @selected(old('status')=='lunas')>Lunas</option>
</select>

<label class="block mt-4 mb-2 font-semibold">Keterangan (opsional)</label>
<input type="text" name="keterangan" class="border p-2 rounded w-full"
        value="{{ old('keterangan') }}">

<div class="mt-5 flex gap-3">
<button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
<a href="{{ route('pembayaran.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">Kembali</a>
</div>
</form>
@endsection
