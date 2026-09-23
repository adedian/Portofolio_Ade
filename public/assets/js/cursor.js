(function () {
  var isCoarse = window.matchMedia('(pointer: coarse)').matches;
  if (isCoarse) return;

  var dot = document.querySelector('.cursor');
  var ring = document.querySelector('.cursor-ring');
  var label = ring ? ring.querySelector('.cursor-ring__label') : null;
  if (!dot || !ring) return;

  var mouse = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
  var ringPos = { x: mouse.x, y: mouse.y };

  window.addEventListener('mousemove', function (e) {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
    dot.style.transform = 'translate(' + mouse.x + 'px,' + mouse.y + 'px) translate(-50%,-50%)';
  });

  function render() {
    ringPos.x += (mouse.x - ringPos.x) * 0.18;
    ringPos.y += (mouse.y - ringPos.y) * 0.18;
    ring.style.transform = 'translate(' + ringPos.x + 'px,' + ringPos.y + 'px) translate(-50%,-50%)';
    requestAnimationFrame(render);
  }
  requestAnimationFrame(render);

  document.addEventListener('mouseover', function (e) {
    var target = e.target.closest('[data-cursor]');
    if (target) {
      var type = target.getAttribute('data-cursor');
      ring.classList.add(type === 'link' ? 'is-link' : 'is-active');
      if (label) label.textContent = target.getAttribute('data-cursor-label') || (type === 'link' ? 'Open' : 'View');
    }
  });

  document.addEventListener('mouseout', function (e) {
    var target = e.target.closest('[data-cursor]');
    if (target) {
      ring.classList.remove('is-active', 'is-link');
    }
  });

  document.addEventListener('mouseleave', function () {
    dot.style.opacity = '0';
    ring.style.opacity = '0';
  });
  document.addEventListener('mouseenter', function () {
    dot.style.opacity = '1';
    ring.style.opacity = '1';
  });
})();
