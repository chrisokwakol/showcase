import $ from 'jquery';

export const accordions = () => {
  // Set up the first accordion to be open by default
  const firstAccordion = $('.lgfb-accordion').first();
  const firstAccordionToggle = firstAccordion.find('.lgfb-accordion__toggle');
  const firstAccordionInner = firstAccordion.find(
    '.lgfb-accordion__content__inner',
  );
  const firstAccordionTop = firstAccordion.find('.lgfb-accordion__top');

  firstAccordionToggle.attr('aria-expanded', true);
  firstAccordionTop.addClass('open');
  firstAccordionInner.show().attr('aria-hidden', false);
  firstAccordionToggle
    .find('.toggle__icon i')
    .first()
    .removeClass('fa-plus')
    .addClass('fa-minus');

  // Handle accordion toggle behavior
  $('.lgfb-accordion__toggle').on('click', function () {
    const accordionTop = $(this).closest('.lgfb-accordion__top');
    const accordionInner = accordionTop
      .siblings('.lgfb-accordion__content')
      .find('.lgfb-accordion__content__inner');
    const icon = $(this).find('.toggle__icon i');

    const isExpanded = $(this).attr('aria-expanded') === 'true';

    $(this).attr('aria-expanded', !isExpanded);
    accordionTop.toggleClass('open', !isExpanded);
    accordionInner.slideToggle().attr('aria-hidden', isExpanded);

    // Toggle the icon
    icon.toggleClass('fa-plus fa-minus');

    // Close all other accordions
    $('.lgfb-accordion__top')
      .not(accordionTop)
      .removeClass('open')
      .find('.lgfb-accordion__toggle')
      .attr('aria-expanded', false)
      .find('.toggle__icon i')
      .removeClass('fa-minus')
      .addClass('fa-plus');
    $('.lgfb-accordion__content__inner')
      .not(accordionInner)
      .slideUp()
      .attr('aria-hidden', true);
  });
};

import.meta.webpackHot?.accept(accordions);
