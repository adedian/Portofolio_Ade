<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="admin-header">
  <h1 class="section-title" style="font-size:1.75rem;">Projects</h1>
  <a href="<?= base_url('admin/projects/new') ?>" class="btn btn-primary">+ New Project</a>
</div>

<div class="admin-card">
  <table class="admin-table">
    <thead><tr><th>#</th><th>Title</th><th>Group</th><th>Featured</th><th></th></tr></thead>
    <tbody>
      <?php foreach ($projects as $p): ?>
        <tr>
          <td class="mono text-muted"><?= e($p['number']) ?></td>
          <td><?= e($p['title']) ?></td>
          <td><span class="badge"><?= e($p['filter_group']) ?></span></td>
          <td><?= $p['featured'] ? 'Yes' : 'No' ?></td>
          <td style="display:flex; gap: var(--space-2);">
            <a href="<?= base_url('admin/projects/' . $p['id'] . '/edit') ?>" class="btn btn-outline" style="padding:0.4rem 0.8rem; font-size:0.8125rem;">Edit</a>
            <form action="<?= base_url('admin/projects/' . $p['id'] . '/delete') ?>" method="POST" onsubmit="return confirm('Delete this project?');">
              <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">
              <button type="submit" class="btn btn-outline" style="padding:0.4rem 0.8rem; font-size:0.8125rem; color:#f87171;">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
