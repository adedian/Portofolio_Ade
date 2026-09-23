<?php $pageTitle = 'Page not found — Ade Dian Sukmana'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= e($pageTitle) ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?= asset('css/variables.css') ?>">
<link rel="stylesheet" href="<?= asset('css/base.css') ?>">
<style>
  .error-screen{min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;gap:1.5rem;padding:2rem;}
  .error-screen .code{font-family:var(--font-display);font-size:clamp(4rem,15vw,8rem);font-weight:600;letter-spacing:-0.03em;color:var(--color-text-primary);line-height:1;}
  .error-screen p{color:var(--color-text-secondary);max-width:32ch;}
  .error-screen a{color:var(--color-accent);text-decoration:none;border-bottom:1px solid currentColor;}
</style>
</head>
<body>
  <main class="error-screen">
    <div class="code">404</div>
    <p>This page doesn't exist — but the rest of the site does.</p>
    <a href="<?= base_url('/') ?>">Back to home</a>
  </main>
</body>
</html>
