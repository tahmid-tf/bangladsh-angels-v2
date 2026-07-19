<footer class="ban-footer">
  <div class="ban-footer__inner">
    <div class="ban-footer__top">
      <a href="{{ route('home') }}" class="ban-footer__brand" title="Bangladesh Angels Network — home">
        <img src="{{ asset('logo.webp') }}" width="240" height="62" alt="Bangladesh Angels Network Logo">
      </a>

      <section class="ban-footer__links" aria-labelledby="ban-footer-links-heading">
        <h2 id="ban-footer-links-heading">Bangladesh Angels</h2>
        <ul>
          <li>
            <a href="mailto:hello@bdangels.co" title="Email Bangladesh Angels Network">Contact Us</a>
          </li>
          <li>
            <a href="{{ route('faq') }}" title="Frequently asked questions about BAN">FAQ</a>
          </li>
        </ul>
      </section>

      <div class="ban-footer__social-area">
        <button type="button" class="ban-footer__to-top" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" aria-label="Back to top">
          <img src="{{ asset('up_arrow.webp') }}" alt="" width="28" height="28">
        </button>

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
    </div>

    <div class="ban-footer__bottom">
      <small>© Bangladesh Angels. All rights reserved.</small>
      <a href="{{ asset('MoU.pdf') }}">Terms &amp; Conditions</a>
    </div>
  </div>
</footer>
