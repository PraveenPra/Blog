<x-master-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit User</h1>
        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">New Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <p class="text-gray-500 text-sm mt-1">Leave blank to keep current password.</p>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700">Profile Image</label>
                @if($user->image)
                    <div class="mt-1">
                        <img src="{{ asset('images/' . $user->image) }}" alt="Current Image" class="rounded-lg h-40 w-auto">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</x-master-layout>
