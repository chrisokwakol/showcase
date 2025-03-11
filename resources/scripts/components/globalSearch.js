import $ from 'jquery';

export const globalSearch = () => {
  const pageType = $('.blog-landing__search-wrapper').data('page-type');

  // Toggle the taxonomy lists + Keyboard Accessibility
  const initializeTaxonomyToggles = () => {
    const $taxonomyButtons = $('.taxonomy-title-button');

    // First, show the initial topic list
    $('.topic-taxonomy__list').first().show();

    $taxonomyButtons.each(function () {
      $(this).on('click', function () {
        const $button = $(this);
        const isExpanded = $button.attr('aria-expanded') === 'true';
        const $currentTaxonomy = $button.closest(
          '.blog-landing__search__filters__taxonomy',
        );
        const $currentTopicList = $currentTaxonomy.find(
          '.topic-taxonomy__list',
        );

        // If expanding this taxonomy, collapse all others first
        if (!isExpanded) {
          // Close all other taxonomy lists
          $('.blog-landing__search__filters__taxonomy')
            .not($currentTaxonomy)
            .find('.topic-taxonomy__list:visible')
            .slideUp();
          $('.blog-landing__search__filters__taxonomy')
            .not($currentTaxonomy)
            .find('.taxonomy-title-button')
            .attr('aria-expanded', 'false')
            .find('i')
            .removeClass('fa-minus')
            .addClass('fa-plus');
        }

        // Toggle the current taxonomy
        $button.attr('aria-expanded', !isExpanded);

        if ($currentTopicList.is(':visible')) {
          $currentTopicList.slideUp();
          $button.find('i').removeClass('fa-minus').addClass('fa-plus');
        } else {
          $currentTopicList.slideDown();
          $button.find('i').removeClass('fa-plus').addClass('fa-minus');
        }
      });
    });
  };

  const updateTaxonomyCount = () => {
    const updateCount = () => {
      let totalSelected = 0;

      if (pageType === 'blog-landing') {
        ['topic', 'treatment-stage', 'audience-type'].forEach((taxonomy) => {
          const selectedCount = $(
            `input[name="${taxonomy}_filters[]"]:checked`,
          ).length;
          totalSelected += selectedCount;

          // Update individual taxonomy count
          $(`.taxonomy-title--${taxonomy} .taxonomy-count`)
            .text(selectedCount > 0 ? selectedCount : '')
            .css('visibility', selectedCount > 0 ? 'visible' : 'hidden');
        });
      } else if (pageType === 'global-search') {
        // Global search post type logic
        totalSelected = $('input[name="post_type_filters[]"]:checked').length;
      }

      // Update apply button count
      if (totalSelected > 0) {
        $('.blog-landing-apply-filter-btn__taxonomy-count')
          .text(` (${totalSelected})`)
          .show();
      } else {
        $('.blog-landing-apply-filter-btn__taxonomy-count').hide();
      }
    };

    // Attach change event to all checkboxes based on page type
    if (pageType === 'blog-landing') {
      $('input[type="checkbox"][name$="_filters[]"]').on('change', updateCount);
    } else if (pageType === 'global-search') {
      $('input[type="checkbox"][name="post_type_filters[]"]').on(
        'change',
        updateCount,
      );
    }

    updateCount(); // Initial count
  };

  const initializeSearchForm = () => {
    let $searchForm, $searchInput;

    if (pageType === 'blog-landing') {
      $searchForm = $('.blog-landing__cta-strip form');
      $searchInput = $searchForm.find('input[name="blog-landing-search"]');
    } else if (pageType === 'global-search') {
      $searchForm = $('.js-global-search-form');
      $searchInput = $searchForm.find('input[name="s"]');
    }

    $searchForm.on('submit', function (e) {
      e.preventDefault();
      handleFilters(false, 1);
    });
  };

  const globalSearchFilterToggle = () => {
    const $filterToggle = $(
      '.blog-landing__search__filters__filter-title--global-search',
    );
    const $filtersContainer = $(
      '.blog-landing__search__filters--global-search',
    );
    const isMobile = () => window.innerWidth < 768;
    const setupMobileView = () => {
      // On mobile initial setup
      $filtersContainer.hide();
      $filterToggle.attr('aria-expanded', 'false');
      $filterToggle.find('i').removeClass('fa-minus').addClass('fa-plus');
      $filterToggle.attr('tabindex', '0');
      $filterToggle.attr('role', 'button');
      // Enable click toggle on mobile
      $filterToggle.off('click').on('click', function () {
        const isExpanded = $(this).attr('aria-expanded') === 'true';
        $(this).attr('aria-expanded', !isExpanded);
        if ($filtersContainer.is(':visible')) {
          $filtersContainer.slideUp();
          $(this).find('i').removeClass('fa-minus').addClass('fa-plus');
        } else {
          $filtersContainer.slideDown();
          $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
        }
      });
    };
    const setupDesktopView = () => {
      // On desktop, always show filters and disable toggle
      $filtersContainer.show();
      $filterToggle.attr('aria-expanded', 'true');
      $filterToggle.find('i').removeClass('fa-plus').addClass('fa-minus');
      $filterToggle.removeAttr('tabindex');
      $filterToggle.attr('role', 'heading');
      // Disable click toggle on desktop
      $filterToggle.off('click');
    };
    if (isMobile()) {
      setupMobileView();
    } else {
      setupDesktopView();
    }
    // Handle resize events
    let resizeTimer;
    $(window).on('resize', function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        if (isMobile()) {
          setupMobileView();
        } else {
          setupDesktopView();
        }
      }, 250);
    });
    // Keyboard accessibility
    $filterToggle.on('keydown', function (e) {
      if (e.which === 13 || e.which === 32) {
        // Enter or Space key
        e.preventDefault();
        $(this).trigger('click');
      }
    });
  };

  const handleFilters = (clear = false, pageNum = 1) => {
    let filters = {};
    let searchInputSelector = '';
    let searchTerm = '';
    let ajaxAction = '';
    let nonce = '';

    // Determine selectors based on page type
    if (pageType === 'blog-landing') {
      searchInputSelector =
        '.blog-landing-search-form input[name="blog-landing-search"]';
      ajaxAction = 'filter_blog_posts';
      nonce = $('.blog-landing-apply-filter-btn').data('nonce');
    } else if (pageType === 'global-search') {
      searchInputSelector = '.js-global-search-form input[name="s"]';
      ajaxAction = 'filter_global_search';
      nonce = $('.blog-landing-apply-filter-btn').data('nonce');
    }

    // Get search term
    searchTerm = clear ? '' : $(searchInputSelector).val();

    if (clear) {
      $('input[type="checkbox"]').prop('checked', false);
      $(searchInputSelector).val('');
    } else {
      // Gather selected filters based on page type
      if (pageType === 'blog-landing') {
        ['topic', 'treatment-stage', 'audience-type'].forEach((taxonomy) => {
          const selected = [];
          $(`input[name="${taxonomy}_filters[]"]:checked`).each(function () {
            selected.push($(this).val());
          });
          if (selected.length > 0) {
            filters[taxonomy] = selected;
          }
        });
      } else if (pageType === 'global-search') {
        const selected = [];
        $('input[name="post_type_filters[]"]:checked').each(function () {
          selected.push($(this).val());
        });
        if (selected.length > 0) {
          filters['post_type'] = selected;
        }
      }
    }

    // Add loading state
    $('.blog-landing__search__results').addClass('loading');

    const data = {
      action: ajaxAction,
      nonce: nonce,
      filters: filters,
      page: parseInt(pageNum) || 1,
      s: searchTerm,
    };

    $.ajax({
      url: $('.blog-landing-apply-filter-btn').data('url'),
      type: 'POST',
      data: data,
      success: function (response) {
        if (response.success) {
          updateURL(data.page);
          $('.blog-landing__search__results__posts').html(response.data.posts);

          const totalPosts = response.data.total_posts;
          const displayedPosts = $(
            '.blog-landing__search__results__posts__post',
          ).length;

          $('.blog-landing__search__search-results-info').html(
            `Displaying <span class="medium">${displayedPosts} of ${totalPosts}</span> Results`,
          );
          $('.blog-landing__pagination').html(response.data.pagination || '');

          $('html, body').animate(
            {
              scrollTop: $('.blog-landing__search__results').offset().top - 100,
            },
            50,
          );

          attachPaginationHandlers();
          updateTaxonomyCount();
        } else {
          $('.blog-landing__search__results__posts').html(
            '<p>No results found.</p>',
          );
          $('.blog-landing__search__search-results-info').html(
            'Displaying 0 of 0 Results',
          );
          $('.blog-landing__pagination').html('');
        }

        if (clear) {
          $('.blog-landing-apply-filter-btn__taxonomy-count').text('');
        }
      },
      error: function (xhr, status, error) {
        console.error('AJAX Error Details:', {
          status: status,
          error: error,
          response: xhr.responseText,
        });
        alert('An error occurred while filtering results. Please try again.');
      },
      complete: function () {
        $('.blog-landing__search__results').removeClass('loading');
      },
    });
  };

  const updateURL = (page) => {
    const baseUrl = window.location.pathname
      .split('/page/')[0]
      .replace(/\/$/, '');

    // Determine search term based on page type
    const searchTerm =
      pageType === 'blog-landing'
        ? $('input[name="blog-landing-search"]').val()
        : $('input[name="s"]').val();

    let newUrl = baseUrl;

    // Add page number if not page 1
    if (page > 1) {
      newUrl += `/page/${page}/`;
    }

    if (searchTerm && pageType !== 'blog-landing') {
      newUrl +=
        (newUrl.includes('?') ? '&' : '?') +
        `s=${encodeURIComponent(searchTerm)}`;
    }

    // Update browser history
    window.history.pushState({ page, searchTerm }, '', newUrl);
  };

  const attachPaginationHandlers = () => {
    $('.page-numbers')
      .off('click')
      .on('click', function (event) {
        event.preventDefault();
        const href = $(this).attr('href');
        let page = 1;

        if ($(this).hasClass('next')) {
          const currentPath = window.location.pathname;
          const currentPage =
            parseInt(currentPath.match(/page\/(\d+)/)?.[1]) || 1;
          page = currentPage + 1;
        } else if ($(this).hasClass('prev')) {
          const currentPath = window.location.pathname;
          const currentPage =
            parseInt(currentPath.match(/page\/(\d+)/)?.[1]) || 1;
          page = Math.max(1, currentPage - 1);
        } else {
          const pageMatch = href.match(/page\/(\d+)/);
          if (pageMatch && pageMatch[1]) {
            page = parseInt(pageMatch[1]);
          }
        }

        handleFilters(false, page);
      });
  };

  // Initialize everything
  updateTaxonomyCount();
  initializeSearchForm();
  initializeTaxonomyToggles();
  attachPaginationHandlers();
  globalSearchFilterToggle();

  // Event listeners
  $('.blog-landing-apply-filter-btn').on('click', function (event) {
    event.preventDefault();
    handleFilters(false, 1);
  });

  $('.blog-landing-clear-filter-btn').on('click', function (event) {
    event.preventDefault();
    handleFilters(true, 1);
  });

  // Handle browser back/forward buttons
  window.addEventListener('popstate', function (event) {
    if (event.state && event.state.page) {
      handleFilters(false, event.state.page);
    }
  });
};

import.meta.webpackHot?.accept(globalSearch);
