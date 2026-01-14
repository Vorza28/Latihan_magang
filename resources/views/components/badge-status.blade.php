@props(['value' => 'belum'])

@php
    $isLunas = strtolower($value) === 'lunas';
@endphp

<span class="px-2 py-1 rounded text-white text-xs font-semibold {{ $isLunas ? 'bg-green-600' : 'bg-red-600' }}">
    {{ strtoupper($value) }}
</span>
