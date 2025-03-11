/**
 * @see {@link https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#blocks-registerblocktype}
 */
export const hook = 'blocks.registerBlockType';

/**
 * Filter handle
 */
export const name = 'emerson/heading';

/**
 * Filter callback
 *
 * @param {object} settings
 * @param {string} name
 * @returns modified settings
 */
export function callback(settings, name) {
  if (name !== 'core/heading') return settings;

  return {
    ...settings,
    styles: [{ label: 'Underline', name: 'underline' }],
  };
}
