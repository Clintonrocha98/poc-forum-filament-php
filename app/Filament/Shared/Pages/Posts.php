<?php

namespace App\Filament\Shared\Pages;

use App\Models\Community;
use Exception;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Posts extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.pages.posts';

    protected static ?string $slug = 'communities/{community}/posts';

    protected ?string $subheading = 'Veja os últimos posts da comunidade';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $formData = [];

    public $posts;

    public $community;

    public function createPost(): void
    {
        try {
            $this->validate();

            $this->posts->create([
                'title' => $this->formData['title'],
                'content' => $this->formData['content'],
                'slug' => str($this->formData['title'])->slug(),
                'user_id' => auth()->id(),
            ]);

            $this->dispatch('post-created');

            Notification::make()
                ->title('Post criado com sucesso!')
                ->body('Post criado com sucesso!')
                ->success()
                ->send();

        } catch (Exception $e) {

            Notification::make()
                ->title('Erro ao criar post!')
                ->body('Erro ao criar post!')
                ->danger()
                ->send();
        }
        $this->form->fill();

    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->label('Título'),

                Textarea::make('content')
                    ->rows(4)
                    ->required()
                    ->label('Conteúdo'),
            ])
            ->columns(1)
            ->statePath('formData');
    }

    public function mount(string $community): void
    {
        $this->community = Community::whereSlug($community)
            ->firstOrFail();

        $this->posts = $this->community->posts()->get();
    }

    public function getTitle(): string|Htmlable
    {
        return 'r/'.$this->community->name;
    }
}
