<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePitchFormTest extends TestCase
{
    public function test_homepage_shows_the_pitch_form_and_anchor_navigation(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('id="pitch-form"', false)
            ->assertSee('href="#pitch-form"', false)
            ->assertSee('One-line description of your startup');
    }

    public function test_invalid_homepage_pitch_returns_to_the_form_anchor(): void
    {
        $response = $this->post(route('home.pitch'));

        $response
            ->assertRedirect(route('home').'#pitch-form')
            ->assertSessionHasErrors([
                'contact_email',
                'one_line',
                'pitch_deck',
            ]);
    }
}
