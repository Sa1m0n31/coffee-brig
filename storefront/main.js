const productsSlider = new Siema({
    selector: '.productsSlider',
    duration: 400,
    easing: 'ease-out',
    perPage: {
        100: 1,
        768: 2,
        996: 3,
        1200: 4
    },
    startIndex: 0,
    threshold: 20,
    loop: true,
    draggable: false
});
const productsSliderIndicator = document.querySelector('.productsSliderLine__line__indicator');
const numberOfProducts = 16;

const getCurrentSlide = () => {
    const currentSlide = productsSlider.currentSlide;

    if(currentSlide >= 0) {
        return currentSlide;
    }
    else {
        return (numberOfProducts - 4) + (-1 * (-4 - currentSlide));
    }
}

const getProductsSliderIndicatorPosition = () => {
    if(numberOfProducts) {
        const currentSlide = getCurrentSlide();
        const left = currentSlide / (numberOfProducts - 1);

        return 75 * left;
    }
    else {
        return '';
    }
}

const changeIndicatorPosition = () => {
    productsSliderIndicator.style.left = `${getProductsSliderIndicatorPosition()}%`;
}

const productsPrevSlide = () => {
    productsSlider.prev();
    changeIndicatorPosition();
}

const productsNextSlide = () => {
    productsSlider.next();
    changeIndicatorPosition();
}

const historySlider = new Siema({
    selector: '.historySlider',
    duration: 400,
    easing: 'ease-out',
    perPage: {
        100: 2,
        768: 4,
        996: 6,
        1400: 8
    },
    startIndex: 0,
    threshold: 20,
    loop: false,
    draggable: true
});

const historyPrevSlide = () => {
    historySlider.prev();
}

const historyNextSlide = () => {
    historySlider.next();
}

const mobileMenu = document.querySelector('.mobileMenu');
const mobileMenuChildren = Array.from(document.querySelectorAll('.mobileMenu>*'));

const openMenu = () => {
    mobileMenu.style.transform = 'scaleX(1)';
    setTimeout(() => {
        mobileMenuChildren.forEach((item) => {
            item.style.opacity = '1';
        });
    }, 200);
}

const closeMenu = () => {
    mobileMenuChildren.forEach((item) => {
        item.style.opacity = '0';
    });

    setTimeout(() => {
        mobileMenu.style.transform = 'scaleX(0)';
    }, 200);
}
