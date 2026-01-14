@if($errors->any())
    <div class="mb-4 p-3 rounded bg-red-100 text-red-700 border border-red-200">
        <ul class="list-disc ml-5">
        @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
        @endforeach
        </ul>
    </div>
@endif
