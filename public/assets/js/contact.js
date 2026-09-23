(function () {
  var form = document.querySelector('.contact-form');
  if (!form) return;

  var statusEl = form.querySelector('.form-status');
  var submitBtn = form.querySelector('button[type="submit"]');
  var renderedAtField = form.querySelector('input[name="_rendered_at"]');

  if (renderedAtField) {
    renderedAtField.value = (Date.now() / 1000).toString();
  }

  function fieldError(name) {
    return form.querySelector('.form-error[data-for="' + name + '"]');
  }

  function clearErrors() {
    form.querySelectorAll('.form-error').forEach(function (el) {
      el.textContent = '';
    });
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    clearErrors();
    statusEl.textContent = '';
    statusEl.className = 'form-status';

    submitBtn.disabled = true;
    var originalLabel = submitBtn.textContent;
    submitBtn.textContent = 'Sending…';

    var formData = new FormData(form);

    fetch(form.getAttribute('action'), {
      method: 'POST',
      body: formData,
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
    })
      .then(function (res) {
        return res.json().then(function (data) {
          return { ok: res.ok, data: data };
        });
      })
      .then(function (result) {
        if (result.data.success) {
          statusEl.textContent = result.data.message;
          statusEl.classList.add('is-success');
          form.reset();
          if (renderedAtField) renderedAtField.value = (Date.now() / 1000).toString();
        } else {
          statusEl.textContent = result.data.message || 'Something went wrong.';
          statusEl.classList.add('is-error');
          if (result.data.errors) {
            Object.keys(result.data.errors).forEach(function (key) {
              var el = fieldError(key);
              if (el) el.textContent = result.data.errors[key];
            });
          }
        }
      })
      .catch(function () {
        statusEl.textContent = 'Network error. Please try again or email me directly.';
        statusEl.classList.add('is-error');
      })
      .finally(function () {
        submitBtn.disabled = false;
        submitBtn.textContent = originalLabel;
      });
  });
})();
