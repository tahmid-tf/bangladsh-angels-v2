<footer class="ban-footer">
  <div class="ban-footer__inner">
    <div class="ban-footer__top">
      <div class="ban-footer__brand-column">
        <a href="{{ route('home') }}" class="ban-footer__brand" title="Bangladesh Angels Network — home">
          <img src="{{ asset('logo.webp') }}" width="240" height="62" alt="Bangladesh Angels Network Logo">
        </a>
        <p>Bangladesh's first and largest angel investment platform connecting early-stage startups with investors.</p>
        <div class="ban-footer__socials" aria-label="Social media">
          <a target="_blank" rel="noopener noreferrer" href="https://www.linkedin.com/company/bangladesh-angels/" aria-label="LinkedIn">
            <img src="{{ asset('linkedIn.webp') }}" width="20" height="20" alt="LinkedIn">
          </a>
          <a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/bdangels.co" aria-label="Facebook">
            <img src="{{ asset('fb_icon.webp') }}" width="20" height="20" alt="Facebook">
          </a>
          <a target="_blank" rel="noopener noreferrer" href="https://x.com/BDAngelsNetwork?t=XxABWIT-yVk-X8ujKnYorA&s=09" aria-label="Twitter">
            <img src="{{ asset('twitter.webp') }}" width="20" height="20" alt="Twitter">
          </a>
        </div>
      </div>

      <section class="ban-footer__links" aria-labelledby="ban-footer-explore-heading">
        <h2 id="ban-footer-explore-heading">Explore</h2>
        <ul>
          <li><a href="{{ route('angel-academy') }}">Angel Academy</a></li>
          <li><a href="{{ route('startups') }}">Startups</a></li>
          <li><a href="{{ route('investors') }}">Our Investors</a></li>
          <li><a href="{{ route('resources') }}">DeckVue</a></li>
          <li><a href="{{ route('team') }}">Our Team</a></li>
        </ul>
      </section>

      <section class="ban-footer__links" aria-labelledby="ban-footer-start-heading">
        <h2 id="ban-footer-start-heading">Get Started</h2>
        <ul>
          <li><a href="{{ route('investor.signup') }}">Become an Investor</a></li>
          <li><a href="{{ route('startups').'#send-pitch' }}">Pitch Your Startup</a></li>
          @guest
            <li><a href="{{ route('login') }}">Member Login</a></li>
          @endguest
          @auth
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
          @endauth
        </ul>
      </section>

      <section class="ban-footer__links ban-footer__contact" aria-labelledby="ban-footer-contact-heading">
        <div class="ban-footer__contact-heading">
          <h2 id="ban-footer-contact-heading">Bangladesh Angels</h2>
          <button type="button" class="ban-footer__to-top" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" aria-label="Back to top">
            <img src="{{ asset('up_arrow.webp') }}" alt="" width="28" height="28">
          </button>
        </div>
        <ul>
          <li>
            <a href="mailto:hello@bdangels.co" class="ban-footer__email" title="Email Bangladesh Angels Network">
              <span>Contact Us</span>
              <small>hello@bdangels.co</small>
            </a>
          </li>
          <li>
            <a href="{{ route('faq') }}" title="Frequently asked questions about BAN">FAQ</a>
          </li>
        </ul>
      </section>
    </div>

    <div class="ban-footer__bottom">
      <small>© Bangladesh Angels. All rights reserved.</small>
      <a href="{{ asset('MoU.pdf') }}">Terms &amp; Conditions</a>
    </div>
  </div>
</footer>
