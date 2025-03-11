import $ from 'jquery';

export const videoComponent = () => {
  $('.lgfb-video__poster__play').on('click', function () {
    if ($(this).hasClass('media-image')) return;

    $(this).closest('.lgfb-video').addClass('clicked');

    var $vid = $(this)
      .closest('.lgfb-video')
      .find('.lgfb-video__poster-container .lgfb-video__code');

    if ($vid.length === 0) {
      $vid = $(this).closest('.lgfb-video').find('.lgfb-video__code');
    }

    if ($vid.length === 0) return;

    const vidCode = $vid.text();
    $vid.empty().html(vidCode);

    const vidIFrame = $vid.find('iframe')[0];
    const hasQueryParams = vidIFrame.src.indexOf('?') > 0;

    vidIFrame.src += hasQueryParams ? '&autoplay=1' : '?autoplay=1';
    vidIFrame.focus();
  });

  $('.transcript__toggle').on('click', function () {
    const icon = '<i class="fa-solid fa-angle-down"></i>';

    let $content;
    if ($(this).closest('.media-grid-title-text-transcript').length) {
      $content = $(this)
        .closest('.media-grid-title-text-transcript')
        .find('.transcript__content');
    } else {
      $content = $(this).siblings('.transcript__content');
    }

    if (!$(this).hasClass('toggled')) {
      $(this)
        .addClass('toggled')
        .html('Hide Transcript ' + icon)
        .attr('aria-expanded', 'true');

      $content.slideDown().attr('aria-hidden', 'false');
    } else {
      $(this)
        .removeClass('toggled')
        .html('View Transcript ' + icon)
        .attr('aria-expanded', 'false');

      $content.slideUp().attr('aria-hidden', 'true');
    }
  });
};

import.meta.webpackHot?.accept(videoComponent);
