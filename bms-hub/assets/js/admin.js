/**
 * BMS Hub – Admin JS
 * BMS Projekte
 */
(function () {
  'use strict';

  /* ── Add / Remove Testimonials ─── */
  const testimonialList = document.getElementById('testimonials-list');
  const addBtn = document.getElementById('addTestimonial');

  if (addBtn && testimonialList) {
    addBtn.addEventListener('click', () => {
      const idx = testimonialList.querySelectorAll('[data-testimonial]').length;
      const tpl = document.createElement('div');
      tpl.className = 'admin-card';
      tpl.style.marginBottom = '16px';
      tpl.setAttribute('data-testimonial', '');
      tpl.innerHTML = `
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
          <strong style="color:#FFF">Neues Testimonial</strong>
          <button type="button" class="admin-btn admin-btn-danger admin-btn-sm remove-testimonial">Entfernen</button>
        </div>
        <div class="admin-form-row">
          <div class="admin-form-group">
            <label class="admin-label">Name</label>
            <input class="admin-input" name="testimonial_name[]" placeholder="Max Mustermann">
          </div>
          <div class="admin-form-group">
            <label class="admin-label">Datum</label>
            <input class="admin-input" name="testimonial_date[]" placeholder="März 2026">
          </div>
        </div>
        <div class="admin-form-group">
          <label class="admin-label">Bewertungstext</label>
          <textarea class="admin-textarea" name="testimonial_text[]" placeholder="Kundenstimme…"></textarea>
        </div>
        <div class="admin-form-group">
          <label class="admin-label">Sterne</label>
          <select class="admin-select" name="testimonial_rating[]">
            <option value="5">5 Sterne</option>
            <option value="4">4 Sterne</option>
            <option value="3">3 Sterne</option>
          </select>
        </div>
      `;
      testimonialList.appendChild(tpl);
      bindRemove(tpl);
      tpl.querySelector('input')?.focus();
    });
  }

  function bindRemove(container) {
    container.querySelectorAll('.remove-testimonial').forEach(btn => {
      btn.addEventListener('click', () => {
        if (confirm('Testimonial wirklich entfernen?')) {
          btn.closest('[data-testimonial]')?.remove();
        }
      });
    });
  }

  // Bind existing remove buttons
  document.querySelectorAll('[data-testimonial]').forEach(bindRemove);

  /* ── Unsaved changes warning ─── */
  let formDirty = false;
  const form = document.querySelector('form');
  if (form) {
    form.addEventListener('input', () => { formDirty = true; });
    form.addEventListener('submit', () => { formDirty = false; });
    window.addEventListener('beforeunload', (e) => {
      if (formDirty) {
        e.preventDefault();
        e.returnValue = 'Du hast ungespeicherte Änderungen. Trotzdem verlassen?';
      }
    });
  }

  /* ── Character count for SEO fields ─── */
  document.querySelectorAll('[name$="_title"], [name$="_description"]').forEach(input => {
    const hint = input.nextElementSibling;
    const max = input.tagName === 'TEXTAREA' ? 160 : 60;
    const update = () => {
      const len = input.value.length;
      const color = len > max ? '#FCA5A5' : len > max * 0.8 ? '#FCD34D' : '#86EFAC';
      if (hint) {
        hint.textContent = `${len} / ${max} Zeichen`;
        hint.style.color = color;
      }
    };
    input.addEventListener('input', update);
    update();
  });

})();
