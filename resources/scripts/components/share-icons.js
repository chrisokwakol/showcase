import $ from 'jquery';

export const shareIcons = () => {
  $('#copyLink').on('click', function (event) {
    event.preventDefault();
    var postLink = $('.lgfb-share-icons').data('post-link');

    // Create a temporary input to copy the link to the clipboard
    var tempInput = $('<input>');
    tempInput.val(postLink);
    $('body').append(tempInput);

    // Select and copy the content
    tempInput.select();
    document.execCommand('copy');

    // Remove the temporary input element
    tempInput.remove();

    // Show the tooltip
    var tooltip = $('#copyTooltip');
    tooltip.fadeIn().addClass('show');

    // Hide the tooltip after 2 seconds
    setTimeout(function () {
      tooltip.fadeOut().removeClass('show'); // Hide and remove the 'show' class
    }, 2000);
  });
};

import.meta.webpackHot?.accept(shareIcons);
