<section id="experience">
  <div class="container">
    <div class="section-head">
      <div>
        <div class="section-eyebrow" data-reveal>02 — Journey</div>
        <h2 class="section-title" data-reveal>Experience &amp; Education</h2>
      </div>
      <p class="section-desc" data-reveal>
        From studying Informatics to building systems used inside a real organization —
        a short, honest timeline.
      </p>
    </div>

    <div class="timeline">
      <div class="timeline__track"><div class="timeline__track-fill"></div></div>

      <?php foreach ($experiences as $item): ?>
        <div class="timeline__item" data-reveal>
          <div class="timeline__year"><?= e($item['year_marker']) ?></div>
          <div class="timeline__role"><?= e($item['role']) ?></div>
          <div class="timeline__org">
            <?= e($item['organization']) ?><?= $item['location'] ? ' · ' . e($item['location']) : '' ?>
          </div>
          <div class="timeline__summary"><?= e($item['summary']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
