<?php
$terminalLines = [
    '$ whoami',
    'ade-dian-sukmana',
    '',
    '$ role',
    'web-developer & ui-designer',
    '',
    '$ location',
    'surabaya.id',
    '',
    '$ stack',
    'php · javascript · mysql · figma · wordpress',
];
?>
<section id="about">
  <div class="container">
    <div class="section-eyebrow section-eyebrow--blue" data-reveal>01 — About</div>

    <div class="about__grid">
      <div>
        <p class="about__lead" data-reveal>
          I'm Ade — an Informatics graduate and Web Developer based in Surabaya.
        </p>

        <p class="about__body" data-reveal data-reveal-delay="100">
          I enjoy turning ideas, business requirements and messy workflows into clean digital
          systems — websites, internal tools and interfaces that are straightforward to use and
          built on a structure that holds up over time. My background sits between development,
          UI/UX and systems thinking, which is how I like working: not just writing code, but
          understanding how a product is meant to function end to end.
        </p>

        <div class="stat-cards" data-reveal data-reveal-delay="180">
          <div class="stat-card stat-card--blue">
            <div class="stat-card__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            </div>
            <div class="stat-card__value">2025</div>
            <div class="stat-card__label">Telkom University Graduate</div>
          </div>
          <div class="stat-card stat-card--cyan">
            <div class="stat-card__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 9l-4 4 4 4M16 9l4 4-4 4M14 6l-4 14"/></svg>
            </div>
            <div class="stat-card__value">3+</div>
            <div class="stat-card__label">Projects Delivered</div>
          </div>
          <div class="stat-card stat-card--purple">
            <div class="stat-card__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2 2 7l10 5 10-5-10-5Z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <div class="stat-card__value">5+</div>
            <div class="stat-card__label">Core Technologies</div>
          </div>
          <div class="stat-card stat-card--orange">
            <div class="stat-card__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
            </div>
            <div class="stat-card__value">2026</div>
            <div class="stat-card__label">IT Staff &amp; Web Developer</div>
          </div>
        </div>
      </div>

      <div class="terminal" data-reveal="scale" data-reveal-delay="120" data-terminal='<?= json_encode($terminalLines) ?>'>
        <div class="terminal__bar">
          <span class="code-window__dot"></span>
          <span class="code-window__dot"></span>
          <span class="code-window__dot"></span>
          <span class="code-window__title">zsh</span>
        </div>
        <div class="terminal__body">
          <?php foreach ($terminalLines as $i => $line): ?>
            <?php $isPrompt = str_starts_with($line, '$'); ?>
            <div class="terminal__line <?= $isPrompt ? 'terminal__prompt' : 'terminal__output' ?>"></div>
          <?php endforeach; ?>
          <span class="terminal__cursor"></span>
        </div>
      </div>
    </div>
  </div>
</section>
