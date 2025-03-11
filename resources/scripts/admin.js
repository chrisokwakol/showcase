import domReady from '@roots/sage/client/dom-ready';

import { resourceStrings } from './components/resource-strings';

domReady(async () => {
  resourceStrings();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
