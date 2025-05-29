<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tutorial: ') }} {{ $tutorial->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('pre_quiz_score'))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                            Your Pre-Quiz Score: {{ session('pre_quiz_score') }} out of {{ $tutorial->preQuiz->questions->count() ?? 'N/A' }}
                        </div>
                    @endif

                    <h3 class="text-2xl font-bold mb-4">{{ $tutorial->title }}</h3>
                    <p class="text-gray-600 mb-6">{{ $tutorial->summary }}</p>

                    {{-- Display tutorial content based on type --}}
                    @if($tutorial->content_type === 'text' || $tutorial->content_type === 'mixed')
                        <div class="mb-6">
                            <h4 class="text-xl font-semibold mb-2">Content:</h4>
                            <div class="prose max-w-none">
                                {!! nl2br(e($tutorial->content_text)) !!}
                            </div>
                        </div>
                    @endif

                    @if(($tutorial->content_type === 'image' || $tutorial->content_type === 'mixed') && $tutorial->image_path)
                        <div class="mb-6 text-center">
                            <h4 class="text-xl font-semibold mb-2">Image:</h4>
                            <img src="{{ asset('storage/' . $tutorial->image_path) }}" class="max-w-full h-auto rounded-lg shadow-md mx-auto" alt="{{ $tutorial->title }}" style="max-height: 500px;">
                        </div>
                    @endif

                    @if(($tutorial->content_type === 'video' || $tutorial->content_type === 'mixed') && $tutorial->video_url)
                        <div class="mb-6">
                            <h4 class="text-xl font-semibold mb-2">Video:</h4>
                            <div class="relative pt-[56.25%]"> {{-- Basic Embed logic, enhance as needed for specific platforms --}}
                                @if(str_contains($tutorial->video_url, 'youtube.com/watch') || str_contains($tutorial->video_url, 'youtu.be/'))
                                    @php
                                        $videoId = '';
                                        parse_str( parse_url( $tutorial->video_url, PHP_URL_QUERY ), $vars );
                                        $videoId = $vars['v'] ?? '';
                                        if (!$videoId && str_contains($tutorial->video_url, 'youtu.be/')) {
                                            $videoId = substr(parse_url($tutorial->video_url, PHP_URL_PATH), 1);
                                        }
                                    @endphp
                                    @if($videoId)
                                        <iframe class="absolute top-0 left-0 w-full h-full rounded-lg shadow-md" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @else
                                        <p class="text-red-500">Invalid YouTube URL provided.</p>
                                    @endif
                                @elseif(str_contains($tutorial->video_url, 'vimeo.com'))
                                    @php
                                        $videoId = substr(parse_url($tutorial->video_url, PHP_URL_PATH), 1);
                                    @endphp
                                    <iframe class="absolute top-0 left-0 w-full h-full rounded-lg shadow-md" src="https://player.vimeo.com/video/{{ $videoId }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                @else
                                    <p class="text-gray-500">Video preview not available for this URL type.</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Button to proceed to post-quiz or results --}}
                    <div class="flex justify-end mt-8">
                        <form action="{{ route('learn.complete_tutorial', $tutorial) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 text-lg">
                                {{ $tutorial->post_quiz_id ? 'Proceed to Post-Quiz' : 'Complete Tutorial' }}
                                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10H4a1 1 0 110-2h10.586l-4.293-4.293a1 1 0 111.414-1.414l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>