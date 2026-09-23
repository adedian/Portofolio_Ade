<section class="hero" id="hero">
  <div class="hero__bg" aria-hidden="true">
    <div class="hero__bg-grid"></div>
    <div class="hero__bg-glow"></div>
  </div>

  <div class="container hero__inner">
    <div class="hero__content">
      <div class="hero__available" data-reveal>
        <span class="hero__available-dot"></span>
        Available for Web Development &amp; Digital Projects
      </div>

      <h1 class="hero__name">
        <span class="reveal-text" data-reveal><span class="reveal-text__line">Ade Dian</span></span><br>
        <span class="reveal-text" data-reveal data-reveal-delay="80"><span class="reveal-text__line text-gradient">Sukmana.</span></span>
      </h1>

      <p class="hero__role" data-reveal data-reveal-delay="160">Web Developer &amp; UI Designer — Surabaya, Indonesia</p>

      <p class="hero__desc" data-reveal data-reveal-delay="220">
        I build digital experiences, websites and systems that solve real-world problems —
        from interface to database.
      </p>

      <div class="hero__actions" data-reveal data-reveal-delay="280">
        <a href="<?= base_url('/#work') ?>" class="btn btn-gradient magnetic">
          View My Work <span class="btn__arrow">&#8599;</span>
        </a>
        <a href="<?= base_url('/#contact') ?>" class="btn btn-outline magnetic">
          Let's Talk
        </a>
      </div>

      <div class="hero__tech" data-reveal data-reveal-delay="340">
        <span class="hero__tech-label">Technologies I Work With</span>
        <div class="hero__tech-row">
          <?php foreach ([
              ['abbr' => 'HTML', 'tech' => 'html'],
              ['abbr' => 'CSS',  'tech' => 'css'],
              ['abbr' => 'JS',   'tech' => 'javascript'],
              ['abbr' => 'PHP',  'tech' => 'php'],
              ['abbr' => 'SQL',  'tech' => 'mysql'],
              ['abbr' => 'WP',   'tech' => 'wordpress'],
              ['abbr' => 'FIG',  'tech' => 'figma'],
              ['abbr' => 'GIT',  'tech' => 'git'],
          ] as $chip): ?>
            <span class="tech-chip" data-tech="<?= e($chip['tech']) ?>"><?= e($chip['abbr']) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="hero__visual" data-reveal="scale" data-reveal-delay="200">
      <div class="hero__dot-grid" aria-hidden="true"></div>

      <div class="hero__avatar-blob">
        <div class="hero__avatar-monogram">AD</div>
      </div>

      <div class="hero__floating-code">
        <div class="code-window">
          <div class="code-window__bar">
            <span class="code-window__dot"></span>
            <span class="code-window__dot"></span>
            <span class="code-window__dot"></span>
            <span class="code-window__title">developer.php</span>
          </div>
          <pre class="code-window__body"><span class="tok-kw">&lt;?php</span>

<span class="tok-kw">class</span> <span class="tok-type">Developer</span>
<span class="tok-kw">{</span>
    <span class="tok-kw">public</span> <span class="tok-type">string</span> <span class="tok-var">$name</span> = <span class="tok-str">"Ade Dian Sukmana"</span>;
    <span class="tok-kw">public</span> <span class="tok-type">string</span> <span class="tok-var">$location</span> = <span class="tok-str">"Surabaya, ID"</span>;

    <span class="tok-com">// what I actually do</span>
    <span class="tok-kw">public function</span> <span class="tok-fn">build</span>(): <span class="tok-type">string</span>
    <span class="tok-kw">{</span>
        <span class="tok-kw">return</span> <span class="tok-str">"Useful digital experiences."</span>;
    <span class="tok-kw">}</span>
<span class="tok-kw">}</span></pre>
        </div>
      </div>
    </div>
  </div>

  <a href="<?= base_url('/#about') ?>" class="hero__scroll">
    <span class="hero__scroll-line"></span>
    Scroll
  </a>
</section>
