@if(session('success'))
<div class="bg-green-200 border-green-600 border-l-4 text-green-900 p-4 mb-4" role="alert">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="bg-red-200 border-red-600 border-l-4 text-red-900 p-4 mb-4" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
