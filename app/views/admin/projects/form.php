<?php require __DIR__ . '/../layout/header.php'; ?>
<?php $p = $project ?? []; ?>

<div class="admin-header">
  <h1 class="section-title" style="font-size:1.75rem;"><?= $project ? 'Edit Project' : 'New Project' ?></h1>
</div>

<form class="admin-form admin-card" action="<?= base_url('admin/projects/save') ?>" method="POST">
  <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">
  <input type="hidden" name="id" value="<?= e((string) ($p['id'] ?? '')) ?>">

  <div class="grid grid-2" style="gap: var(--space-4);">
    <div class="form-group">
      <label class="form-label" for="number">Number</label>
      <input class="form-input" type="text" id="number" name="number" value="<?= e($p['number'] ?? '') ?>" placeholder="01">
    </div>
    <div class="form-group">
      <label class="form-label" for="slug">Slug (URL)</label>
      <input class="form-input" type="text" id="slug" name="slug" value="<?= e($p['slug'] ?? '') ?>" placeholder="my-project" required>
    </div>
  </div>

  <div class="form-group">
    <label class="form-label" for="title">Title</label>
    <input class="form-input" type="text" id="title" name="title" value="<?= e($p['title'] ?? '') ?>" required>
  </div>

  <div class="grid grid-2" style="gap: var(--space-4);">
    <div class="form-group">
      <label class="form-label" for="category">Category</label>
      <input class="form-input" type="text" id="category" name="category" value="<?= e($p['category'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label class="form-label" for="filter_group">Filter Group</label>
      <select class="form-input" id="filter_group" name="filter_group">
        <?php foreach (['WEB', 'SYSTEM', 'UIUX', 'AI'] as $g): ?>
          <option value="<?= $g ?>" <?= ($p['filter_group'] ?? '') === $g ? 'selected' : '' ?>><?= $g ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="grid grid-2" style="gap: var(--space-4);">
    <div class="form-group">
      <label class="form-label" for="year">Year</label>
      <input class="form-input" type="text" id="year" name="year" value="<?= e($p['year'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label class="form-label" for="role">Role</label>
      <input class="form-input" type="text" id="role" name="role" value="<?= e($p['role'] ?? '') ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="form-label" for="description">Short Description</label>
    <textarea class="form-textarea" id="description" name="description"><?= e($p['description'] ?? '') ?></textarea>
  </div>

  <div class="form-group">
    <label class="form-label" for="overview">Overview</label>
    <textarea class="form-textarea" id="overview" name="overview"><?= e($p['overview'] ?? '') ?></textarea>
  </div>

  <div class="grid grid-3" style="gap: var(--space-4);">
    <div class="form-group">
      <label class="form-label" for="problem">Challenge</label>
      <textarea class="form-textarea" id="problem" name="problem"><?= e($p['problem'] ?? '') ?></textarea>
    </div>
    <div class="form-group">
      <label class="form-label" for="approach">Approach</label>
      <textarea class="form-textarea" id="approach" name="approach"><?= e($p['approach'] ?? '') ?></textarea>
    </div>
    <div class="form-group">
      <label class="form-label" for="solution">Solution</label>
      <textarea class="form-textarea" id="solution" name="solution"><?= e($p['solution'] ?? '') ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="form-label" for="result">Result</label>
    <textarea class="form-textarea" id="result" name="result"><?= e($p['result'] ?? '') ?></textarea>
  </div>

  <div class="form-group">
    <label class="form-label" for="technologies">Technologies (comma separated)</label>
    <input class="form-input" type="text" id="technologies" name="technologies" value="<?= e($p['technologies'] ?? '') ?>">
  </div>

  <div class="form-group">
    <label class="form-label" for="features">Key Features (one per line)</label>
    <textarea class="form-textarea" id="features" name="features"><?= e($p['features'] ?? '') ?></textarea>
  </div>

  <div class="form-group">
    <label class="form-label" for="thumbnail">Thumbnail path (e.g. /assets/images/projects/foo.jpg)</label>
    <input class="form-input" type="text" id="thumbnail" name="thumbnail" value="<?= e($p['thumbnail'] ?? '') ?>">
  </div>

  <div class="grid grid-2" style="gap: var(--space-4); align-items:center;">
    <label class="admin-checkbox"><input type="checkbox" name="is_academic" <?= !empty($p['is_academic']) ? 'checked' : '' ?>> Academic Project</label>
    <label class="admin-checkbox"><input type="checkbox" name="featured" <?= !empty($p['featured']) ? 'checked' : '' ?>> Featured</label>
  </div>

  <div class="form-group">
    <label class="form-label" for="sort_order">Sort Order</label>
    <input class="form-input" type="number" id="sort_order" name="sort_order" value="<?= e((string) ($p['sort_order'] ?? 0)) ?>">
  </div>

  <button type="submit" class="btn btn-primary">Save Project</button>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>
