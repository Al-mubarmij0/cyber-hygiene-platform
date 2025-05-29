<x-admin-layout>
    <h2 class="text-xl font-semibold mb-4">Manage Tutorials</h2>
    <a href="{{ route('admin.tutorials.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mb-4">
        Create New Tutorial
    </a>

    @if($tutorials->isEmpty())
        <p class="text-gray-600">No tutorials found.</p>
    @else
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 border-b">ID</th>
                                <th class="py-2 px-4 border-b">Title</th>
                                <th class="py-2 px-4 border-b">Type</th>
                                <th class="py-2 px-4 border-b">Pre-Quiz</th>
                                <th class="py-2 px-4 border-b">Post-Quiz</th>
                                <th class="py-2 px-4 border-b">Public</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tutorials as $tutorial)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-b">{{ $tutorial->id }}</td>
                                    <td class="py-2 px-4 border-b">{{ Str::limit($tutorial->title, 50) }}</td>
                                    <td class="py-2 px-4 border-b">{{ ucfirst($tutorial->content_type) }}</td>
                                    <td class="py-2 px-4 border-b">{{ $tutorial->preQuiz->title ?? 'None' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $tutorial->postQuiz->title ?? 'None' }}</td>
                                    <td class="py-2 px-4 border-b">
                                        @if($tutorial->is_public)
                                            <span class="text-green-500 font-bold">Yes</span>
                                        @else
                                            <span class="text-red-500">No</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b flex space-x-2">
                                        <a href="{{ route('admin.tutorials.show', $tutorial->id) }}" class="text-green-600 hover:text-green-900">View</a>
                                        <a href="{{ route('admin.tutorials.edit', $tutorial->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('admin.tutorials.destroy', $tutorial->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tutorial?');">
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
                <div class="mt-4">
                    {{ $tutorials->links() }}
                </div>
            </div>
        </div>
    @endif
</x-admin-layout>