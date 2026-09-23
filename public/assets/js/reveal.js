(function () {
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var revealEls = document.querySelectorAll('[data-reveal], .reveal-text, .timeline__item');

  if (reduced || !('IntersectionObserver' in window)) {
    revealEls.forEach(function (el) {
      el.classList.add('is-visible');
    });
    var fill = document.querySelector('.timeline__track-fill');
    if (fill) fill.style.width = '100%';
    return;
  }

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.2, rootMargin: '0px 0px -60px 0px' }
  );

  revealEls.forEach(function (el, i) {
    var delay = el.hasAttribute('data-reveal-delay')
      ? el.getAttribute('data-reveal-delay')
      : (i % 4) * 80;
    el.style.setProperty('--reveal-delay', delay + 'ms');
    observer.observe(el);
  });

  var track = document.querySelector('.timeline');
  var fillBar = document.querySelector('.timeline__track-fill');
  if (track && fillBar) {
    var trackObserver = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            fillBar.style.width = '100%';
            trackObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.3 }
    );
    trackObserver.observe(track);
  }
})();
