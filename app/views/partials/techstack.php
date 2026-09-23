<?php
$nodes = [
    ['label' => 'Figma',      'top' => '8%',  'left' => '50%'],
    ['label' => 'JavaScript', 'top' => '30%', 'left' => '20%'],
    ['label' => 'PHP',        'top' => '30%', 'left' => '76%'],
    ['label' => 'GitHub',     'top' => '54%', 'left' => '6%'],
    ['label' => 'MySQL',      'top' => '54%', 'left' => '92%'],
    ['label' => 'WordPress',  'top' => '76%', 'left' => '28%'],
    ['label' => 'HTML/CSS',   'top' => '88%', 'left' => '60%'],
];
?>
<section id="tech-stack" aria-labelledby="tech-stack-title">
  <div class="container">
    <div class="section-eyebrow" data-reveal>05 — Ecosystem</div>
    <h2 class="section-title" id="tech-stack-title" data-reveal>Tools I Work With</h2>

    <div class="tech-ecosystem" data-reveal="scale" role="img" aria-label="Technology ecosystem: Figma, JavaScript, PHP, GitHub, MySQL, WordPress, HTML/CSS around Ade Dian Sukmana">
      <div class="tech-node tech-node--center">AD</div>
      <?php foreach ($nodes as $i => $node): ?>
        <div
          class="tech-node"
          style="top:<?= e($node['top']) ?>; left:<?= e($node['left']) ?>; animation-delay:<?= $i * 350 ?>ms;"
        ><?= e($node['label']) ?></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
