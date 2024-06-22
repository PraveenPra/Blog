<x-master-layout>
    <!-- Success and Error Alerts -->
    @include('partials.alerts')
    
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Contact Me</h1>
        <p class="mb-4">If you have any questions, feedback, or just want to say hello, feel free to reach out to me through the form below.</p>

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="message" class="block text-gray-700">Message</label>
                <textarea name="message" id="message" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Send Message</button>
            </div>
        </form>
    </div>
</x-master-layout>
