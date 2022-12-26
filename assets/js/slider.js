let galleryThumbs = new Swiper('.gallery-thumbs', {
    spaceBetween: 15,
    slidesPerView: 3,
    speed: 500,
    watchSlidesProgress: true,
});
let galleryTop = new Swiper('.gallery-top', {
    spaceBetween: 15,
    speed: 500,
    loop: true,
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    navigation: {
        nextEl: 'button.single__img-main__next',
        prevEl: 'button.single__img-main__prev',
    },
    thumbs: {
        swiper: galleryThumbs,
    },
});