<x-admin-layout>
    <h2 class="text-xl font-semibold mb-4">Edit Question: {{ Str::limit($question->question_text, 50) }}</h2>

    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="quiz_id" class="block text-gray-700 text-sm font-bold mb-2">Select Quiz:</label>
            <select name="quiz_id" id="quiz_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('quiz_id') border-red-500 @enderror" required>
                <option value="">-- Select Quiz --</option>
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}" {{ old('quiz_id', $question->quiz_id) == $quiz->id ? 'selected' : '' }}>{{ $quiz->title }}</option>
                @endforeach
            </select>
            @error('quiz_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="question_text" class="block text-gray-700 text-sm font-bold mb-2">Question Text:</label>
            <textarea name="question_text" id="question_text" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('question_text') border-red-500 @enderror" required>{{ old('question_text', $question->question_text) }}</textarea>
            @error('question_text')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Update Question
            </button>
            <a href="{{ route('admin.questions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                Cancel
            </a>
        </div>
    </form>
</x-admin-layout>