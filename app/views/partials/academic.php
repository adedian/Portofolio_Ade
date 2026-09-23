<?php
$academicProject = null;
foreach ($projects as $p) {
    if (!empty($p['is_academic'])) {
        $academicProject = $p;
        break;
    }
}
if (!$academicProject) {
    return;
}
$academicTags = tags_to_array($academicProject['technologies']);
?>
<section id="academic-project">
  <div class="container">
    <div class="section-eyebrow section-eyebrow--green" data-reveal>06 — Academic Project</div>

    <div class="academic" data-reveal>
      <div>
        <span class="academic__badge">Thesis / Final Year Project</span>
        <h3 class="academic__title"><?= e($academicProject['title']) ?></h3>
        <p class="academic__desc"><?= e($academicProject['description']) ?></p>
        <p class="academic__note">
          Scope note: this system performs object detection only — it does not perform face
          recognition, and it does not automatically block or penalize anyone. It is built to
          assist human security monitoring, not replace it.
        </p>
        <div style="margin-top: var(--space-6);">
          <a href="<?= base_url('projects/' . $academicProject['slug']) ?>" class="btn btn-outline magnetic" data-cursor="link">
            View Case Study <span class="btn__arrow">&#8599;</span>
          </a>
        </div>
      </div>

      <div class="academic__stack">
        <?php foreach ($academicTags as $tag): ?>
          <span class="project-row__tag"><?= e($tag) ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
