<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="admin-header">
  <h1 class="section-title" style="font-size:1.75rem;">Messages</h1>
</div>

<div class="admin-card">
  <?php if (empty($messages)): ?>
    <p class="text-muted">No messages yet.</p>
  <?php else: ?>
    <table class="admin-table">
      <thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Received</th><th></th></tr></thead>
      <tbody>
        <?php foreach ($messages as $m): ?>
          <tr>
            <td><?= e($m['name']) ?></td>
            <td><?= e($m['email']) ?></td>
            <td><?= e($m['subject'] ?: '—') ?></td>
            <td style="max-width:320px;"><?= nl2br(e($m['message'])) ?></td>
            <td class="text-muted"><?= e($m['created_at']) ?></td>
            <td>
              <form action="<?= base_url('admin/messages/' . $m['id'] . '/delete') ?>" method="POST" onsubmit="return confirm('Delete this message?');">
                <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">
                <button type="submit" class="btn btn-outline" style="padding:0.4rem 0.8rem; font-size:0.8125rem; color:#f87171;">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
