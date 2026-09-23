<?php require __DIR__ . '/layout/header.php'; ?>

<div class="admin-header">
  <h1 class="section-title" style="font-size:1.75rem;">Dashboard</h1>
</div>

<div class="admin-stats">
  <div class="admin-card">
    <div class="admin-stat__value"><?= (int) $projectCount ?></div>
    <div class="admin-stat__label">Projects Published</div>
  </div>
  <div class="admin-card">
    <div class="admin-stat__value"><?= count($messages) ?></div>
    <div class="admin-stat__label">Recent Messages</div>
  </div>
  <div class="admin-card">
    <a href="<?= base_url('admin/projects/new') ?>" class="btn btn-primary" style="width:100%; justify-content:center;">
      + New Project
    </a>
  </div>
</div>

<div class="admin-card">
  <h2 style="font-size:1.125rem; margin-bottom: var(--space-4);">Latest Messages</h2>
  <?php if (empty($messages)): ?>
    <p class="text-muted">No messages yet.</p>
  <?php else: ?>
    <table class="admin-table">
      <thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Received</th></tr></thead>
      <tbody>
        <?php foreach ($messages as $m): ?>
          <tr>
            <td><?= e($m['name']) ?></td>
            <td><?= e($m['email']) ?></td>
            <td><?= e($m['subject'] ?: '—') ?></td>
            <td class="text-muted"><?= e($m['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>
