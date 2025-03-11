import * as focusTrap from 'focus-trap';
import $ from 'jquery';

export const header = () => {
  /**
   * Stores the toggle elements and mobile menu
   * @type {HTMLAnchorElement[] | []}
   */
  let header,
    searchToggle,
    menuToggle,
    mobileMenu,
    headerTopTrigger,
    scrollPos,
    alertClose,
    mainTrap;

  /**
   * Initialize the component.
   * @uses setupMobile
   * @uses listenToClick
   * @uses listenToScroll
   * @returns void
   */
  const init = () => {
    fixedHeader();
    showMobileMenu();
    toggleMegaMenu();
    langSwitcher();
    adjustSubMenuWidth();
    searchDesktop();

    header = document.querySelector('.header');

    if (header === null) return;

    searchToggle = document.querySelector('.header__search__toggle');
    menuToggle = document.querySelector('.header__toggle');
    mobileMenu = document.querySelector('.header__mobile');
    headerTopTrigger = document.querySelector('.header__top-trigger');
    alertClose = document.querySelector('.alert-bar__close');

    if (
      searchToggle === null ||
      menuToggle === null ||
      mobileMenu === null ||
      headerTopTrigger === null
    )
      return;

    setupMobile();
    listenToClick();
    listenToScroll();
    listenForEscape();
  };

  /**
   * Setup mobile menu with additional buttons and focus trapping
   * @uses mobileMenu
   * @returns void
   */
  const setupMobile = () => {
    // set up focus trap for main navigation menu
    mainTrap = focusTrap.createFocusTrap(header);
    // set up focus traps for inner navigation menus
    const navItems = mobileMenu.querySelectorAll(
      '.header__mobile__primary .navigation__item',
    );
    navItems.forEach((el) => {
      let subnav = el.querySelector('.navigation__subnav');
      if (subnav !== null) {
        // create focus trap to be activated/deactivated later
        const trap = focusTrap.createFocusTrap(subnav, {
          onDeactivate: () => subnav.classList.remove('active'),
        });
        // create button to go to subnavigation
        let btn = document.createElement('button');
        const label = el.querySelector('a').innerHTML;
        btn.setAttribute('aria-label', 'Go to inner navigation for ' + label);
        btn.innerHTML = '<i class="fa fa-chevron-right"></i>';
        btn.addEventListener('click', () => {
          subnav.classList.add('active');
          setTimeout(function () {
            subnav.querySelectorAll('a')[0].focus();
            trap.activate();
          }, 100);
        });
        el.append(btn);
        // create button to exit subnavigation
        let back_btn = document.createElement('button');
        back_btn.setAttribute('aria-label', 'Go back to main menu');
        back_btn.innerHTML =
          '<i class="fa fa-chevron-left"></i> <span>' + label + '</span>';
        back_btn.addEventListener('click', () => {
          subnav.classList.remove('active');
          trap.deactivate();
        });
        subnav.prepend(back_btn);
      }
    });
  };

  /**
   * Setup click event listeners
   * @uses searchToggle, menuToggle
   * @returns void
   */
  const listenToClick = () => {
    searchToggle.addEventListener('click', handleEventSearch);
    menuToggle.addEventListener('click', handleEventMenu);
    if (alertClose !== null) {
      alertClose.addEventListener('click', handleAlertClose);
    }
  };

  /**
   * Setup scroll event listeners
   * @returns void
   */
  const listenToScroll = () => {
    scrollPos = window.scrollY;
    document.addEventListener('scroll', handlePageScroll);
  };

  /**
   * Handle the search toggle event
   */
  const handleEventSearch = () => {
    if (searchToggle.parentNode.classList.contains('active')) {
      searchToggle.parentNode.classList.remove('active');
      searchToggle.setAttribute('aria-label', 'Open Search');
      searchToggle.setAttribute('aria-expanded', 'false');
      return;
    }

    searchToggle.parentNode.classList.add('active');
    searchToggle.setAttribute('aria-label', 'Close Search');
    searchToggle.setAttribute('aria-expanded', 'true');
    // focus search input
    setTimeout(function () {
      searchToggle.parentNode.querySelector('input').focus();
    }, 100);
    // deactivate mobile menu if active
    menuToggle.classList.remove('active');
    mobileMenu.classList.remove('active');
  };

  /**
   * Handle the menu toggle event
   */
  const handleEventMenu = () => {
    if (menuToggle.classList.contains('active')) {
      menuToggle.classList.remove('active');
      menuToggle.setAttribute('aria-label', 'Open Menu');
      menuToggle.setAttribute('aria-expanded', 'false');
      mobileMenu.classList.remove('active');
      mainTrap.deactivate();
      return;
    }

    menuToggle.classList.add('active');
    menuToggle.setAttribute('aria-label', 'Close Menu');
    menuToggle.setAttribute('aria-expanded', 'true');
    mobileMenu.classList.add('active');
    // focus first menu item
    setTimeout(function () {
      mobileMenu.querySelectorAll('a')[0].focus();
      mainTrap.activate();
    }, 100);
    // deactivate search if active
    searchToggle.parentNode.classList.remove('active');
  };

  /**
   * Handle closing the menu with escape
   */
  const listenForEscape = () => {
    document.addEventListener('keyup', (e) => {
      // 'Esc' covers an Edge bug that was carried over from the IE days
      if (e.key === 'Escape' || e.key === 'Esc') {
        if (menuToggle.classList.contains('active')) {
          handleEventMenu();
        }

        if (searchToggle.parentNode.classList.contains('active')) {
          handleEventSearch();
        }
      }
    });
  };

  /**
   * Handle closing the alert bar
   */
  const handleAlertClose = () => {
    const alert = $('.alert-bar');
    document.cookie = `${alert[0].id}=true; path=/`;
    alert.slideUp();
  };

  /**
   * Handle clipping the header to the body and hiding/showing the header on page scroll
   */
  const handlePageScroll = () => {
    const currPos = window.scrollY;
    const headerTopTriggerPos = headerTopTrigger.offsetTop;

    // add fixed class if window is now at or past the top of the header
    header.classList.toggle('fixed', currPos >= headerTopTriggerPos);

    if (currPos != scrollPos) {
      // scroll has changed
      // determine direction
      const scrolledDown = currPos > scrollPos;
      const mobileItemsOpen =
        document.querySelector('.header__search.active') !== null ||
        document.querySelector('.header__toggle.active') !== null;
      const shouldTuck = scrolledDown && !mobileItemsOpen && currPos > 300;

      header.classList.toggle('tuck', shouldTuck);
    }

    scrollPos = currPos;
  };

  const fixedHeader = () => {
    const headerBottom = $('.header__bottom');
    const headerTopHeight = $('.header__top').outerHeight();

    const updateHeaderOnScroll = () => {
      if ($(window).width() > 1024) {
        $(window).on('scroll', function () {
          if ($(this).scrollTop() >= headerTopHeight) {
            headerBottom.addClass('fixed');
            $('main').css('padding-top', headerBottom.outerHeight() + 'px');
          } else {
            headerBottom.removeClass('fixed');
            $('main').css('padding-top', '0');
          }
        });
      } else {
        headerBottom.removeClass('fixed');
        $('main').css('padding-top', '0');
        $(window).off('scroll');
      }
    };

    updateHeaderOnScroll();

    $(window).on('resize', function () {
      if ($(window).width() <= 1024) {
        $('main').css('padding-top', '0');
      }
      updateHeaderOnScroll();
    });
  };

  const langSwitcher = () => {
    $('.wpml-ls ul').each(function () {
      $(this)
        .find('li')
        .each(function (index) {
          const lang = $(this).find('.wpml-ls-native');
          $(this).find('.wpml-ls-display').css('display', 'none');

          const langCode = lang.attr('lang') || 'en';
          let fullName;

          if (langCode === 'en') fullName = 'EN';
          else if (langCode === 'fr') fullName = 'FR';

          if (fullName) {
            lang.text(fullName);
          }

          if (index === 0) {
            $(this).after('<span> / </span>');
          }
        });
    });
  };

  const showMobileMenu = () => {
    const hamburger = $('.header__toggle');
    const navMenu = $('.header__bottom__container__mobile');

    hamburger.on('click', function () {
      navMenu.slideToggle();
      $(this).toggleClass('active');
    });
  };

  const toggleMegaMenu = () => {
    const navItemMobile = $('.header__bottom__container__mobile').find(
      '.header__bottom__nav-menu__nav-item',
    );
    const navItemDesktop = $('.header__bottom__container').find(
      '.header__bottom__nav-menu__nav-item',
    );

    navItemMobile.on('click', function (e) {
      navItemMobile.not(this).removeClass('submenu-mobile-active');
      $(this).toggleClass('submenu-mobile-active');

      $(document).on('click keydown', function (e) {
        if (
          (e.type === 'keydown' && e.key === 'Escape') ||
          (e.type === 'click' && !$(e.target).closest(navItemMobile).length)
        ) {
          navItemMobile.removeClass('submenu-mobile-active');
        }
      });
    });

    navItemDesktop.on('click', function (e) {
      navItemDesktop.not(this).removeClass('submenu-active');
      navItemDesktop.find('.fa-chevron-down').removeClass('active');

      $(this).toggleClass('submenu-active');
      const chevronDown = $(this).find('.fa-chevron-down');
      chevronDown.toggleClass('active');

      if ($(this).hasClass('submenu-active')) {
        $(this).find('.header__bottom__nav-menu__nav-item__container').css({
          backgroundColor: 'transparent',
          borderColor: 'transparent',
        });
      }

      $(document).on('click keydown', function (e) {
        if (
          (e.type === 'keydown' && e.key === 'Escape') ||
          (e.type === 'click' && !$(e.target).closest(navItemDesktop).length)
        ) {
          navItemDesktop.removeClass('submenu-active');
          chevronDown.removeClass('active');
        }
      });
    });
  };

  const adjustSubMenuWidth = () => {
    $('.submenu-desktop').each(function () {
      const submenu = $(this);
      const submenuGroups = submenu.find('.submenu__group');
      const groupCount = submenuGroups.length;
      // If there are zero groups, hide the submenu
      if (groupCount === 0) {
        submenu.css('display', 'none');
        return;
      } else {
        submenu.css('display', '');
      }
      // Adjust width based on the number of groups
      let width;
      let shouldPositionRelative = false;
      if (groupCount === 1) {
        width = '384px';
        shouldPositionRelative = true;
      } else if (groupCount === 2 || groupCount === 3) {
        width = groupCount === 2 ? '500px' : '1022px';
        shouldPositionRelative = true;
      } else if (groupCount >= 4) {
        width = '100%';
      }
      // Apply the calculated width to the submenu
      submenu.css('width', width);
      // If there is only one submenu group, make the nav-item relative
      const navItem = submenu.closest('.header__bottom__nav-menu__nav-item');
      if (shouldPositionRelative) {
        navItem.css('position', 'relative'); // Set position to relative
      } else {
        navItem.css('position', ''); // Reset position if more than 1 group
      }
    });
  };

  // Hide mobile menu on large screens
  $(window).on('resize', function () {
    const mobileNav = $('.header__bottom__container__mobile');
    const hamburger = $('.header__toggle');

    if ($(window).width() > 1050) {
      mobileNav.css('display', 'none');
      hamburger.removeClass('active');
    }
  });

  // Submit search form on icon click
  $('.search-icon').on('click', function () {
    $('form').trigger('submit');
  });

  const searchDesktop = () => {
    const searchInput = $('#searchBox');
    const searchContainer = $('.header__bottom__container__search');
    const searchIcon = $('.search-icon-desktop');
    const closeIcon = $('.close-icon-desktop');

    // Handle focus event
    searchInput.on('focus', function () {
      searchIcon.css({
        right: 'unset',
        left: '10px',
        transition: 'left 0.3s ease',
      });
      closeIcon.css('display', 'block');
      searchInput.css('border-radius', '12px');
      searchInput.css('color', 'var(--neutral--700)');
    });

    // Handle blur event
    searchInput.on('blur', function () {
      searchIcon.css({
        left: 'unset',
        right: '15px',
        transition: 'right 0.3s ease',
      });
      closeIcon.css('display', 'none');
      searchInput.css('border-radius', '100%');
      searchInput.css('color', 'transparent');
    });

    // Handle mousedown on the search icon to focus the input
    searchIcon.on('mousedown', function (e) {
      e.preventDefault();
      searchInput.trigger('focus');
    });

    // Handle mousedown on the close icon
    closeIcon.on('mousedown', function (e) {
      searchInput.val('');
      setTimeout(function () {
        searchInput.trigger('focus');
      }, 0);
    });
  };

  return init();
};

import.meta.webpackHot?.accept(header);
