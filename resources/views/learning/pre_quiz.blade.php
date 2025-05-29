<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pre-Quiz for: ') }} {{ $tutorial->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4 class="text-lg font-bold mb-4">Please complete this short quiz before starting the tutorial.</h4>
                    @if($quiz->questions->isEmpty())
                        <p class="text-gray-600">This quiz has no questions yet. Please contact an administrator.</p>
                    @else
                        <form action="{{ route('learn.submit_pre_quiz', $tutorial) }}" method="POST">
                            @csrf

                            @foreach ($quiz->questions as $question)
                                <div class="mb-6 p-4 border border-gray-200 rounded-md bg-gray-50">
                                    <p class="font-semibold mb-2 text-lg">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                                    @error('answers.' . $question->id)
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    @if($question->answers->isEmpty())
                                        <p class="text-gray-500 text-sm">No answers available for this question.</p>
                                    @else
                                        <div class="mt-2">
                                            @foreach ($question->answers as $answer)
                                                <div class="flex items-center mb-2">
                                                    <input type="radio" name="answers[{{ $question->id }}]"
                                                        id="question{{ $question->id }}-answer{{ $answer->id }}"
                                                        value="{{ $answer->id }}"
                                                        class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                                        {{ old('answers.' . $question->id) == $answer->id ? 'checked' : '' }}>
                                                    <label for="question{{ $question->id }}-answer{{ $answer->id }}" class="ml-2 text-gray-700">
                                                        {{ $answer->answer_text }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                            <div class="flex justify-end mt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Submit Pre-Quiz
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>