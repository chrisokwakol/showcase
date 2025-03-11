import $ from 'jquery';
import Swiper from 'swiper';
import { Navigation, Pagination, A11y } from 'swiper/modules';

export const logoGrid = () => {
  const logoGrids = $('.logo-grid');

  if (logoGrids.length) {
    logoGrids.each((index, block) => {
      const swiperEl = block.querySelector('.swiper');
      new Swiper(swiperEl, {
        modules: [Navigation, Pagination, A11y],
        navigation: {
          nextEl: block.querySelector('.swiper-button-next'),
          prevEl: block.querySelector('.swiper-button-prev'),
        },
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true,
        },
        a11y: true,
        centerInsufficientSlides: true,
        slidesPerView: 2,
        centeredSlides: true,
        spaceBetween: 20,
        breakpoints: {
          450: {
            slidesPerView: 2.5,
            centeredSlides: false,
          },
          576: {
            slidesPerView: 3.5,
            centeredSlides: false,
          },
          768: {
            slidesPerView: 4,
            centeredSlides: false,
          },
          992: {
            slidesPerView: 5,
            centeredSlides: false,
          },
        },
      });
    });
  }
};

import.meta.webpackHot?.accept(logoGrid);
