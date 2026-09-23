(function () {
  var galleryItems = Array.prototype.slice.call(document.querySelectorAll('.gallery-item[data-full]'));
  var lightbox = document.querySelector('.lightbox');
  if (!galleryItems.length || !lightbox) return;

  var imgEl = lightbox.querySelector('img');
  var closeBtn = lightbox.querySelector('.lightbox__close');
  var prevBtn = lightbox.querySelector('.lightbox__prev');
  var nextBtn = lightbox.querySelector('.lightbox__next');
  var currentIndex = 0;

  function open(index) {
    currentIndex = index;
    imgEl.src = galleryItems[index].getAttribute('data-full');
    imgEl.alt = galleryItems[index].getAttribute('data-alt') || '';
    lightbox.classList.add('is-open');
    document.body.classList.add('no-scroll');
    closeBtn.focus();
  }

  function close() {
    lightbox.classList.remove('is-open');
    document.body.classList.remove('no-scroll');
  }

  function show(delta) {
    currentIndex = (currentIndex + delta + galleryItems.length) % galleryItems.length;
    imgEl.src = galleryItems[currentIndex].getAttribute('data-full');
    imgEl.alt = galleryItems[currentIndex].getAttribute('data-alt') || '';
  }

  galleryItems.forEach(function (item, index) {
    item.addEventListener('click', function () {
      open(index);
    });
  });

  closeBtn.addEventListener('click', close);
  prevBtn.addEventListener('click', function () { show(-1); });
  nextBtn.addEventListener('click', function () { show(1); });

  lightbox.addEventListener('click', function (e) {
    if (e.target === lightbox) close();
  });

  window.addEventListener('keydown', function (e) {
    if (!lightbox.classList.contains('is-open')) return;
    if (e.key === 'Escape') close();
    if (e.key === 'ArrowRight') show(1);
    if (e.key === 'ArrowLeft') show(-1);
  });
})();
