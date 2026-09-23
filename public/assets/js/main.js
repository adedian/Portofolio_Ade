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

  /* ---------------- Page transition on internal navigation ---------------- */
  var overlay = document.querySelector('.page-transition');
  if (overlay && !reduced) {
    document.querySelectorAll('a[href]').forEach(function (link) {
      var href = link.getAttribute('href');
      if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:')) return;
      if (link.target === '_blank') return;
      if (link.origin && link.origin !== window.location.origin) return;

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
