(function () {
  var preloader = document.querySelector('.preloader');
  if (!preloader) return;

  var fill = preloader.querySelector('.preloader__bar-fill');
  var count = preloader.querySelector('.preloader__count');
  var progress = 0;
  var target = 0;
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function setTarget(value) {
    target = Math.min(100, value);
  }

  function tick() {
    progress += (target - progress) * 0.18 + 0.4;
    if (progress > 100) progress = 100;

    if (fill) fill.style.width = progress + '%';
    if (count) count.textContent = Math.floor(progress).toString().padStart(3, '0');

    if (progress < 99.5) {
      requestAnimationFrame(tick);
    } else {
      finish();
    }
  }

  function finish() {
    document.body.classList.remove('is-loading');
    preloader.classList.add('is-hidden');
    document.dispatchEvent(new CustomEvent('portfolio:loaded'));
    setTimeout(function () {
      preloader.remove();
    }, 900);
  }

  document.body.classList.add('is-loading');
  setTarget(35);

  window.addEventListener('load', function () {
    setTarget(100);
  });

  if (reduced) {
    finish();
    return;
  }

  requestAnimationFrame(tick);

  // Safety net: never block the user for more than ~2.5s.
  setTimeout(function () {
    setTarget(100);
  }, 1800);
})();
