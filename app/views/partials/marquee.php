<?php
$marqueeItems = [
    'WEB DEVELOPMENT', 'UI / UX DESIGN', 'PHP', 'JAVASCRIPT', 'MYSQL', 'WORDPRESS',
    'FIGMA', 'SYSTEM DEVELOPMENT', 'DATABASE DESIGN', 'RESPONSIVE DESIGN', 'GIT',
];
?>
<div class="marquee" aria-hidden="true">
  <div class="marquee__track">
    <?php for ($rep = 0; $rep < 2; $rep++): ?>
      <?php foreach ($marqueeItems as $item): ?>
        <span class="marquee__item">
          <?= e($item) ?>
          <span class="marquee__dot">&#9679;</span>
        </span>
      <?php endforeach; ?>
    <?php endfor; ?>
  </div>
</div>
