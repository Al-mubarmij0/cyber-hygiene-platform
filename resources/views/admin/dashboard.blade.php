<x-admin-layout>
    <h3 class="text-xl font-semibold mb-4">Welcome to the Admin Panel!</h3>
    <p class="mb-6">Here's a quick overview of your platform's content:</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-green-100 p-4 rounded-lg shadow">
            <h4 class="text-lg font-semibold">Tutorials</h4>
            <p class="text-2xl font-bold">{{ $tutorialCount }}</p>
            <a href="{{ route('admin.tutorials.index') }}" class="text-green-600 hover:underline">Manage Tutorials</a>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg shadow">
            <h4 class="text-lg font-semibold">Quizzes</h4>
            <p class="text-2xl font-bold">{{ $quizCount }}</p>
            <a href="{{ route('admin.quizzes.index') }}" class="text-purple-600 hover:underline">Manage Quizzes</a>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg shadow">
            <h4 class="text-lg font-semibold">Questions</h4>
            <p class="text-2xl font-bold">{{ $questionCount }}</p>
            <a href="{{ route('admin.questions.index') }}" class="text-yellow-600 hover:underline">Manage Questions</a>
        </div>
        <div class="bg-red-100 p-4 rounded-lg shadow">
            <h4 class="text-lg font-semibold">Answers</h4>
            <p class="text-2xl font-bold">{{ $answerCount }}</p>
            <a href="{{ route('admin.answers.index') }}" class="text-red-600 hover:underline">Manage Answers</a>
        </div>
    </div>
</x-admin-layout>