/**
 * @see {@link https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#blocks-registerblocktype}
 */
export const hook = 'blocks.registerBlockType';

/**
 * Filter handle
 */
export const name = 'emerson/add-wide-option-control';

/**
 * Filter callback
 *
 * @param {object} settings
 * @param {string} name
 * @returns modified settings
 */
export function callback(settings, name) {
  if (name == 'core/group' || name == 'core/columns') {
    // adds .is-style-wide if selected.
    settings.styles = [
      {
        label: 'Full Width',
        name: 'wide',
      },
      {
        label: 'Narrow Width',
        name: 'narrow',
      },
    ];
  }

  return settings;
}
