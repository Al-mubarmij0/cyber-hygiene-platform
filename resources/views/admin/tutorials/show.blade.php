<x-admin-layout>
    <h2 class="text-xl font-semibold mb-4">Tutorial Details: {{ $tutorial->title }}</h2>

    <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <p class="font-bold text-gray-700">Title:</p>
                <p class="text-gray-900">{{ $tutorial->title }}</p>
            </div>
            <div>
                <p class="font-bold text-gray-700">Summary:</p>
                <p class="text-gray-900">{{ $tutorial->summary ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="font-bold text-gray-700">Content Type:</p>
                <p class="text-gray-900">{{ ucfirst($tutorial->content_type) }}</p>
            </div>
            <div>
                <p class="font-bold text-gray-700">Order:</p>
                <p class="text-gray-900">{{ $tutorial->order }}</p>
            </div>
            <div>
                <p class="font-bold text-gray-700">Pre-Quiz:</p>
                <p class="text-gray-900">{{ $tutorial->preQuiz->title ?? 'None' }}</p>
            </div>
            <div>
                <p class="font-bold text-gray-700">Post-Quiz:</p>
                <p class="text-gray-900">{{ $tutorial->postQuiz->title ?? 'None' }}</p>
            </div>
            <div>
                <p class="font-bold text-gray-700">Public:</p>
                <p class="text-gray-900">{{ $tutorial->is_public ? 'Yes' : 'No' }}</p>
            </div>
        </div>

        @if($tutorial->content_type === 'text' || $tutorial->content_type === 'mixed')
            <div class="mb-4 border-t pt-4">
                <p class="font-bold text-gray-700">Text Content:</p>
                <p class="text-gray-900 prose max-w-none">{!! nl2br(e($tutorial->content_text)) !!}</p>
            </div>
        @endif

        @if(($tutorial->content_type === 'image' || $tutorial->content_type === 'mixed') && $tutorial->image_path)
            <div class="mb-4 border-t pt-4 text-center">
                <p class="font-bold text-gray-700 mb-2">Image:</p>
                <img src="{{ asset('storage/' . $tutorial->image_path) }}" alt="{{ $tutorial->title }}" class="max-w-md h-auto rounded-lg shadow-md mx-auto">
            </div>
        @endif

        @if(($tutorial->content_type === 'video' || $tutorial->content_type === 'mixed') && $tutorial->video_url)
            <div class="mb-4 border-t pt-4">
                <p class="font-bold text-gray-700 mb-2">Video URL:</p>
                <a href="{{ $tutorial->video_url }}" target="_blank" class="text-blue-600 hover:underline">{{ $tutorial->video_url }}</a>
                <div class="mt-2 relative pt-[56.25%]"> {{-- Basic Embed logic, enhance as needed for specific platforms --}}
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
                            <p class="text-red-500">Invalid YouTube URL provided for preview.</p>
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


        <div class="flex items-center justify-start mt-6 space-x-4">
            <a href="{{ route('admin.tutorials.edit', $tutorial->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Edit Tutorial
            </a>
            <a href="{{ route('admin.tutorials.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                Back to List
            </a>
        </div>
    </div>
</x-admin-layout>