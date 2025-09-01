<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class ReplyThread extends Component
{
    public $reply;

    public $level = 0;

    public $post;

    public function mount($reply, $post, $level = 0): void
    {
        $this->reply = $reply;
        $this->post = $post;
        $this->level = $level;
    }

    public function render(): View
    {
        return view('livewire.reply-thread');
    }
}
