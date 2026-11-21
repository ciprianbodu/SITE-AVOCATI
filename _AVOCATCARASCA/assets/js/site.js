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

document.querySelectorAll('[data-practice-slider]').forEach((slider) => {
  const track = slider.querySelector('.practice-track');
  const cards = [...track.children];
  if (cards.length < 2) return;
  const navigation = slider.querySelector('.practice-navigation');
  const buttons = [...navigation.querySelectorAll('button')];
  const position = navigation.querySelector('.practice-position');
  const motion = matchMedia('(prefers-reduced-motion: reduce)');
  let index = 0;

  function update() {
    const step = cards[1].offsetLeft - cards[0].offsetLeft;
    if (!step) return;
    index = Math.min(cards.length - 1, Math.max(0, Math.round(track.scrollLeft / step)));
    const label = `${index + 1} / ${cards.length}`;
    if (position.textContent !== label) position.textContent = label;
    buttons[0].setAttribute('aria-disabled', String(index === 0));
    buttons[1].setAttribute('aria-disabled', String(index === cards.length - 1));
  }

  function move(step) {
    const target = index + step;
    if (target < 0 || target >= cards.length) return;
    track.scrollTo({
      left: cards[target].offsetLeft - cards[0].offsetLeft,
      behavior: motion.matches ? 'auto' : 'smooth',
    });
  }

  buttons.forEach((button) => {
    button.addEventListener('click', () => move(Number(button.dataset.practiceStep)));
  });
  track.addEventListener('keydown', (event) => {
    if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') return;
    event.preventDefault();
    if (document.activeElement === track) {
      move(event.key === 'ArrowLeft' ? -1 : 1);
    } else {
      const target = cards[cards.indexOf(document.activeElement) + (event.key === 'ArrowLeft' ? -1 : 1)];
      target?.focus();
    }
  });
  track.addEventListener('scroll', update, { passive: true });
  new ResizeObserver(update).observe(track);
  navigation.hidden = false;
  update();
});
