<div>
    <x-header/>

    <div class="max-w-3xl mx-auto px-4 py-12">
        @if (session('message'))
            <div class="p-4 mb-4 text-sm  text-green-500 rounded-lg bg-green-50" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <!-- Single Post -->
        <x-posts.post-card :post="$post" />

        <livewire:comments.index :post="$post"/>
    </div>
</div>
