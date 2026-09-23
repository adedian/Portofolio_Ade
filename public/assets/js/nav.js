(function () {
  var navbar = document.querySelector('.navbar');
  var toggle = document.querySelector('.navbar__toggle');
  var mobileMenu = document.querySelector('.mobile-menu');

  var progressFill = document.querySelector('.scroll-progress__fill');

  if (navbar || progressFill) {
    var onScroll = function () {
      if (navbar) navbar.classList.toggle('is-scrolled', window.scrollY > 24);
      if (progressFill) {
        var doc = document.documentElement;
        var max = doc.scrollHeight - doc.clientHeight;
        var pct = max > 0 ? (window.scrollY / max) * 100 : 0;
        progressFill.style.width = pct + '%';
      }
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
  }

  if (toggle && mobileMenu) {
    var closeMenu = function () {
      toggle.classList.remove('is-open');
      mobileMenu.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('no-scroll');
    };

    toggle.addEventListener('click', function () {
      var isOpen = mobileMenu.classList.toggle('is-open');
      toggle.classList.toggle('is-open', isOpen);
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      document.body.classList.toggle('no-scroll', isOpen);
    });

    mobileMenu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', closeMenu);
    });

    window.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeMenu();
    });
  }
})();
