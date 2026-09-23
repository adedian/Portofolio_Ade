<?php require __DIR__ . '/../layouts/header.php'; ?>

<?php
$techs = tags_to_array($project['technologies']);
$features = lines_to_array($project['features']);
?>

<section class="project-hero" style="padding-top: var(--space-32); padding-bottom: var(--space-16);">
  <div class="container">
    <a href="<?= base_url('/#work') ?>" class="text-secondary mono" style="font-size:0.8125rem;" data-cursor="link">&larr; Back to work</a>

    <div style="margin-top: var(--space-8); display:flex; gap: var(--space-16); flex-wrap:wrap; justify-content:space-between; align-items:flex-end;">
      <h1 class="section-title" style="max-width: 26ch; font-size: clamp(2.25rem, 6vw, 4rem);" data-reveal><?= e($project['title']) ?></h1>

      <div style="display:flex; gap: var(--space-8); flex-wrap:wrap;">
        <div>
          <div class="about__fact-label">Year</div>
          <div class="about__fact-value"><?= e($project['year'] ?? '—') ?></div>
        </div>
        <div>
          <div class="about__fact-label">Role</div>
          <div class="about__fact-value"><?= e($project['role'] ?? '—') ?></div>
        </div>
        <div>
          <div class="about__fact-label">Category</div>
          <div class="about__fact-value"><?= e($project['category']) ?></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section style="padding-block: var(--space-16);">
  <div class="container">
    <div class="grid grid-2" style="gap: var(--space-16);">
      <div data-reveal>
        <div class="section-eyebrow section-eyebrow--blue">Overview</div>
        <p class="section-desc" style="font-size: 1.0625rem; max-width: 60ch;"><?= e($project['overview']) ?></p>
      </div>
      <div data-reveal data-reveal-delay="80">
        <div class="section-eyebrow section-eyebrow--cyan">Technology</div>
        <div class="project-row__tags">
          <?php foreach ($techs as $tag): ?>
            <span class="project-row__tag"><?= e($tag) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="hairline" style="padding-block: var(--space-16);">
  <div class="container grid grid-3" style="gap: var(--space-12);">
    <div data-reveal>
      <div class="section-eyebrow section-eyebrow--orange">Challenge</div>
      <p class="text-secondary"><?= e($project['problem']) ?></p>
    </div>
    <div data-reveal data-reveal-delay="80">
      <div class="section-eyebrow section-eyebrow--purple">Approach</div>
      <p class="text-secondary"><?= e($project['approach']) ?></p>
    </div>
    <div data-reveal data-reveal-delay="160">
      <div class="section-eyebrow section-eyebrow--cyan">Solution</div>
      <p class="text-secondary"><?= e($project['solution']) ?></p>
    </div>
  </div>
</section>

<?php if (!empty($features)): ?>
<section class="hairline">
  <div class="container">
    <div class="section-eyebrow section-eyebrow--yellow" data-reveal>Key Features</div>
    <div class="grid grid-3" style="margin-top: var(--space-8);">
      <?php
      $featureColors = ['var(--vs-blue)', 'var(--vs-cyan)', 'var(--vs-purple)', 'var(--vs-orange)'];
      foreach ($features as $i => $feature):
          $color = $featureColors[$i % count($featureColors)];
      ?>
        <div data-reveal data-reveal-delay="<?= ($i % 3) * 80 ?>" style="border-top:2px solid <?= $color ?>; padding-top: var(--space-4);">
          <span class="mono" style="font-size:0.8125rem; color:<?= $color ?>;"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
          <p style="margin-top: var(--space-2);"><?= e($feature) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="hairline">
  <div class="container">
    <div class="section-eyebrow section-eyebrow--green" data-reveal>Result</div>
    <p class="section-desc" style="font-size: 1.0625rem; max-width: 64ch;" data-reveal><?= e($project['result']) ?></p>
  </div>
</section>

<section class="hairline">
  <div class="container">
    <div class="section-eyebrow section-eyebrow--blue" data-reveal>Gallery</div>

    <?php if (!empty($images)): ?>
      <div class="gallery-grid" data-reveal>
        <?php foreach ($images as $img): ?>
          <div class="gallery-item" data-full="<?= e($img['image_path']) ?>" data-alt="<?= e($img['alt_text'] ?? $project['title']) ?>">
            <img src="<?= e($img['image_path']) ?>" alt="<?= e($img['alt_text'] ?? $project['title']) ?>" loading="lazy">
          </div>
        <?php endforeach; ?>
      </div>
      <div class="lightbox" aria-hidden="true">
        <figure class="lightbox__figure"><img src="" alt=""></figure>
        <button class="lightbox__close" aria-label="Close gallery">&times;</button>
        <button class="lightbox__prev" aria-label="Previous image">&larr;</button>
        <button class="lightbox__next" aria-label="Next image">&rarr;</button>
      </div>
    <?php else: ?>
      <div class="gallery-grid" data-reveal>
        <?php for ($i = 0; $i < 3; $i++): ?>
          <div class="gallery-item" style="cursor:default;">
            <div class="project-thumb-placeholder">Screenshot coming soon<br>— add to<br>/assets/images/projects/</div>
          </div>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php if ($next): ?>
<section class="hairline">
  <div class="container">
    <a href="<?= base_url('projects/' . $next['slug']) ?>" class="project-row" style="grid-template-columns: 80px 1fr auto; border:none;" data-cursor="link" data-cursor-label="Next">
      <div class="project-row__number">Next</div>
      <div class="project-row__title-group">
        <h3 class="project-row__title"><?= e($next['title']) ?></h3>
        <div class="project-row__category"><?= e($next['category']) ?></div>
      </div>
      <div class="project-row__cta">View <span class="project-row__cta-arrow">&#8599;</span></div>
    </a>
  </div>
</section>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
