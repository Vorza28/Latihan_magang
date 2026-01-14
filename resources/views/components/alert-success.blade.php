@if(session('success'))
    <div class="mb-4 p-3 rounded bg-green-100 text-green-700 border border-green-200">
        {{ session('success') }}
    </div>
@endif
