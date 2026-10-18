(() => {
  'use strict';
  document.documentElement.classList.remove('no-js');
  const toggle = document.getElementById('menuToggle');
  const close = document.getElementById('menuClose');
  const menu = document.getElementById('mobileMenu');
  if (toggle && close && menu && typeof menu.showModal === 'function') {
    let previousOverflow = '';
    const closeMenu = () => { if (menu.open) menu.close(); };
    toggle.addEventListener('click', () => {
      previousOverflow = document.body.style.overflow;
      menu.showModal();
      document.body.style.overflow = 'hidden';
      toggle.setAttribute('aria-expanded', 'true');
    });
    close.addEventListener('click', closeMenu);
    menu.addEventListener('keydown', event => {
      if (event.key !== 'Tab') return;
      const controls = [...menu.querySelectorAll('a[href], button:not([disabled]), [tabindex="0"]')];
      const first = controls[0];
      const last = controls[controls.length - 1];
      if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last.focus();
      } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
      }
    });
    menu.addEventListener('click', event => {
      if (event.target.closest('a')) closeMenu();
      if (event.target === menu) {
        const bounds = menu.getBoundingClientRect();
        if (event.clientX < bounds.left || event.clientX > bounds.right || event.clientY < bounds.top || event.clientY > bounds.bottom) closeMenu();
      }
    });
    menu.addEventListener('close', () => {
      document.body.style.overflow = previousOverflow;
      toggle.setAttribute('aria-expanded', 'false');
    });
    const desktop = window.matchMedia(`(min-width: ${toggle.dataset.breakpoint || '768'}px)`);
    desktop.addEventListener('change', event => { if (event.matches) closeMenu(); });
  }
  // Content is visible without JavaScript; this only marks the current section.
  if ('IntersectionObserver' in window) {
    const links = document.querySelectorAll('.nav__links a[href^="#"], .nav-links a[href^="#"]');
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        links.forEach(link => {
          if (link.hash === `#${entry.target.id}`) link.setAttribute('aria-current', 'location');
          else link.removeAttribute('aria-current');
        });
      });
    }, { rootMargin: '-15% 0px -65% 0px', threshold: 0 });
    document.querySelectorAll('section[id]').forEach(section => observer.observe(section));
  }
})();
