(() => {
  'use strict';

  const toggle = document.getElementById('menuToggle');
  const menu = document.getElementById('mobileMenu');
  const close = document.getElementById('menuClose');
  if (typeof menu.showModal !== 'function') return;

  const mobile = matchMedia('(max-width: 780px)');
  document.documentElement.classList.add('menu-enabled');

  function syncLayout() {
    toggle.hidden = !mobile.matches;
    if (toggle.hidden && menu.open) menu.close();
  }

  syncLayout();
  mobile.addEventListener('change', syncLayout);

  toggle.addEventListener('click', () => {
    // Focusul explicit păstrează revenirea la buton și în WebKit.
    toggle.focus({ preventScroll: true });
    menu.showModal();
    toggle.setAttribute('aria-expanded', 'true');
  });
  close.addEventListener('click', () => menu.close());
  menu.addEventListener('click', (event) => {
    if (event.target.closest('a')) menu.close();
    if (event.target === menu) {
      const bounds = menu.getBoundingClientRect();
      const outside = event.clientX < bounds.left || event.clientX > bounds.right ||
        event.clientY < bounds.top || event.clientY > bounds.bottom;
      if (outside) menu.close();
    }
  });
  menu.addEventListener('close', () => toggle.setAttribute('aria-expanded', 'false'));
})();
