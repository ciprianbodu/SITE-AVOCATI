(() => {
  'use strict';
  const toggle = document.getElementById('menuToggle');
  const close = document.getElementById('menuClose');
  const menu = document.getElementById('mobileMenu');
  if (toggle && close && menu && typeof menu.showModal === 'function') {
    document.documentElement.classList.remove('no-js');
    let previousOverflow = '';
    const closeMenu = () => { if (menu.open) menu.close(); };
    toggle.addEventListener('click', () => {
      previousOverflow = document.body.style.overflow;
      // WebKit does not focus a button on pointer activation. Set the dialog's return target.
      toggle.focus({ preventScroll: true });
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
  if ('IntersectionObserver' in window) {
    const sections = [...document.querySelectorAll('main section[id]')];
    const links = document.querySelectorAll('.nav-links a[href^="#"], .mobile-menu__links a[href^="#"]');
    let observer;

    const observeSections = () => {
      if (observer) observer.disconnect();
      const readingLine = Math.min(window.innerHeight - 1, Math.max(100, Math.round(window.innerHeight * .34)));
      const bottomInset = window.innerHeight - readingLine - 1;
      observer = new IntersectionObserver(() => {
        const current = sections.find(section => {
          const bounds = section.getBoundingClientRect();
          return bounds.top < readingLine + 1 && bounds.bottom > readingLine;
        });
        links.forEach(link => {
          if (current && link.hash === '#' + current.id) link.setAttribute('aria-current', 'location');
          else link.removeAttribute('aria-current');
        });
      }, { rootMargin: `-${readingLine}px 0px -${bottomInset}px 0px` });
      sections.forEach(section => observer.observe(section));
    };

    observeSections();
    window.addEventListener('resize', observeSections);
  }

  const heroFilm = document.querySelector('.hero-film');
  if (heroFilm && matchMedia('(prefers-reduced-motion: no-preference)').matches) {
    const playFilm = () => heroFilm.play().catch(() => {});
    if ('IntersectionObserver' in window) {
      const filmObserver = new IntersectionObserver(([entry]) => {
        if (!entry.isIntersecting) {
          heroFilm.pause();
        } else if (entry.intersectionRatio >= .6 && heroFilm.paused) {
          playFilm();
        }
      }, { threshold: [0, .6] });
      filmObserver.observe(heroFilm);
    } else {
      playFilm();
    }
  }
})();
