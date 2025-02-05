<?php

declare(strict_types=1);

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('All')]
class Index extends Component
{
    #[Url]
    public string $by = '';

    public int $perPage = 100;
    public bool $hasMore = true;

    public function loadMore(): void
    {
        if ($this->hasMore) {
            $this->perPage += 10;
        }
    }

    public function render()
    {
        $posts = Post::query()
            ->withCount(['comments'])
            ->with(['tags'])
            ->latest($this->by == 'popular' ? 'views' : 'created_at')
            ->paginate($this->perPage);

        $this->hasMore = count($posts) >= $this->perPage;

        return view('livewire.posts.index', [
            'posts' => $posts,
        ]);
    }
}
