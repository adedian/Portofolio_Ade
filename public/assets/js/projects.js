(function () {
  var filters = document.querySelectorAll('.project-filter');
  var cards = document.querySelectorAll('.project-card');
  var emptyState = document.querySelector('.project-filter-empty');

  if (!filters.length || !cards.length) return;

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

      cards.forEach(function (card) {
        var matches = group === 'ALL' || card.getAttribute('data-group') === group;
        card.classList.toggle('is-hidden', !matches);
        if (matches) visibleCount++;
      });

      if (emptyState) {
        emptyState.classList.toggle('is-visible', visibleCount === 0);
      }
    });
  });
})();
