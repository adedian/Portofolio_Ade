<?php
$categoryColors = [
    'Development' => 'blue',
    'UI / UX'     => 'purple',
    'Systems'     => 'cyan',
    'Tools'       => 'orange',
];

$skillAbbr = [
    'PHP' => 'PHP', 'HTML' => 'HTML', 'CSS' => 'CSS', 'JavaScript' => 'JS',
    'MySQL' => 'SQL', 'WordPress' => 'WP',
    'Figma' => 'FIG', 'Wireframing' => 'WF', 'High-Fidelity Design' => 'HD',
    'Prototyping' => 'PR', 'Responsive Design' => 'RD',
    'Database Design' => 'DB', 'CRUD' => 'CRUD', 'Role-Based Access' => 'RBA',
    'Authentication' => 'AUTH', 'Inventory Systems' => 'INV', 'Reporting Systems' => 'RPT',
    'Git' => 'GIT', 'GitHub' => 'GH', 'cPanel' => 'CP', 'hPanel' => 'HP',
    'VS Code' => 'VS', 'XAMPP' => 'XM',
];
?>
<section id="skills">
  <div class="container">
    <div class="section-head">
      <div>
        <div class="section-eyebrow section-eyebrow--orange" data-reveal>04 — Capabilities</div>
        <h2 class="section-title" data-reveal>Skills</h2>
      </div>
      <p class="section-desc" data-reveal>
        Grouped by how I actually use them. Levels are my own self-rated estimate, not a
        certification.
      </p>
    </div>

    <div class="skills__grid">
      <?php foreach ($skills as $category => $items): ?>
        <?php $color = $categoryColors[$category] ?? 'blue'; ?>
        <div data-reveal data-skill-category="<?= e($color) ?>">
          <div class="skill-category__title"><?= e($category) ?></div>
          <?php foreach ($items as $skill): ?>
            <div class="skill-row">
              <span class="skill-row__chip" data-skill-color="<?= e($color) ?>">
                <?= e($skillAbbr[$skill['name']] ?? mb_strtoupper(mb_substr($skill['name'], 0, 2))) ?>
              </span>
              <div class="skill-row__main">
                <div class="skill-row__top">
                  <span class="skill-row__name"><?= e($skill['name']) ?></span>
                  <span class="skill-row__level"><?= (int) $skill['level'] ?>%</span>
                </div>
                <div class="skill-row__track">
                  <div class="skill-row__fill" data-skill-color="<?= e($color) ?>" style="--level: <?= (int) $skill['level'] ?>%"></div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
