<x-master-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Submissions') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Contact Submissions</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Message</th>
                        <th class="py-3 px-6 text-left">Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="py-3 px-6">{{ $submission->id }}</td>
                            <td class="py-3 px-6">{{ $submission->name }}</td>
                            <td class="py-3 px-6">{{ $submission->email }}</td>
                            <td class="py-3 px-6">{{ $submission->message }}</td>
                            <td class="py-3 px-6">{{ $submission->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $submissions->links() }}
        </div>
    </div>
</x-master-layout>
