$(document).ready(function () {


    $('.submit').click(function (e) {

        e.preventDefault();

        let rateArray = [];
        let rateSum = 0;
        let button = $(this);
        let modal = button.parents('.modal');
        let form = modal.find('.modal__form');
        let close = modal.find('.close');
        let text = form.find('textarea[name=comment]').val();
        let testAdd = form.find('textarea[name=comment]').val();
        let stars = modal.find('.modal__rate-item__stars');
        let name = form.find('input[name=author]').val();
        let minCount = 0;

        let starsArray = Array.prototype.slice.call(stars);

        for (let index = 0; index < starsArray.length; index++) {
            let value = +starsArray[index].dataset.totalValue
            if ((value <= 3 && value > 0) && (text === undefined || text === '')) {
                minCount = value;
            }
            rateArray.push([starsArray[index].dataset.name, starsArray[index].dataset.totalValue]);
            rateSum += value;
        }

        let formData = new FormData(form[0]);

        if (text == '' && minCount == 0) {
            formData.set('comment', 'empty');
        }

        if (minCount != 0) {
            if (name != '') {
                additionalComment();

                form.find('input[name=author]').removeClass('warn');

                $('.addition-submit').click(function (e) {
                    e.preventDefault();

                    let text = $(this).prev().val();
                    if (text != '') {

                        console.log(text);

                        formData.set('comment', text);

                        $.fancybox.close({
                            src: $("#modal-comment")
                        });

                        mainSend(form, formData, rateSum, rateArray, minCount);
                    }
                    else {
                        $('.modal__body-add').html('<p>Оставьте, пожалуйста, комменатрий</p>');
                        $('.modal__body-add').addClass('active');

                        setTimeout(() => {
                            $('.modal__body-add').removeClass('active');
                        }, 4000);
                    }

                    return;
                });
            }
            else {
                form.find('input[name=author]').addClass('warn');

                return;
            }

            return;
        }
        else {
            mainSend(form, formData, rateSum, rateArray, minCount);

            return;
        }


        return;
    });

    // $(document).on('keydown', function (e) {
    //     if (e.which == 13) {
    //         sendComment(submitButton);
    //     }
    //     return;
    // });

    $('.admin button').click(function () {
        let id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: ajax.ajax_url,
            data: {
                id: id,
                action: 'delete'
            },
            success: function (data) {
                alert(data)
            }
        });

        return false;
    });

    showComments();
});


function mainSend(form, formData, rateSum, rateArray, minCount) {
    let id = form.find('input[name=comment_post_ID]').val();
    let thirdElem = $('#third');
    let secondStep = $('#step-second');
    let thirdStep = $('#step-third');
    let name = form.find('input[name=author]').val();
    let link = form.find('input[name=link]').val();
    let date = form.find('input[name=date]').val();
    let file = form.find('input[type=file]');
    let gender = form.find('input[name="gender"]').val();
    let age = form.find('input[name="age"]').val();
    let city = form.find('input[name="city"]').val();

    if (file[0].files[0]) {
        if (file[0].files.length > 1 || file[0].files[0].size > 5242880) {
            if ($(window).width() < 841) {
                $('.modal__box-button p').addClass('active');
            }
            else {
                $('.modal__body-result').html('<p>Выберите только один файл, размер которого не превышает 5 МБ</p>');
                $('.modal__body-result').addClass('active');
            }
            return;
        }
        $('.modal__body-result').removeClass('active');
        formData.append('file', file[0].files[0]);
        console.log(file[0].files);
    }

    formData.append('date', date);
    formData.append('link', link);
    formData.append('title', $('body h1')[0].textContent);
    formData.append('total', rateArray);
    formData.append('action', 'sendcomment');


    if (gender) formData.append('gender', gender);
    if (age) formData.append('age', age);
    if (city) formData.append('city', city);


    if (name !== undefined && name !== '') {
        if (rateSum !== 0) {
            $.ajax({
                type: 'POST',
                url: ajax.ajax_url,
                contentType: false,
                processData: false,
                data: formData,
                error: function () {
                    alert("Произошла ошибка при отправке. Попробуйте еще раз");
                },
                beforeSend: function () {
                    $('.submit').html('Отправляю...');
                    if (minCount == 0) {
                        $('html').css({ 'pointer-events': 'none' });
                    }
                    form.find('input[name=author]').removeClass('warn');
                    $('.modal__body-result').removeClass('active');
                    $('.modal__body-add').removeClass('active');
                },
                success: function (comment) {
                    setTimeout(() => {

                        if (thirdElem) {
                            thirdElem.addClass('active');
                            secondStep.removeClass('active');
                            thirdStep.addClass('active');
                        }

                        form.trigger('reset');

                        $('.modal__success').addClass('active');

                        $('html').css({ 'pointer-events': 'all' });

                        $(document).mouseup(function (e) {
                            let button = $(".fancybox-button");
                            let container = $('.modal.fancybox-content');
                            console.log(e);
                            if (container.has(e.target).length === 0 || button.has(e.target).length > 0 || close.has(e.target).length > 0) {
                                location.reload();
                            }
                        });
                    }, 4000);
                }

            });

            $.ajax({
                type: 'POST',
                url: ajax.ajax_url,
                data: {
                    id: id,
                    array: rateArray,
                    action: 'rate'
                }
            });
        }
        else {
            $('.modal__body-result').html('<p>Оцените хотя бы один критерий!</p>');
            $('.modal__body-result').addClass('active');
            return;
        }
    }
    else {
        form.find('input[name=author]').addClass('warn');
        return;
    }
}



function showComments() {
    let comments = $('.single__review-item');
    let button = $('.single__review-button button');
    let hideArray = [];
    let showPerClick = 30;

    if (comments && comments.length > 30) {

        comments.each(function (index) {
            if (index > 29) {
                $(this).hide();
                hideArray.push($(this));
            }
        });

        button.click(function (e) {
            e.preventDefault();
            for (let i = 0; i < showPerClick; i++) {
                if (!hideArray[i]) return this.outerHTML = "";

                hideArray[i].slideDown();
            }
            hideArray.splice(0, 30);
        });
    }
    else {
        button.css({ 'display': 'none' });
    }
}


function additionalComment() {
    $.fancybox.open({
        src: $("#modal-comment"),
        type: 'inline',
        clickSlide: false,
        touch: false
    });
}