let ratingList = document.querySelectorAll('.modal__rate-item__stars svg');
let ratingArray = Array.prototype.slice.call(ratingList);

ratingArray.forEach(item => {
    item.addEventListener('click', () => {
        const { itemValue } = item.dataset;
        item.parentNode.dataset.totalValue = itemValue;
    });
});

let firstNext = document.getElementById('modal-first'),
    firstStep = document.getElementById('step-first'),
    firstElem = document.getElementById('first'),
    stars = Array.prototype.slice.call(firstElem.querySelectorAll('.modal__rate-item__stars')),
    author = firstElem.querySelector('input[name=author]'),
    text = firstElem.querySelector('textarea[name=comment]'),
    secondNext = document.getElementById('modal-second'),
    secondCancel = document.getElementById('modal-second-cancel'),
    secondStep = document.getElementById('step-second'),
    secondElem = document.getElementById('second'),
    thirdElem = document.getElementById('third'),
    starResult = firstElem.querySelector('.modal__box-rate__result'),
    rateSum = 0;

firstNext.addEventListener('click', (event) => {
    event.preventDefault();

    let stars = Array.prototype.slice.call(firstElem.querySelectorAll('.modal__rate-item__stars'));

    for (let index = 0; index < stars.length; index++) {
        rateSum += +stars[index].dataset.totalValue;
    }

    if (author.value != '') {
        author.classList.remove('warn');
        if (rateSum !== 0) {
            secondElem.classList.add('active');
            firstStep.classList.remove('active');
            secondStep.classList.add('active');
            starResult.classList.remove('active');
            firstElem.style.opacity = '0';
        }
        else {
            starResult.classList.add('active');
        }
    }
    else {
        author.classList.add('warn');
    }


});

secondCancel.addEventListener('click', (event) => {
    event.preventDefault();
    secondElem.classList.remove('active');
    firstStep.classList.add('active');
    secondStep.classList.remove('active');
    firstElem.style.opacity = '1';
});

let input = document.querySelectorAll('.file');
let inputArray = Array.prototype.slice.call(input);

inputArray.forEach(item => {
    let label = item.nextElementSibling;

    item.addEventListener('change', function (e) {
        let str = item.value.split('\\');
        label.querySelector('span').innerText = str[str.length - 1];
    });
});

let burger = document.querySelector('.header__burger');
let headerItem = document.querySelectorAll('.header__item a');

burger.addEventListener('click', () => {
    document.querySelector('.header__menu').classList.toggle('active');
    document.body.classList.toggle('lock');
});

headerItem.forEach((item) => {
    item.addEventListener('click', () => {
        document.querySelector('.header__menu').classList.remove('active');
        document.body.classList.remove('lock');
    });
});


const search = document.getElementById('search');
const windowWidth = window.screen.width || window.innerWidth;

if (windowWidth < 840 && window.location.href !== 'https://feedback.com.ru/') {
    search.style.display = 'none';
}
