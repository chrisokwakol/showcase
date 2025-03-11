import { isEmpty } from '@scripts/utils.js';

export const backToTop = () => {
  const init = () => {
    window.addEventListener('scroll', toggleOnScroll);
    document.addEventListener('load', toggleOnScroll);
    setupKeyboardAccessibility(); // Add keyboard accessibility setup
  };

  const toggleOnScroll = () => {
    /**
     * @var {HTMLButtonElement}
     */
    const button = document.getElementById('back-to-top');

    if (isEmpty(button)) return;

    const documentHeight = document.documentElement.scrollHeight;
    const viewportHeight = window.innerHeight;
    const scrollThreshold = (documentHeight - viewportHeight) * 0.25;

    button.classList.toggle('visible', window.scrollY > scrollThreshold);
  };

  const setupKeyboardAccessibility = () => {
    const button = document.getElementById('back-to-top');

    if (isEmpty(button)) return;

    // Listen for keyboard events (Enter or Space to activate)
    button.addEventListener('keydown', (event) => {
      if (event.key === 'Enter' || event.key === ' ') {
        scrollToTop();
      }
    });

    // Handle click event to scroll to the top
    button.addEventListener('click', scrollToTop);
  };

  const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  return init();
};

import.meta.webpackHot?.accept(backToTop);
