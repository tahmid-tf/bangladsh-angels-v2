<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class FeaturedTestimonialEditor extends Component
{
    public int $userId;

    public string $body = '';

    public bool $showPublic = false;

    public string $feedback = '';

    public bool $feedbackIsError = false;

    public function mount(int $userId): void
    {
        $this->userId = $userId;
        $user = User::query()->where('id', $userId)->where('featured', true)->firstOrFail();
        $this->body = $user->featured_testimonial ?? '';
        $this->showPublic = (bool) $user->featured_testimonial_public;
    }

    public function save(): void
    {
        if (! auth()->user()?->isAdmin()) {
            return;
        }

        $user = User::query()->where('id', $this->userId)->where('featured', true)->first();
        if (! $user) {
            return;
        }

        $text = trim($this->body);
        $this->feedback = '';
        $this->feedbackIsError = false;

        if ($this->showPublic && $text === '') {
            $this->feedback = 'Add testimonial text before enabling public display.';
            $this->feedbackIsError = true;

            return;
        }

        $this->validate([
            'body' => 'nullable|string|max:1200',
        ], [
            'body.max' => 'Testimonial may not exceed 1,200 characters.',
        ]);

        $user->update([
            'featured_testimonial' => $text === '' ? null : $text,
            'featured_testimonial_public' => $this->showPublic && $text !== '',
        ]);

        $user->refresh();
        $this->body = $user->featured_testimonial ?? '';
        $this->showPublic = (bool) $user->featured_testimonial_public;

        $this->feedback = 'Saved.';
        $this->feedbackIsError = false;
        session()->flash('success', "Testimonial saved for {$user->name}.");
    }

    public function render()
    {
        return view('livewire.featured-testimonial-editor');
    }
}
