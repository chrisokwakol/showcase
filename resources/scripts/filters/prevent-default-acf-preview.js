export const preventDefaultACFPreview = () => {
  let links = document.querySelectorAll(
    '.acf-block-preview a:not(.ignore-prevent-default)',
  );

  if (links.length === 0) return;

  /**
   * The listener itself.
   * @param {HTMLAnchorElement} link
   */
  const handlePreventDefault = (link) => {
    link.preventDefault();
  };

  /**
   *
   * Handles adding and removing the listener.
   */
  links.forEach((link) => {
    // Quick clean up so we don't run into memory issues.
    link.removeEventListener('click', handlePreventDefault);

    // Reinstate a new listener.
    link.addEventListener('click', handlePreventDefault);
  });
};

import.meta.webpackHot?.accept(preventDefaultACFPreview);
