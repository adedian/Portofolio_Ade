<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?></title>
<meta name="robots" content="noindex, nofollow">
<link rel="stylesheet" href="<?= asset('css/variables.css') ?>">
<link rel="stylesheet" href="<?= asset('css/base.css') ?>">
<link rel="stylesheet" href="<?= asset('css/layout.css') ?>">
<link rel="stylesheet" href="<?= asset('css/components.css') ?>">
<link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
</head>
<body class="admin">
  <div class="admin-login">
    <div class="admin-login__card">
      <div class="admin-sidebar__logo" style="margin-bottom: var(--space-6);">AD. <span class="text-muted mono" style="font-size:0.75rem;">admin</span></div>

      <?php if (!empty($error)): ?>
        <div class="admin-alert"><?= e($error) ?></div>
      <?php endif; ?>

      <form class="admin-form" action="<?= base_url('admin/login') ?>" method="POST">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <input class="form-input" type="email" id="email" name="email" required autofocus>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input class="form-input" type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; margin-top: var(--space-4);">
          Sign In
        </button>
      </form>
    </div>
  </div>
</body>
</html>
