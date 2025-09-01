<?php

namespace App\Livewire;

use App\Models\Community;
use Illuminate\View\View;
use Livewire\Component;

class CommunityPostsList extends Component
{
    /**s
     * @var Community
     */
    public Community $community;

    public function mount(Community $community): void
    {
        $this->community = $community;
    }

    public function render(): View
    {
        $posts = $this->community
            ->posts()
            ->with('author')
            ->withCount('replies')
            ->latest()
            ->get();

        return view('livewire.community-posts-list', compact('posts'));
    }
}
