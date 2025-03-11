import {isEmpty, isMediaBreakpoint} from "@scripts/utils.js";

/**
 * Hides and reveals cards in a routing card section.
 * @usedby RoutingCardsProvider
 */
export const hideAndRevealCards = () => {

  /**
   * Configuration property that determines how many items should show at a time on a given device size.
   *
   * @type {{desktop: number, mobile: number}}
   */
  const revealThresholds = {
    mobile: 4,
    desktop: 8,
  }

  /**
   * Initializes the component.
   *
   * @uses handleToggle()
   * @uses handleHide()
   * @returns void
   */
  const init = () => {

    /**
     * The sections that implement hide/reveal.
     * @type {NodeListOf<HTMLDivElement>}
     */
    const sections = document.querySelectorAll('[data-reveal-cards-section]');

    if (sections.length === 0) return;

    sections.forEach((section) => {
      const {gridItems, button} = getSectionElements(section);

      if (gridItems.length === 0 || gridItems.length <= getThreshold() || isEmpty(button)) return;

      handleHide(section);

      button.setAttribute('aria-hidden', 'false');
      button.addEventListener('click', (e) => {
        e.preventDefault();
        handleToggle(button, section);
      })

    })

  }


  /**
   * Hide or reveal depending upon the state of the button.
   *
   * @param {HTMLButtonElement} button
   * @param {HTMLDivElement} section
   */
  const handleToggle = (button, section) => {

    if (button.getAttribute('aria-expanded') === 'true') {
      handleHide(section);
      return;
    }

    handleReveal(section);

  }

  /**
   * Handles hiding the grid items and changing the buttons state.
   *
   * @param {HTMLDivElement} section
   */
  const handleHide = (section) => {

    const {gridItems, button} = getSectionElements(section);

    gridItems.forEach((item, i) => {
      if (i > getThreshold() - 1) {
        item.setAttribute('aria-hidden', 'true');
      }
    })

    button.setAttribute('aria-expanded', 'false');

  }

  /**
   * Handles revealing the grid items and changing the button state.
   *
   * @param {HTMLDivElement} section
   */
  const handleReveal = (section) => {
    const {button, gridItems} = getSectionElements(section);

    gridItems.forEach((item) => {
      item.setAttribute('aria-hidden', 'false');
    })

    button.setAttribute('aria-expanded', 'true');
  }

  /**
   * Get the elements in the section that need to be effected.
   *
   * @param {HTMLDivElement} section
   * @returns {{button: HTMLButtonElement, grid: HTMLUListElement, gridItems: NodeListOf<HTMLLIElement>}}
   */
  const getSectionElements = (section) => {
    /**
     * @type {HTMLButtonElement}
     */
    const button = section.querySelector('[data-reveal-cards-button]');

    /**
     * @type {HTMLUListElement}
     */
    const grid = section.querySelector('[data-reveal-cards-grid]');

    /**
     * @type {NodeListOf<HTMLLIElement>}
     */
    const gridItems = section.querySelectorAll('[data-reveal-cards-item]');

    return {
      button,
      grid,
      gridItems,
    }
  }

  /**
   * Get the threshold of items that should be shown.
   * @returns {number}
   */
  const getThreshold = () => {
    const isMobile = isMediaBreakpoint('md', 'down');

    return isMobile ? revealThresholds.mobile : revealThresholds.desktop;
  }

  /**
   * Start the engine.
   */
  return init();


}

import.meta.webpackHot?.accept(hideAndRevealCards);
