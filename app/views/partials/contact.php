<section id="contact">
  <div class="container">
    <div class="contact__grid">
      <div data-reveal>
        <div class="section-eyebrow section-eyebrow--blue">07 — Contact</div>
        <h2 class="contact__title">Let's build<br>something useful.</h2>
        <p class="section-desc" style="margin-top: var(--space-6);">
          Have a project, idea, or opportunity? Let's talk.
        </p>

        <div class="contact__links">
          <a href="mailto:adesukmana000@gmail.com" class="contact__link" data-cursor="link" data-cursor-label="Email">
            adesukmana000@gmail.com
          </a>
          <a href="https://id.linkedin.com/in/ade-dian-sukmana" target="_blank" rel="noopener" class="contact__link" data-cursor="link" data-cursor-label="Open">
            LinkedIn — Ade Dian Sukmana
          </a>
          <a href="https://github.com/adedian" target="_blank" rel="noopener" class="contact__link" data-cursor="link" data-cursor-label="Open">
            GitHub — @adedian
          </a>
        </div>
      </div>

      <form class="contact-form" action="<?= base_url('contact') ?>" method="POST" data-reveal data-reveal-delay="120" novalidate>
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">
        <input type="hidden" name="_rendered_at" value="">
        <div class="honeypot-field" aria-hidden="true">
          <label for="website">Leave this field empty</label>
          <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
        </div>

        <div class="form-group">
          <label class="form-label" for="name">Name</label>
          <input class="form-input" type="text" id="name" name="name" required maxlength="100">
          <div class="form-error" data-for="name"></div>
        </div>

        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <input class="form-input" type="email" id="email" name="email" required maxlength="150">
          <div class="form-error" data-for="email"></div>
        </div>

        <div class="form-group">
          <label class="form-label" for="subject">Subject</label>
          <input class="form-input" type="text" id="subject" name="subject" maxlength="200">
          <div class="form-error" data-for="subject"></div>
        </div>

        <div class="form-group">
          <label class="form-label" for="message">Message</label>
          <textarea class="form-textarea" id="message" name="message" required minlength="10" maxlength="5000"></textarea>
          <div class="form-error" data-for="message"></div>
        </div>

        <button type="submit" class="btn btn-primary magnetic">
          Send Message <span class="btn__arrow">&#8599;</span>
        </button>

        <div class="form-status" role="status" aria-live="polite"></div>
      </form>
    </div>
  </div>
</section>
