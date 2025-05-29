<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Learning Results for: ') }} {{ $tutorial->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Your Learning Journey is Complete!</h3>

                    @if(isset($preQuizScore))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong>Pre-Quiz Score:</strong> {{ $preQuizScore }} out of {{ $tutorial->preQuiz->questions->count() ?? 'N/A' }}
                        </div>
                    @endif

                    @if(isset($postQuizScore))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong>Post-Quiz Score:</strong> {{ $postQuizScore }} out of {{ $tutorial->postQuiz->questions->count() ?? 'N/A' }}
                        </div>
                    @endif

                    <p class="text-lg mt-6">Thank you for completing the tutorial "{{ $tutorial->title }}".</p>
                    <p class="text-gray-700">We hope you gained valuable knowledge on cyber hygiene!</p>

                    <div class="flex justify-center gap-4 mt-8">
                        <a href="{{ route('learn.start') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 text-lg">
                            Start Another Guided Tutorial
                        </a>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 text-lg">
                            Go to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>