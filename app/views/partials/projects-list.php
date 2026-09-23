<?php
$filterLabels = [
    'ALL'    => 'All',
    'WEB'    => 'Web',
    'SYSTEM' => 'System',
    'UIUX'   => 'UI/UX',
    'AI'     => 'AI / Computer Vision',
];
?>
<section id="work">
  <div class="container">
    <div class="section-head">
      <div>
        <div class="section-eyebrow section-eyebrow--cyan" data-reveal>03 — Selected Work</div>
        <h2 class="section-title" data-reveal>Some of My Recent Work</h2>
      </div>

      <div class="project-filters" role="group" aria-label="Filter projects by category" data-reveal>
        <?php foreach ($filterLabels as $group => $label): ?>
          <button
            type="button"
            class="project-filter <?= $group === 'ALL' ? 'is-active' : '' ?>"
            data-filter="<?= e($group) ?>"
            aria-pressed="<?= $group === 'ALL' ? 'true' : 'false' ?>"
          ><?= e($label) ?></button>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="project-cards">
      <?php foreach ($projects as $project): ?>
        <?php $tags = tags_to_array($project['technologies']); ?>
        <article class="project-card" data-group="<?= e($project['filter_group']) ?>" data-reveal>
          <a href="<?= base_url('projects/' . $project['slug']) ?>" class="project-card__thumb" data-cursor="link" data-cursor-label="View">
            <span class="project-card__number"><?= e($project['number']) ?></span>
            <?php if (!empty($project['thumbnail'])): ?>
              <img src="<?= e($project['thumbnail']) ?>" alt="<?= e($project['title']) ?>" loading="lazy">
            <?php else: ?>
              <span class="project-thumb-placeholder"><?= e($project['title']) ?></span>
            <?php endif; ?>
          </a>

          <div class="project-card__body">
            <div class="project-card__category"><?= e($project['category']) ?></div>
            <h3 class="project-card__title"><?= e($project['title']) ?></h3>
            <p class="project-card__desc"><?= e($project['description']) ?></p>

            <div class="project-row__tags">
              <?php foreach (array_slice($tags, 0, 3) as $tag): ?>
                <span class="project-row__tag"><?= e($tag) ?></span>
              <?php endforeach; ?>
            </div>

            <a href="<?= base_url('projects/' . $project['slug']) ?>" class="project-card__link" data-cursor="link" data-cursor-label="View">
              View Project <span class="project-row__cta-arrow">&#8599;</span>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <p class="project-filter-empty">No projects in this category yet — more coming soon.</p>
  </div>
</section>
