import {
  getBlockTypes,
  unregisterBlockType,
  unregisterBlockVariation,
} from '@wordpress/blocks';
import { useSelect } from '@wordpress/data';

import { useEffect } from 'react';

/** Plugin name */
export const name = 'curate-blocks-plugin';

/** Plugin title */
export const title = 'Curate Blocks Plugin';

/** Plugin render */
export const render = () => {
  const currentPost = useSelect((select) =>
    select('core/editor').getCurrentPost(),
  );

  useEffect(() => {
    let embedVariations = [];
    const keepEmbedVariations = ['youtube', 'vimeo'];
    // Remove Block and their variations.
    getBlockTypes()
      .filter((block) => {
        if (block.name === 'core/embed') {
          embedVariations = block.variations.filter((variation) => {
            return !keepEmbedVariations.includes(variation.name);
          });
        }

        let removeList = [
          'core/image',
          'core/gallery',
          'core/quote',
          'core/archives',
          'core/button',
          'core/buttons',
          'core/calendar',
          'core/categories',
          'core/code',
          'core/cover',
          'core/latest-comments',
          'core/latest-posts',
          'core/latest-posts',
          'core/page-list',
          'core/page-list-item',
          'core/pullquote',
          'core/rss',
          'core/search',
          'core/social-link',
          'core/social-links',
          'core/tag-cloud',
          'core/verse',
          'core/navigation',
          'core/navigation-link',
          'core/navigation-submenu',
          'core/site-logo',
          'core/site-title',
          'core/site-tagline',
          'core/query',
          'core/avatar',
          'core/comments',
          'core/post-comments-form',
          // 'core/embed',
        ];

        // Template specific curation.
        // Type 1 - 'templates' is all of the templates that are allowed to have this block
        if (
          block.supports.templates !== undefined &&
          block.supports.templates.length > 0
        ) {
          if (!block.supports.templates.includes(currentPost.template)) {
            removeList.push(block.name);
          }
        }

        // Type 2 - 'templates_banned' is all of the templates that are NOT allowed to have this block
        if (
          block.supports.templates_banned !== undefined &&
          block.supports.templates_banned.length > 0
        ) {
          if (block.supports.templates_banned.includes(currentPost.template)) {
            removeList.push(block.name);
          }
        }

        return removeList.includes(block.name);
      })
      .map((block) => {
        if (block.variations.length) {
          block.variations.map((variation) => {
            unregisterBlockVariation(block.name, variation.name);
          });
        }
        unregisterBlockType(block.name);
      });

    // Remove / Keep specific embed variations
    if (embedVariations.length) {
      embedVariations.map((variation) => {
        unregisterBlockVariation('core/embed', variation.name);
      });
    }
  }, [currentPost.template]);

  return null;
};
