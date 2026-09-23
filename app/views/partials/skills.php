<section id="skills">
  <div class="container">
    <div class="section-head">
      <div>
        <div class="section-eyebrow" data-reveal>04 — Capabilities</div>
        <h2 class="section-title" data-reveal>Skills</h2>
      </div>
      <p class="section-desc" data-reveal>
        Grouped by how I actually use them — not a subjective percentage.
      </p>
    </div>

    <div class="skills__grid">
      <?php foreach ($skills as $category => $items): ?>
        <div data-reveal>
          <div class="skill-category__title"><?= e($category) ?></div>
          <?php foreach ($items as $skill): ?>
            <div class="skill-item">
              <span class="skill-item__name"><?= e($skill['name']) ?></span>
              <?php if (!empty($skill['note'])): ?>
                <div class="skill-item__note"><?= e($skill['note']) ?></div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
