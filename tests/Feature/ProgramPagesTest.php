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

    public function test_angel_academy_has_booking_and_clickable_glossary_links(): void
    {
        $this->get(route('angel-academy'))
            ->assertOk()
            ->assertSee('Book a Meeting')
            ->assertSee('id="academy-glossary"', false)
            ->assertSee('href="#glossary-cap-table"', false)
            ->assertSee('id="glossary-term-sheet"', false);
    }

    public function test_faq_includes_the_contact_prompt(): void
    {
        $this->get(route('faq'))
            ->assertOk()
            ->assertSee('Can’t find what you’re looking for?')
            ->assertSee('mailto:hello@bdangels.co', false);
    }
}
