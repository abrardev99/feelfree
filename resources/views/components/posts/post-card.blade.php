<a href="{{ route('posts.show', $post->uuid) }}">
    <div
        class="bg-white rounded-lg shadow-md p-6 border border-green-100 hover:shadow-lg hover:border-green-200 transition-all duration-200 hover:bg-green-50 flex flex-col h-full">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
        </div>
        {{-- 
            Previously used PHP string manipulation (str()->limit()) for truncation
            Switched to CSS line-clamp for better performance and flexibility
            Added fixed height on larger devices to maintain consistent card sizes
        --}}
        <p class="text-gray-600 mb-2 {{ request()->routeIs('posts.show') ? '' : 'h-auto md:h-12 line-clamp-2' }}">
            {{ $post->body }}
        </p>
        {{-- Display post tag with consistent padding since only one tag is allowed per post --}}
        <div class="flex flex-wrap mb-4">
            @foreach ($post->tags as $tag)
                <div class="px-3 text-sm bg-green-50 text-green-600 rounded-full">
                    #{{ $tag->name }}
                </div>
            @endforeach
        </div>
        <div class="flex items-center justify-between pt-4 mt-auto border-t border-green-100">
            <div class="flex items-center space-x-4 text-gray-500">

            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center text-gray-500">
                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-sm">{{ $post->views }}</span>
                </div>
                <livewire:reaction :reactionableId="$post->uuid" reactionableType="post" reaction="support" :key="'reaction-' . $post->uuid" />
                @if (isset($post->comments_count))
                    <button class="flex items-center text-green-600 hover:text-green-700 transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                        </svg>
                        <span x-data x-tooltip.raw="Leave a comment" class="text-sm">{{ $post->comments_count }}
                            Comment</span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</a>
