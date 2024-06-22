<x-master-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Assign Permissions to {{ $role->name }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Permissions</h1>
        <form action="{{ route('roles.permissions.update', $role) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($permissions as $permission)
                    <label class="flex items-center">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                               @if(in_array($permission->id, $assignedPermissions)) checked @endif
                               class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $permission->name }}</span>
                    </label>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded inline-block">Save Permissions</button>
                <a href="{{ route('roles.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded inline-block">Cancel</a>
            </div>
        </form>
    </div>
</x-master-layout>
