<!-- resources/views/artisan/index.blade.php -->
<x-master-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artisan Commands') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Run Artisan Commands</h1>

        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($commands as $command)
                <form action="{{ route('artisan.run') }}" method="POST">
                    @csrf
                    <input type="hidden" name="command" value="{{ $command }}">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full text-left shadow hover:bg-blue-600 transition duration-200">
                        php artisan {{ $command }}
                    </button>
                </form>
            @endforeach
        </div>
    </div>
</x-master-layout>
