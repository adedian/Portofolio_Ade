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
        <h2 class="section-title" data-reveal>Selected Projects</h2>
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

    <div class="project-list">
      <?php foreach ($projects as $project): ?>
        <?php $tags = tags_to_array($project['technologies']); ?>
        <article
          class="project-row"
          data-group="<?= e($project['filter_group']) ?>"
          data-thumb="<?= e($project['thumbnail'] ?? '') ?>"
          data-title="<?= e($project['title']) ?>"
          data-href="<?= base_url('projects/' . $project['slug']) ?>"
          data-reveal
        >
          <div class="project-row__number"><?= e($project['number']) ?></div>

          <div class="project-row__title-group">
            <h3 class="project-row__title"><?= e($project['title']) ?></h3>
            <div class="project-row__category"><?= e($project['category']) ?></div>
          </div>

          <div class="project-row__tags">
            <?php foreach (array_slice($tags, 0, 5) as $tag): ?>
              <span class="project-row__tag"><?= e($tag) ?></span>
            <?php endforeach; ?>
          </div>

          <div class="project-row__cta" data-cursor="link" data-cursor-label="View">
            View Case Study <span class="project-row__cta-arrow">&#8599;</span>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <p class="project-filter-empty">No projects in this category yet — more coming soon.</p>
  </div>

  <div class="project-row__preview" aria-hidden="true">
    <div class="project-thumb-placeholder"></div>
  </div>
</section>
