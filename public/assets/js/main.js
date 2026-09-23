(function () {
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------------- Magnetic buttons ---------------- */
  if (!reduced && window.matchMedia('(pointer: fine)').matches) {
    document.querySelectorAll('.magnetic').forEach(function (el) {
      var strength = 18;

      el.addEventListener('mousemove', function (e) {
        var rect = el.getBoundingClientRect();
        var x = e.clientX - rect.left - rect.width / 2;
        var y = e.clientY - rect.top - rect.height / 2;
        el.style.transform = 'translate(' + (x / rect.width) * strength + 'px,' + (y / rect.height) * strength + 'px)';
      });

      el.addEventListener('mouseleave', function () {
        el.style.transform = 'translate(0,0)';
      });
    });
  }

  /* ---------------- Terminal typing effect (About) ---------------- */
  var terminalBody = document.querySelector('[data-terminal]');
  if (terminalBody) {
    var lines = JSON.parse(terminalBody.getAttribute('data-terminal'));
    var lineEls = terminalBody.querySelectorAll('.terminal__line');
    var played = false;

    function typeLine(el, text, done) {
      if (reduced) {
        el.textContent = text;
        done();
        return;
      }
      var i = 0;
      var speed = 18;
      (function step() {
        el.textContent = text.slice(0, i);
        i++;
        if (i <= text.length) {
          setTimeout(step, speed);
        } else {
          done();
        }
      })();
    }

    function playSequence() {
      if (played) return;
      played = true;
      var index = 0;
      function next() {
        if (index >= lineEls.length) return;
        var el = lineEls[index];
        var text = lines[index] || '';
        typeLine(el, text, function () {
          index++;
          next();
        });
      }
      next();
    }

    if ('IntersectionObserver' in window) {
      var obs = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            playSequence();
            obs.disconnect();
          }
        });
      }, { threshold: 0.4 });
      obs.observe(terminalBody);
    } else {
      playSequence();
    }
  }

  /* ---------------- System log reveal timing ---------------- */
  document.querySelectorAll('.system-log__line').forEach(function (el, i) {
    el.style.animationDelay = (i * 140) + 'ms';
  });

  /* ---------------- Stat card number count-up ---------------- */
  document.querySelectorAll('.stat-card__value').forEach(function (el) {
    var match = el.textContent.trim().match(/^(\d+)(.*)$/);
    if (!match) return;

    var target = parseInt(match[1], 10);
    var suffix = match[2];

    if (reduced) return;

    el.textContent = '0' + suffix;

    function animateCount() {
      var start = null;
      var duration = 1200;
      function step(ts) {
        if (!start) start = ts;
        var progress = Math.min((ts - start) / duration, 1);
        var eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(eased * target) + suffix;
        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          el.textContent = target + suffix;
          el.style.animation = 'count-pop 0.4s var(--ease-out)';
        }
      }
      requestAnimationFrame(step);
    }

    if ('IntersectionObserver' in window) {
      var obs = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            animateCount();
            obs.disconnect();
          }
        });
      }, { threshold: 0.5 });
      obs.observe(el);
    } else {
      el.textContent = target + suffix;
    }
  });

  /* ---------------- Project card 3D tilt ---------------- */
  if (!reduced && window.matchMedia('(pointer: fine)').matches) {
    document.querySelectorAll('.project-card').forEach(function (card) {
      var thumb = card.querySelector('.project-card__thumb');

      card.addEventListener('mousemove', function (e) {
        var rect = card.getBoundingClientRect();
        var x = (e.clientX - rect.left) / rect.width - 0.5;
        var y = (e.clientY - rect.top) / rect.height - 0.5;
        card.style.transform =
          'perspective(800px) rotateY(' + (x * 10) + 'deg) rotateX(' + (-y * 10) + 'deg) translateY(-4px)';
        if (thumb) {
          thumb.style.transform = 'translateZ(20px)';
        }
      });

      card.addEventListener('mouseleave', function () {
        card.style.transform = '';
        if (thumb) thumb.style.transform = '';
      });
    });
  }

  /* ---------------- Page transition on internal navigation ---------------- */
  var overlay = document.querySelector('.page-transition');

  // Safety net: if the browser restores this page from bfcache (e.g. via the
  // back/forward buttons) right after the overlay was activated for an outgoing
  // navigation, the class would otherwise survive the restore and leave the page
  // permanently covered until a manual refresh.
  window.addEventListener('pageshow', function () {
    if (overlay) overlay.classList.remove('is-active');
  });

  if (overlay && !reduced) {
    document.querySelectorAll('a[href]').forEach(function (link) {
      var href = link.getAttribute('href');
      if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:')) return;
      if (link.target === '_blank') return;
      if (link.origin && link.origin !== window.location.origin) return;

      // Same-page anchor (e.g. "/site/#about" while already on "/site/"): this is a
      // same-document scroll, not a real navigation, so the browser never reloads and
      // never removes the overlay class again. Let it scroll natively instead.
      if (link.pathname === window.location.pathname) return;

      link.addEventListener('click', function (e) {
        e.preventDefault();
        overlay.classList.add('is-active');
        setTimeout(function () {
          window.location.href = href;
        }, 380);
      });
    });
  }
})();
