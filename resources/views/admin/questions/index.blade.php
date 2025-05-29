<x-admin-layout>
    <h2 class="text-xl font-semibold mb-4">Manage Questions</h2>
    <a href="{{ route('admin.questions.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mb-4">
        Create New Question
    </a>

    @if($questions->isEmpty())
        <p class="text-gray-600">No questions found.</p>
    @else
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 border-b">ID</th>
                                <th class="py-2 px-4 border-b">Question Text</th>
                                <th class="py-2 px-4 border-b">Quiz</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-b">{{ $question->id }}</td>
                                    <td class="py-2 px-4 border-b">{{ Str::limit($question->question_text, 80) }}</td>
                                    <td class="py-2 px-4 border-b">{{ $question->quiz->title ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border-b flex space-x-2">
                                        <a href="{{ route('admin.questions.edit', $question->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question? This will also delete all associated answers.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</x-admin-layout>