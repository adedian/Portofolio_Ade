(function () {
  var filters = document.querySelectorAll('.project-filter');
  var rows = document.querySelectorAll('.project-row');
  var emptyState = document.querySelector('.project-filter-empty');
  var previewEl = document.querySelector('.project-row__preview');
  var previewImg = previewEl ? previewEl.querySelector('img, .project-thumb-placeholder') : null;

  if (filters.length && rows.length) {
    filters.forEach(function (btn) {
      btn.addEventListener('click', function () {
        filters.forEach(function (b) {
          b.classList.remove('is-active');
          b.setAttribute('aria-pressed', 'false');
        });
        btn.classList.add('is-active');
        btn.setAttribute('aria-pressed', 'true');

        var group = btn.getAttribute('data-filter');
        var visibleCount = 0;

        rows.forEach(function (row) {
          var matches = group === 'ALL' || row.getAttribute('data-group') === group;
          row.classList.toggle('is-hidden', !matches);
          if (matches) visibleCount++;
        });

        if (emptyState) {
          emptyState.classList.toggle('is-visible', visibleCount === 0);
        }
      });
    });
  }

  if (previewEl && window.matchMedia('(pointer: fine)').matches) {
    rows.forEach(function (row) {
      var thumb = row.getAttribute('data-thumb');
      var title = row.getAttribute('data-title') || '';

      row.addEventListener('mousemove', function (e) {
        previewEl.style.left = e.clientX + 'px';
        previewEl.style.top = e.clientY + 'px';
      });

      row.addEventListener('mouseenter', function () {
        if (thumb && previewImg && previewImg.tagName === 'IMG') {
          previewImg.src = thumb;
        } else if (previewImg && previewImg.classList.contains('project-thumb-placeholder')) {
          previewImg.textContent = title;
        }
        previewEl.classList.add('is-active');
      });

      row.addEventListener('mouseleave', function () {
        previewEl.classList.remove('is-active');
      });

      row.addEventListener('click', function () {
        var href = row.getAttribute('data-href');
        if (href) window.location.href = href;
      });
    });
  }
})();
