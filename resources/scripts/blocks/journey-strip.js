import $ from 'jquery';

export const journeyStrip = () => {
  $('.journey-strip__top__cta').on('click', function () {
    event.preventDefault();

    // Get button element and the spinner
    var $button = $(this);
    var $spinner = $button.find('.journey-strip__top__cta__spinner');
    var originalText = $button.find('span').text();

    // Show the spinner and hide the button text
    $spinner.show();
    $button.prop('disabled', true);
    $button.find('span').text('');

    // Hide the arrow pseudo element
    $button.addClass('hide-after');

    // Close button click event
    $(document).on('click', '.journey-strip__results__close-btn', function () {
      $('.journey-strip__results').slideUp();
    });

    var nonce = $(this).data('nonce');
    var ajaxUrl = $(this).data('url');
    var selectedStage = $('#journey_strip_stage').val();
    var selectedTopic = $('#journey_strip_topic').val();

    $.ajax({
      url: ajaxUrl,
      method: 'POST',
      data: {
        action: 'filter_journey_strip',
        nonce: nonce,
        stage: selectedStage,
        topic: selectedTopic,
      },
      success: function (response) {
        if (response.success) {
          var results = response.data.results;

          // Clear the spinner and update button text after request completes
          $spinner.hide();
          $button.prop('disabled', false);
          $button.find('span').text(originalText);

          // Show the arrow pseudo-element again when the request is complete
          $button.removeClass('hide-after');

          // Clear any existing results
          $('.journey-strip__results').empty();

          // Titles for the categories
          const resourceTitle = 'Resources';
          const postTitle = 'Blog';
          const workshopTitle = 'Workshops';

          // Categorize the results
          let resources = [];
          let posts = [];
          let workshops = [];

          results.forEach(function (item) {
            var resultItem = `
        <div class="journey-strip__results__item fs-base">
          <a class="journey-strip__results__link fs-base" href="${item.url}" target="_blank">${item.title}</a>
        </div>
      `;

            // Append the result item to the correct container based on the post type
            if (item.post_type === 'resource') {
              resources.push(resultItem);
            } else if (item.post_type === 'post') {
              posts.push(resultItem);
            } else if (item.post_type === 'workshop') {
              workshops.push(resultItem);
            }
          });

          // Create the full HTML structure and append it to the results container
          var resultsHTML = `<div class="journey-strip__results__container container">
            <!-- Close button -->
            <button class="journey-strip__results__close-btn"></button>
        `;

          if (workshops.length > 0) {
            resultsHTML += `
            <div class="journey-strip__results__section journey-strip__results__section--resources">
              <p class="journey-strip__results__title fs-base bold">${workshopTitle}</p>
              ${workshops.join('')}
            </div>
          `;
          } else {
            resultsHTML += `
            <div class="journey-strip__results__section journey-strip__results__section--resources">
              <p class="journey-strip__results__title fs-base bold">${workshopTitle}</p>
              <p class="fs-base">No workshops found.</p>
            </div>
          `;
          }

          if (resources.length > 0) {
            resultsHTML += `
            <div class="journey-strip__results__section journey-strip__results__section--pages">
              <p class="journey-strip__results__title fs-base bold">${resourceTitle}</p>
              ${resources.join('')}
            </div>
          `;
          } else {
            resultsHTML += `
            <div class="journey-strip__results__section journey-strip__results__section--pages">
              <p class="journey-strip__results__title fs-base bold">${resourceTitle}</p>
              <p class="fs-base">No resources found.</p>
            </div>
          `;
          }

          if (posts.length > 0) {
            resultsHTML += `
            <div class="journey-strip__results__section journey-strip__results__section--posts">
              <p class="journey-strip__results__title fs-base bold">${postTitle}</p>
              ${posts.join('')}
            </div>
          `;
          } else {
            resultsHTML += `
            <div class="journey-strip__results__section journey-strip__results__section--posts">
              <p class="journey-strip__results__title fs-base bold">${postTitle}</p>
              <p class="fs-base">No posts found.</p>
            </div>
          `;
          }

          resultsHTML += '</div>'; // Close the container

          // Append the generated HTML to the results section
          $('.journey-strip__results').append(resultsHTML);
          $('.journey-strip__results').slideDown();
        } else {
          console.error('Error in AJAX response:', response.data.message);
        }
      },

      error: function (xhr, status, error) {
        console.error('AJAX Error:', error);
        console.error('XHR Response:', xhr.responseText);
      },

      complete: function () {},
    });
  });
};

import.meta.webpackHot?.accept(journeyStrip);
