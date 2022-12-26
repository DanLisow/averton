const counts = document.querySelectorAll('.category__item-text > p');
const reviews = document.querySelectorAll('.single__rate-title > p');
const str1 = 'товар';
const str2 = 'оцен';


function setCount(array, str, resGoods = null, resReviews = null) {
    array.forEach(item => {
        const count = Number(item.dataset.count);
        const n = count % 10;
        const m = count % 100;

        if (m === 1 || n === 1) {
            resGoods = '';
            resReviews = 'ка'
        }
        else if (m >= 11 && m <= 20) {
            resGoods = 'ов';
            resReviews = 'ок';
        }
        else if (n >= 2 && n <= 4) {
            resGoods = 'а';
            resReviews = 'ки';
        }
        else if ((n >= 5 && n <= 9) || n === 0) {
            resGoods = 'ов';
            resReviews = 'ок';
        }


        if (item.hasAttribute("data-review")) {
            item.textContent = `(${String(count)} ${str}${resReviews})`;
        }
        else {
            item.textContent = `${String(count)} ${str}${resGoods}`;
        }
    });

    return;
}

setCount(counts, str1);
setCount(reviews, str2);