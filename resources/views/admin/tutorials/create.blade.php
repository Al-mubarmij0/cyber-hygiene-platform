<x-admin-layout>
    <h2 class="text-xl font-semibold mb-4">Create New Tutorial</h2>

    <form action="{{ route('admin.tutorials.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-sm">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Tutorial Title:</label>
            <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="summary" class="block text-gray-700 text-sm font-bold mb-2">Summary (Optional):</label>
            <textarea name="summary" id="summary" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('summary') border-red-500 @enderror">{{ old('summary') }}</textarea>
            @error('summary')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="pre_quiz_id" class="block text-gray-700 text-sm font-bold mb-2">Pre-Tutorial Quiz (Optional):</label>
            <select name="pre_quiz_id" id="pre_quiz_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pre_quiz_id') border-red-500 @enderror">
                <option value="">-- Select Pre-Quiz --</option>
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}" {{ old('pre_quiz_id') == $quiz->id ? 'selected' : '' }}>{{ $quiz->title }}</option>
                @endforeach
            </select>
            @error('pre_quiz_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="post_quiz_id" class="block text-gray-700 text-sm font-bold mb-2">Post-Tutorial Quiz (Optional):</label>
            <select name="post_quiz_id" id="post_quiz_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('post_quiz_id') border-red-500 @enderror">
                <option value="">-- Select Post-Quiz --</option>
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}" {{ old('post_quiz_id') == $quiz->id ? 'selected' : '' }}>{{ $quiz->title }}</option>
                @endforeach
            </select>
            @error('post_quiz_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="content_type" class="block text-gray-700 text-sm font-bold mb-2">Content Type:</label>
            <select name="content_type" id="content_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('content_type') border-red-500 @enderror" required>
                <option value="text" {{ old('content_type') == 'text' ? 'selected' : '' }}>Text</option>
                <option value="image" {{ old('content_type') == 'image' ? 'selected' : '' }}>Image</option>
                <option value="video" {{ old('content_type') == 'video' ? 'selected' : '' }}>Video (URL)</option>
                <option value="mixed" {{ old('content_type') == 'mixed' ? 'selected' : '' }}>Mixed (Text, Image, Video)</option>
            </select>
            @error('content_type')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        {{-- Dynamic content fields --}}
        <div id="text-content-fields" class="mb-4" style="display: {{ old('content_type', 'text') == 'text' || old('content_type') == 'mixed' ? 'block' : 'none' }};">
            <label for="content_text" class="block text-gray-700 text-sm font-bold mb-2">Tutorial Text Content:</label>
            <textarea name="content_text" id="content_text" rows="8" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('content_text') border-red-500 @enderror">{{ old('content_text') }}</textarea>
            @error('content_text')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div id="image-content-fields" class="mb-4" style="display: {{ old('content_type') == 'image' || old('content_type') == 'mixed' ? 'block' : 'none' }};">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Upload Image:</label>
            <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror">
            @error('image')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div id="video-content-fields" class="mb-4" style="display: {{ old('content_type') == 'video' || old('content_type') == 'mixed' ? 'block' : 'none' }};">
            <label for="video_url" class="block text-gray-700 text-sm font-bold mb-2">Video URL (e.g., YouTube link):</label>
            <input type="url" name="video_url" id="video_url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('video_url') border-red-500 @enderror" value="{{ old('video_url') }}">
            @error('video_url')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="order" class="block text-gray-700 text-sm font-bold mb-2">Order (Optional, for sorting):</label>
            <input type="number" name="order" id="order" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('order') border-red-500 @enderror" value="{{ old('order', 0) }}">
            @error('order')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4 flex items-center">
            <input type="hidden" name="is_public" value="0">
            
            <input type="checkbox" name="is_public" id="is_public" value="1" class="form-checkbox h-5 w-5 text-indigo-600 transition duration-150 ease-in-out" {{ old('is_public', '1') == '1' ? 'checked' : '' }}>
            
            <label for="is_public" class="ml-2 block text-gray-700 text-sm font-bold">Make Public (Visible to users)</label>
            @error('is_public')
                <p class="text-red-500 text-xs italic ml-4">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Create Tutorial
            </button>
            <a href="{{ route('admin.tutorials.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                Cancel
            </a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const contentTypeSelect = document.getElementById('content_type');
            const textContentFields = document.getElementById('text-content-fields');
            const imageContentFields = document.getElementById('image-content-fields');
            const videoContentFields = document.getElementById('video-content-fields');

            function toggleContentFields() {
                const selectedType = contentTypeSelect.value;

                textContentFields.style.display = (selectedType === 'text' || selectedType === 'mixed') ? 'block' : 'none';
                imageContentFields.style.display = (selectedType === 'image' || selectedType === 'mixed') ? 'block' : 'none';
                videoContentFields.style.display = (selectedType === 'video' || selectedType === 'mixed') ? 'block' : 'none';
            }

            contentTypeSelect.addEventListener('change', toggleContentFields);
            toggleContentFields(); // Call on initial load
        });
    </script>
</x-admin-layout>