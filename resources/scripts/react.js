import React from 'react';
import { createRoot } from 'react-dom/client';
import domReady from '@roots/sage/client/dom-ready';

import ReactComponentsList from '@scripts/react/ReactComponentsList.js'

domReady(async () => {

  const debug = false;

  /**
   * @type {NodeListOf<HTMLDivElement>}
   */
  let elements = document.querySelectorAll('[data-react-component]');

  if(debug) console.log({elements});

  if (elements.length === 0) return;

  for (let i = 0; i < elements.length; i++) {
    const element = elements[i];

    if (element === undefined) continue;

    const root = createRoot(element);

    const componentName = element?.dataset.reactComponent;
    let Component = ReactComponentsList[componentName];

    if (Component === undefined || Component === null) {
      Component = ReactComponentsList['NoComponentFound'];
    }

    const elementData = element.querySelector('[data-react-props]');
    let data = {};
    if(elementData !== undefined && elementData.textContent !== null) {
      data = JSON.parse(elementData.textContent)
    }

    const props = {
      componentName,
      ...data,
    };

    if(debug) console.log({element, props});

    root.render(<Component {...props} />, element);

    // Clean up the attributes that we no longer need.
    element.removeAttribute('data-react-props');
    element.removeAttribute('data-react-component');
    // elementData.remove();
  }
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
