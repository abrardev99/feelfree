<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-300 hover:shadow-xl">
        <form wire:submit="save" class="space-y-6">
            <div class="relative">
                <textarea
                    wire:model="form.body"
                    name="worry"
                    rows="4"
                    class="w-full px-4 py-3 outline-none border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent min-h-[120px] transition-[outline,ring,border,background-color,color,box-shadow,opacity,transform] duration-200"
                    placeholder="Share your thoughts anonymously..."
                ></textarea>
                <div class="absolute bottom-3 right-3 flex items-center space-x-2 text-sm text-gray-400">
                    <span x-show="$wire.form.body.length > 0" x-text="$wire.form.body.length + ' / 500'"></span>
                </div>
                @error('form.body') 
                    <span class="mt-1 text-sm text-red-500 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="space-y-2">
                
                <select
                    wire:model="form.tag"
                    name="tags"
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent appearance-none bg-white transition-all duration-200"
                >
                    <option value="">Select a tag</option>
                    @foreach(\App\Models\Tag::all() as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Tag your worry to help others find similar experiences
                </p>
                @error('form.tag') 
                    <span class="text-sm text-red-500 flex items-center gap-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button
                    type="submit"
                    class="bg-green-600 flex items-center gap-2 text-white px-6 py-2 rounded-lg font-medium transform transition-all duration-200 hover:bg-green-700 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 active:scale-95"
                >
                    <span wire:loading.remove>Share Anonymously</span>
                        <svg wire:loading class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading>Posting...</span>
                </button>
            </div>
        </form>
    </div>
</div>