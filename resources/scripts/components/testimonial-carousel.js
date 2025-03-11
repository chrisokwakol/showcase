import $ from 'jquery';
import Swiper from 'swiper';
import { Navigation, Pagination, A11y } from 'swiper/modules';

export const testimonialCarousel = () => {
  const container = $('.testimonial-carousel-container');

  if (container.length) {
    container.each((index, block) => {
      const swiperEl = block.querySelector('.swiper');

      const swiper = new Swiper(swiperEl, {
        modules: [Navigation, Pagination, A11y],
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        a11y: true,
        centerInsufficientSlides: true,
        slidesPerView: 1,
        centeredSlides: true,
        spaceBetween: 20,
      });

      // Function to update pagination dynamically
      const updatePagination = () => {
        const activeSlide = swiper.realIndex + 1;
        const totalSlides = swiper.slides.length;

        // Find the pagination element for the active slide
        const paginationEl =
          swiper.slides[swiper.activeIndex].querySelector('.swiper-pagination');

        if (paginationEl) {
          // Dynamically update the pagination content
          paginationEl.innerHTML = `<span class="current">${activeSlide}</span> / <span class="total">${totalSlides}</span>`;
        }
      };

      // Initialize pagination on load
      updatePagination();

      // Update pagination on slide change
      swiper.on('slideChange', () => {
        updatePagination();
      });
    });
  }
};

import.meta.webpackHot?.accept(testimonialCarousel);
