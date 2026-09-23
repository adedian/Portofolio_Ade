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

        <div class="about__facts" data-reveal data-reveal-delay="180">
          <div>
            <div class="about__fact-label">Education</div>
            <div class="about__fact-value">S1 Informatika, Telkom University Surabaya</div>
          </div>
          <div>
            <div class="about__fact-label">Location</div>
            <div class="about__fact-value">Surabaya, Indonesia</div>
          </div>
          <div>
            <div class="about__fact-label">Period</div>
            <div class="about__fact-value">2021 — 2025</div>
          </div>
          <div>
            <div class="about__fact-label">Focus</div>
            <div class="about__fact-value">Web Development, UI/UX, IT Systems</div>
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
