<?php

namespace App\Livewire;

use App\Models\Reply;
use Livewire\Component;

class ReplyForm extends Component
{
    public int $postId;
    public ?int $parentId = null;
    public string $content = '';

    public int $replies_count = 0;

    protected $rules = [
        'content' => 'required|min:3',
    ];

    public function submit()
    {
        $this->validate();

        Reply::create([
            'post_id' => $this->postId,
            'user_id' => auth()->id(),
            'parent_id' => $this->parentId,
            'content' => $this->content,
        ]);

        $this->content = '';
        $this->dispatch('reply-created');

        session()->flash('success', 'Resposta enviada!');
    }
    public function render()
    {
        return view('livewire.reply-form');
    }
}
