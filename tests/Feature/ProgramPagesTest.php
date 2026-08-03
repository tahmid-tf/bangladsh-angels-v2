<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProgramPagesTest extends TestCase
{
    public function test_homepage_exposes_the_requested_sections_and_program_routes(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('<h1 id="ban2-hero-heading">Join BAN</h1>', false)
            ->assertSee('<a href="'.route('investor.signup').'" class="ban-site-nav__link">Investor Signup</a>', false)
            ->assertSee('<a href="'.route('investor.signup').'">Investor Signup</a>', false)
            ->assertSee('id="join"', false)
            ->assertSee('id="featured-startups"', false)
            ->assertSee('id="portfolio"', false)
            ->assertSee('id="team"', false)
            ->assertSee('id="faq"', false)
            ->assertSee(route('bwin'), false)
            ->assertSee(route('angel-academy'), false)
            ->assertSee(route('resources'), false);
    }

    public function test_bwin_has_a_dedicated_public_page(): void
    {
        $this->get(route('bwin'))
            ->assertOk()
            ->assertSee('Bangladesh Women Investors Network')
            ->assertSee('Join the BWIN community');
    }

    public function test_angel_academy_uses_the_original_program_page(): void
    {
        $this->get(route('angel-academy'))
            ->assertOk()
            ->assertSee('Book a Meet')
            ->assertSee('CURRICULUM (15 SESSIONS)');
    }

    public function test_investor_signup_uses_the_original_application_page(): void
    {
        $this->get(route('investor.signup'))
            ->assertOk()
            ->assertSee('Become an Angel investor')
            ->assertSee('Investor Application')
            ->assertSee('Choose your tier')
            ->assertSee('action="'.route('member.apply').'"', false);
    }

    public function test_faq_includes_the_contact_prompt(): void
    {
        $this->get(route('faq'))
            ->assertOk()
            ->assertSee('Can’t find what you’re looking for?')
            ->assertSee('mailto:hello@bdangels.co', false);
    }
}
