jQuery(function ($) {

    $('.csv-button').click(function (e) {
        e.preventDefault();

        let button = $(this);

        $.ajax({
            type: 'GET',
            url: ajaxurl,
            data: '&action=file',
            beforeSend: function () {
                button.html('Загрузка...');
                button.parent().find('a').remove();
            },
            success: function (data) {
                setTimeout(() => {
                    button.html('Сформировать CSV файл');
                    button.after(
                        `<a href="${data}" target="_blank" style="font-size: 16px;">file.csv</a>`
                    );
                }, 2000);
            }
        });
    });

});