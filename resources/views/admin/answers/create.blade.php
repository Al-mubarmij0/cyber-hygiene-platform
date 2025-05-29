<x-admin-layout>
    <h2 class="text-xl font-semibold mb-4">Create New Answer</h2>

    <form action="{{ route('admin.answers.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-sm">
        @csrf
        <div class="mb-4">
            <label for="question_id" class="block text-gray-700 text-sm font-bold mb-2">Select Question:</label>
            <select name="question_id" id="question_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('question_id') border-red-500 @enderror" required>
                <option value="">-- Select Question --</option>
                @foreach($questions as $question)
                    <option value="{{ $question->id }}" {{ old('question_id') == $question->id ? 'selected' : '' }}>{{ Str::limit($question->question_text, 80) }}</option>
                @endforeach
            </select>
            @error('question_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="answer_text" class="block text-gray-700 text-sm font-bold mb-2">Answer Text:</label>
            <textarea name="answer_text" id="answer_text" rows="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('answer_text') border-red-500 @enderror" required>{{ old('answer_text') }}</textarea>
            @error('answer_text')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

         <div class="mb-4 flex items-center">
            <input type="hidden" name="is_correct" value="0">
            
            <input type="checkbox" name="is_correct" id="is_correct" value="1" class="form-checkbox h-5 w-5 text-indigo-600 transition duration-150 ease-in-out" {{ old('is_public', '1') == '1' ? 'checked' : '' }}>
            
            <label for="is_correct" class="ml-2 block text-gray-700 text-sm font-bold">Is Correct Answer?</label>
            @error('is_public')
                <p class="text-red-500 text-xs italic ml-4">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Create Answer
            </button>
            <a href="{{ route('admin.answers.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                Cancel
            </a>
        </div>
    </form>
</x-admin-layout>