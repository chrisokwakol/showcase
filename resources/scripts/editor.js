import {initializeACFBlockScript} from './utils';

/**
 * @see {@link https://bud.js.org/extensions/bud-preset-wordpress/editor-integration/filters}
 */
roots.register.filters('@scripts/filters');
roots.register.blocks('@scripts/blocks');
roots.register.plugins('@scripts/plugins');
roots.register.variations(`@scripts/variations`);

import {preventDefaultACFPreview} from './filters/prevent-default-acf-preview';

import {accordions} from '@scripts/components/accordions';
import {videoComponent} from '@scripts/components/video';

initializeACFBlockScript(accordions, 'accordion');
initializeACFBlockScript(preventDefaultACFPreview);
initializeACFBlockScript(videoComponent, 'video');

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);



