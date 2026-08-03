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
            ->assertDontSee('<a href="#join" class="ban-site-nav__link">Join</a>', false)
            ->assertSee('<a href="#ban-events" class="ban-site-nav__link">Events</a>', false)
            ->assertDontSee('<a href="'.route('investor.signup').'" class="ban-site-nav__link">Investor Signup</a>', false)
            ->assertSee('<a href="'.route('investor.signup').'">Become an Investor</a>', false)
            ->assertSee('id="join"', false)
            ->assertSee('id="featured-startups"', false)
            ->assertSee('id="portfolio"', false)
            ->assertSee('id="team"', false)
            ->assertSee('id="ban2-team-heading">Our Team</h2>', false)
            ->assertSee('id="ban-events"', false)
            ->assertSee('id="ban2-events-heading">BAN Events</h2>', false)
            ->assertSee('id="our-partners"', false)
            ->assertSee('id="ban2-partners-heading">A stronger ecosystem is built together.</h2>', false)
            ->assertSee('id="faq"', false)
            ->assertSee('What sort of returns are you seeing or expecting?')
            ->assertSee('Are startups registered in the US, and do syndicates issue K-1 tax forms for US investors?')
            ->assertSee('<a href="'.route('faq').'" class="ban-site-nav__link">FAQ</a>', false)
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
            ->assertSee('Frequently Asked Questions about BAN')
            ->assertSee('20 essential answers')
            ->assertSee('What sort of returns are you seeing or expecting?')
            ->assertSee('Will BAN manage post-investment communications?')
            ->assertSee('Can’t find what you’re looking for?')
            ->assertSee('mailto:hello@bdangels.co', false);
    }
}
