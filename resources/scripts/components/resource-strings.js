import { isUndefined } from '@scripts/utils';

export const resourceStrings = () => {
  /**
   * Set debug to true to get console.logs.
   *
   * @var boolean
   */
  const debug = false;

  /**
   * Listen to all the copy buttons being clicked
   *
   * @uses handleButtonClick
   * @returns void
   */
  const listenToCopyButtons = () => {
    const buttons = document.querySelectorAll(
      '[data-resource-string-copy-component],[data-resource-string-copy-inline],[data-resource-string-copy-shortcode] ',
    );

    if (debug) console.log(buttons);

    if (buttons.length === 0) return;

    buttons.forEach((button) => {
      button.addEventListener('click', () => {
        handleButtonClick(button);
      });
    });
  };

  /**
   * Handle the code and message to be set to the clipboard based on the type of button that was clicked.
   *
   * @param {HTMLButtonElement} button
   * @returns
   */
  const handleButtonClick = (button) => {
    if (debug) console.log(button);

    const key = button.dataset.key;

    const isComponent = !isUndefined(
      button.dataset.resourceStringCopyComponent,
    );

    const isInline = !isUndefined(button.dataset.resourceStringCopyInline);

    const isShortcode = !isUndefined(
      button.dataset.resourceStringCopyShortcode,
    );

    if (debug) console.log({ isComponent, isInline, isShortcode });

    if (isComponent) {
      handleCopyToClipboard(
        `<x-resource-string key="${key}" fallback="" :args="" />`,
        'Component codied copied to clipboard',
      );
      return;
    }

    if (isInline) {
      handleCopyToClipboard(
        `emerson_resource_string('${key}', 'fallback', [])`,
        'PHP code codied copied to clipboard',
      );
      return;
    }

    if (isShortcode) {
      handleCopyToClipboard(
        `[resource_string key="${key}" fallback=""]`,
        'Shortcode codied copied to clipboard',
      );
      return;
    }
  };

  /**
   * Handle the actual copying code and alerts.
   * Uses the modern navigator.clipboard method, but fallsback to the deprecated execCommand in cases where navigator isn't supported.
   *
   * @param {string} value The content to be copied to the clipboard
   * @param {string} noticeMessage The alert message that is sent to the user upon successful copying
   * @returns void
   */
  const handleCopyToClipboard = async (value, noticeMessage) => {
    if ('clipboard' in navigator) {
      if (debug) console.log('hasNavigator');

      await navigator.clipboard.writeText(value);
      alert(noticeMessage);
      return;
    }

    handleCopyToClipboardDeprecated(value, noticeMessage);
    return;
  };

  /**
   * Handles the old school execCommand copy to clipboard strategy for browsers that don't support navigator.clipboard
   *
   * @param {string} value The content to be copied to the clipboard
   * @param {string} noticeMessage The alert message that is sent to the user upon successful copying
   * @returns void
   */
  const handleCopyToClipboardDeprecated = (value, noticeMessage) => {
    var textarea = document.createElement('textarea');
    document.body.appendChild(textarea);
    textarea.value = value;
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
    alert(noticeMessage);
    return;
  };

  // Start the engine.
  listenToCopyButtons();
};

import.meta.webpackHot?.accept(resourceStrings);
