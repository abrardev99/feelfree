<!-- Comments Section -->
<div class="bg-white rounded-xl shadow-md p-6 border border-green-100 mt-8">
    <div class="flex items-center justify-between mb-8">
        <h3 class="text-xl font-semibold text-gray-800">
            Comments 
            @if($comments->count() > 0)
                <span class="text-sm font-normal text-gray-500 ml-2">({{ $comments->count() }})</span>
            @endif
        </h3>
    </div>

    <!-- New Comment Form -->
    <div class="mb-4">
        <form wire:submit.prevent="save" class="space-y-4">
            <div class="relative">
                <textarea
                    required
                    wire:model="body"
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 min-h-[100px]"
                    placeholder="Add a comment..."
                    x-data="{ charCount: 0 }"
                    x-on:input="charCount = $event.target.value.length"
                ></textarea>

                @error('body')
                    <span class="error text-red-500 text-sm flex items-center gap-1 mt-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="px-5 py-2 flex items-center gap-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Comment</span>
                    <svg wire:loading class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    <span wire:loading> Posting...</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Comments List -->
    <div class="space-y-6">
        @forelse($comments as $comment)
            <div 
                class="border-b border-gray-100 pb-6 last:border-b-0 last:pb-0" 
                wire:key="comment-{{ $comment->id }}"
            >
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">
                        {{ $comment->created_at->diffForHumans() }}
                    </span>
                    <div class="flex items-center gap-3">
                        <livewire:reaction 
                            :reactionableId="$comment->id" 
                            reactionableType="comment" 
                            reaction="support" 
                            :key="$comment->id"
                        />
                    </div>
                </div>

                <p class="text-gray-600 mt-2">
                    {{ $comment->body }}
                </p>
            </div>
        @empty
            <div class="text-center pb-4">
                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <p class="text-gray-500 mb-2">No comments yet</p>
                <p class="text-sm text-gray-400">Be the first to share your thoughts!</p>
            </div>
        @endforelse
    </div>
</div>