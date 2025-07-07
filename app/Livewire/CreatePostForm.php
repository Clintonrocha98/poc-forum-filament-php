<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePostForm extends Component
{

    public string $title = '';
    public string $content = '';
    public ?int $communityId = null;

    protected $rules = [
        'title' => 'required|min:3|max:100',
        'content' => 'required|min:5',
    ];

    public function submit()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->id(),
            'community_id' => $this->communityId, 
            'slug' => str($this->title)->slug(),
        ]);

        $this->reset(['title', 'content']);
        session()->flash('success', 'Postagem criada com sucesso!');
        $this->dispatch('post-created');
    }
    public function render()
    {
        return view('livewire.create-post-form');
    }
}
