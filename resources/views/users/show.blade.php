<x-master-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="name">
                                Name:
                            </label>
                            <p class="text-gray-700">{{ $user->name }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="email">
                                Email:
                            </label>
                            <p class="text-gray-700">{{ $user->email }}</p>
                        </div>

                        @if($user->image)
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="image">
                                    Image:
                                </label>
                                <img src="{{ asset('images/'.$user->image) }}" class="mt-2 max-w-xs" alt="User Image">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
