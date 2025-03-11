/**
 *
 * @param {function} callback the function to fire when the preview initializes.
 * @param {string | null} blockName The name of the block you want to listen to.
 */
export const initializeACFBlockScript = (callback, blockName = null) => {
  if (window.acf && callback) {
    const type = blockName !== null ? `/type=${blockName}` : '';
    window.acf.addAction(`render_block_preview${type}`, function () {
      callback();
    });
  }
};

/**
 * Check if a property is null or undefined.
 *
 * @param {any} prop
 * @returns
 */
export const isUndefined = (prop) => {
  return prop === undefined;
};
/**
 * Check if a property is null or undefined.
 *
 * @param {any} prop
 * @returns
 */
export const isNullOrUndefined = (prop) => {
  return prop === undefined || prop === null;
};

/**
 * Check if a property is empty: false, undefined, null, whitespace, or an empty array
 *
 * @param {array | object | string | undefined | null} prop
 * @returns {boolean}
 */
export const isEmpty = (prop) => {
  return prop === undefined || prop === null || prop === '' || !prop || prop.length === 0;
};


const Breakpoints = {
  xs: 0,
  sm: 576,
  md: 768,
  lg: 992,
  xl: 1200,
  xxl: 1650,
}

/**
 * Checks the size of the window against standardized breakpoints and returns true or false depending upon the direction selected.
 * When the function is called in the admin area, it changes to listening to the editor wrapper instead of window.
 *
 * @param {string} breakpoint The breakpoint: xs | sm | md | lg | xl,
 * @param {'up' | 'down'} direction up | down
 * @returns {boolean}
 */
export const isMediaBreakpoint = (breakpoint, direction = 'up') => {
  const selectedBreakpoint = Breakpoints[breakpoint];

  if (isEmpty(selectedBreakpoint)) throw new Error(`Breakpoint ${breakpoint} not found`);

  // If in the admin area, intercepts the standard media query in the editor and listens to the Gutenberg container instead of the window.
  const editorWrapper = document.querySelector('.wp-admin .editor-styles-wrapper');
  if (!isEmpty(editorWrapper)) {
    const width = editorWrapper.getBoundingClientRect().width;

    if (direction === 'down') return width <= selectedBreakpoint;

    return width > selectedBreakpoint;
  }

  // Listen to the window when not in the admin.
  if (direction === 'down') {
    return window.matchMedia(`(max-width: ${selectedBreakpoint}px)`).matches;
  }

  return window.matchMedia(`(min-width: ${selectedBreakpoint}px)`).matches;

}

/**
 *
 * @param {string} lowerBreakpoint The lower breakpoint: xs | sm | md | lg | xl
 * @param {string} higherBreakpoint The higher breakpoint value: xs | sm | md | lg | xl
 * @returns {boolean}
 */
export const isMediaBreakpointBetween = (lowerBreakpoint, higherBreakpoint) => {
  const selectedLowerBreakpoint = Breakpoints[lowerBreakpoint];
  const selectedHigherBreakpoint = Breakpoints[higherBreakpoint];

  if (isEmpty(selectedLowerBreakpoint) || isEmpty(selectedHigherBreakpoint)) throw new Error(`Breakpoint not found`);

  // If in the admin area, intercepts the standard media query in the editor and listens to the Gutenberg container instead of the window.
  const editorWrapper = document.querySelector('.wp-admin .editor-styles-wrapper');
  if (!isEmpty(editorWrapper)) {
    const width = editorWrapper.getBoundingClientRect().width;
    return width > selectedLowerBreakpoint && width <= selectedHigherBreakpoint;
  }

  // Listen to the window when not in the admin.
  return window.matchMedia(`(min-width: ${selectedLowerBreakpoint}px and max-width: ${selectedHigherBreakpoint})px`).matches;

}

export const delay = async (delayInMilliseconds= 50, returnValue = '') => {
  return await new Promise(resolve => setTimeout(() => {
    resolve(returnValue);
  }, delayInMilliseconds
  ))
};
