<?php $pageTitle = $pageTitle ?? 'Admin'; ?>
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
<div class="admin-shell">
  <aside class="admin-sidebar">
    <div class="admin-sidebar__logo">AD. <span class="text-muted mono" style="font-size:0.75rem;">admin</span></div>
    <nav class="admin-nav">
      <a href="<?= base_url('admin') ?>">Dashboard</a>
      <a href="<?= base_url('admin/projects') ?>">Projects</a>
      <a href="<?= base_url('admin/messages') ?>">Messages</a>
      <a href="<?= base_url('/') ?>" target="_blank" rel="noopener">View Site &#8599;</a>
    </nav>
    <div class="admin-sidebar__footer">
      <form action="<?= base_url('admin/logout') ?>" method="POST">
        <button type="submit" class="btn btn-outline" style="width:100%; justify-content:center;">Log out</button>
      </form>
    </div>
  </aside>
  <main class="admin-main">
