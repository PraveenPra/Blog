<x-master-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" id="edit-form">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="editor" class="block text-gray-700">Body</label>
                <div id="editor" style="height:300px">
                    {!! $post->body !!}
                </div>
                <textarea name="body" style="display:none;"></textarea>
            </div>


            <div class="mb-4">

                <label for="image" class="block text-gray-700">Image</label>
                <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('image') border-red-500 @enderror">
                <small class="text-gray-500">Or paste an image URL:</small>
                <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $post->image_url ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('image')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                @if($post->image && filter_var($post->image, FILTER_VALIDATE_URL))
                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
                @elseif($post->image)
                <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
                @else
                <div class="h-64 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No Image Available</span>
                </div>
                @endif
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="tags" class="block text-gray-700">Tags</label>
                <select name="tags[]" id="tags" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" multiple>
                    @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>

    <!-- <script src="https://cdn.quilljs.com/1.3.6/quill.min.js" defer></script> -->
    <script>
        var editor = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                    ['blockquote', 'code-block'],
                    ['link', 'image', 'video', 'formula'],

                    [{
                        'header': 1
                    }, {
                        'header': 2
                    }], // custom button values
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }, {
                        'list': 'check'
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }], // superscript/subscript
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }], // outdent/indent
                    [{
                        'direction': 'rtl'
                    }], // text direction

                    [{
                        'size': ['small', false, 'large', 'huge']
                    }], // custom dropdown
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],

                    [{
                        'color': []
                    }, {
                        'background': []
                    }], // dropdown with defaults from theme
                    [{
                        'font': []
                    }],
                    [{
                        'align': []
                    }],

                    ['clean'] // remove formatting button                                        
                ]
            }
        });

        document.getElementById('edit-form').addEventListener('submit', function(e) {
            var body = document.querySelector('textarea[name=body]');
            body.value = editor.root.innerHTML;
            // Uncomment for debugging to see if content is set correctly
            console.log(body.value);
            //e.preventDefault(); // Uncomment to prevent form submission for testing
        });
    </script>
</x-master-layout>