import domReady from '@roots/sage/client/dom-ready';

import { header } from '@scripts/components/header';

import { accordions } from '@scripts/components/accordions';
import { videoComponent } from '@scripts/components/video';
import { backToTop } from '@scripts/components/back-to-top';
import { modal } from '@scripts/components/modal.js';
import { shareIcons } from './components/share-icons.js';
import { testimonialCarousel } from './components/testimonial-carousel.js';
import { journeyStrip } from './blocks/journey-strip.js';
import { globalSearch } from './components/globalSearch.js';

/**
 * Application entrypoint
 */
domReady(async () => {
  header();
  accordions();
  videoComponent();
  backToTop();
  modal();
  shareIcons();
  testimonialCarousel();
  journeyStrip();
  globalSearch();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
