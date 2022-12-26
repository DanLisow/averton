<footer class="footer">
    <div class="container-header">
        <div class="footer__inner">
            <div class="footer__logo">
                <a href="<?php bloginfo('url'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-white.svg" alt="">
                </a>
            </div>
            <div class="footer__menu">
                <div class="footer__item">
                    <a href="<?php bloginfo('url'); ?>">Каталог</a>
                </div>
                <div class="footer__item">
                    <a href="<?php bloginfo('url'); ?>/#about">О сервисе</a>
                </div>
                <div class="footer__item">
                    <a href="#">Политика конфиденциальности</a>
                </div>
            </div>
            <div class="footer__contact">
                <div class="footer__contact-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/contact.svg" alt="">
                </div>
                <div class="footer__contact-text">
                    <a href="tel:<?php echo trim(get_option('phone'));?>"><?php echo get_option('phone'); ?></a>
                    <p>Телефон горячей линии по РФ</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal" id="modal">
    <div class="modal__content">
        <div class="modal__body" enctype="multipart/form-data">
            <div class="modal__title">
                <h1>Оставить отзыв</h1>
            </div>
            <div class="modal__block">
                <form class="modal__form">
                    <div class="modal__form-add">
                        <?php
                        $gender = get_field('gender', get_category(get_the_category(get_queried_object_id())[0]));
                        $age = get_field('age', get_category(get_the_category(get_queried_object_id())[0]));
                        $city = get_field('city', get_category(get_the_category(get_queried_object_id())[0]));
                        
                        if($gender):
                        ?>
                        <div class="modal__form-add__input">
                            <p>Пол</p>
                            <div class="modal__form-add__input-item">
                                <div class="modal__form-add__input-item__radio">
                                    <input type="radio" name="gender" id="male" value="Мужской">
                                    <label for="male">Мужской</label>
                                </div>
                                <div class="modal__form-add__input-item__radio">
                                    <input type="radio" name="gender" id="female" value="Женский">
                                    <label for="female">Женский</label>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($age): ?>
                        <div class="modal__form-add__input">
                            <p>Возраст</p>
                            <div class="modal__form-add__input-item">
                                <input type="number" name="age" id="age">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($city): ?>
                        <div class="modal__form-add__input">
                            <p>Город</p>
                            <div class="modal__form-add__input-item">
                                <input type="text" name="city" id="city">
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal__form-input">
                        <label><?php echo get_option('modal_name'); ?></label>
                        <input type="text" maxlength="20" name="author" placeholder="Ваше имя">
                    </div>
                    <div class="modal__form-input">
                        <label><?php echo get_option('modal_text'); ?></label>
                        <textarea name="comment" placeholder="Ваш комментарий..."></textarea>
                    </div>
                    <div class="modal__form-download">
                        <input type="file" name="file_upload_1" id="file_upload_1" multiple="false" class="file">
                        <label for="file_upload_1">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/download.svg">
                            <span>Прикрепить фото</span>
                        </label>
                    </div>
                    <input type="hidden" name="comment_post_ID" value="<?php echo get_queried_object_id(); ?>">
                    <input type="hidden" name="email" value="<?php echo get_option('admin_email'); ?>">
                    <input type="hidden" name="date" value="<?php echo current_time('d.m.Y');?>">
                    <input type="hidden" name="link" value="<?php echo get_permalink(get_queried_object_id()); ?>">
                </form>
                <div class="modal__rate">
                    <div class="modal__rate-items">
                        <?php
                        $rows = get_field('rate', get_category(get_the_category(get_queried_object_id())[0]));
                        if($rows)
                        {
                            foreach($rows as $row)
                            { ?>

                        <div class="modal__rate-item">
                            <p><?php echo $row['rate_item']; ?>:</p>
                            <div class="modal__rate-item__stars" data-total-value="0"
                                data-name="<?php echo $row['rate_item']; ?>">
                                <svg data-item-value="5" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                                        fill="#DFE2E4" />
                                </svg>
                                <svg data-item-value="4" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                                        fill="#DFE2E4" />
                                </svg>
                                <svg data-item-value="3" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                                        fill="#DFE2E4" />
                                </svg>
                                <svg data-item-value="2" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                                        fill="#DFE2E4" />
                                </svg>
                                <svg data-item-value="1" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                                        fill="#DFE2E4" />
                                </svg>
                            </div>
                        </div>
                        <?php }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal__button">
                <button class="submit">Оставить отзыв</button>
            </div>
            <div class="modal__body-result">
            </div>
        </div>
    </div>
    <div class="modal__success">
        <div class="modal__img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/modal-surprise.svg" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/modal-gift.svg" alt="">
        </div>
        <div class="modal__text">
            <div class="modal__text-block">
                <?php $bg = get_field('background'); ?>
                <div class="modal__text-title">
                    <h1>Спасибо за отзыв!</h1>
                    <?php if($bg): ?>
                    <p><?php echo get_option('modal_gift'); ?></p>
                    <?php endif; ?>
                </div>
                <div class="modal__text-links">
                    <?php if($bg): ?>
                    <a href="<?php echo $bg['url']; ?>" download>Получить приз</a>
                    <?php else: ?>
                    <a href="" class="close">Закрыть окно</a>
                    <?php endif; ?>
                    <!-- <a href="#">Смотреть цензурную версию</a>
                    <a href="#">Смотреть версию без цензуры (18+)</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal mobile" id="modal-mobile">
    <div class="container">
        <div class="modal__inner">
            <div class="modal__head">
                <div class="modal__head-title">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="">
                </div>
                <div class="modal__head-step">
                    <div class="modal__head-step__item active" id="step-first">
                        <p>1</p>
                        <p>Оценка</p>
                    </div>
                    <div class="modal__head-step__item" id="step-second">
                        <p>2</p>
                        <p>Комментарий</p>
                    </div>
                    <div class="modal__head-step__item" id="step-third">
                        <p>3</p>
                        <p>Сюрприз</p>
                    </div>
                </div>
            </div>
            <form class="modal__box modal__form" enctype="multipart/form-data">
                <div class="modal__box-item first" id="first">
                    <div class="modal__form-add">
                        <?php
                        if($gender):
                        ?>
                        <div class="modal__form-add__input">
                            <p>Пол</p>
                            <div class="modal__form-add__input-item">
                                <div class="modal__form-add__input-item__radio">
                                    <input type="radio" name="gender" id="male1" value="Мужской">
                                    <label for="male1">Мужской</label>
                                </div>
                                <div class="modal__form-add__input-item__radio">
                                    <input type="radio" name="gender" id="female1" value="Женский">
                                    <label for="female1">Женский</label>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($age): ?>
                        <div class="modal__form-add__input">
                            <p>Возраст</p>
                            <div class="modal__form-add__input-item">
                                <input type="number" name="age" id="age">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($city): ?>
                        <div class="modal__form-add__input">
                            <p>Город</p>
                            <div class="modal__form-add__input-item">
                                <input type="text" name="city" id="city">
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal__box-item__input">
                        <label><?php echo get_option('modal_name'); ?></label>
                        <input type="text" maxlength="20" name="author" placeholder="Ваше имя">
                    </div>
                    <div class="modal__box-rate">
                        <div class="modal__rate">
                            <div class="modal__rate-items">
                                <?php 
                                if($rows){
                                    foreach($rows as $row) { ?>

                                <div class="modal__rate-item">
                                    <p><?php echo $row['rate_item'] ?>:</p>
                                    <div class="modal__rate-item__stars" data-name="<?php echo $row['rate_item']; ?>"
                                        data-total-value="0">
                                        <svg data-item-value="5" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                                                fill="#DFE2E4" />
                                        </svg>
                                        <svg data-item-value="4" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                                                fill="#DFE2E4" />
                                        </svg>
                                        <svg data-item-value="3" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                                                fill="#DFE2E4" />
                                        </svg>
                                        <svg data-item-value="2" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                                                fill="#DFE2E4" />
                                        </svg>
                                        <svg data-item-value="1" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                                                fill="#DFE2E4" />
                                        </svg>
                                    </div>
                                </div>
                                <?php }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="modal__box-rate__result">
                            <p>Оцените хотя бы один критерий!</p>
                        </div>
                    </div>
                    <div class="modal__box-button">
                        <button id="modal-first-cancel">Отменить</button>
                        <button id="modal-first">Далее</button>
                    </div>
                </div>
                <div class="modal__box-item second" id="second">
                    <div class="modal__box-item__input">
                        <label><?php echo get_option('modal_text'); ?></label>
                        <textarea name="comment" placeholder="Ваш комментарий..."></textarea>
                    </div>
                    <div class="modal__box-item__download">
                        <input name="file_upload_2" type="file" id="file_upload_2" multiple="false" class="file">
                        <label for="file_upload_2">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/download-mobile.svg">
                            <span>Прикрепить фото</span>
                        </label>
                    </div>
                    <div class="modal__box-button">
                        <button id="modal-second-cancel">Отменить</button>
                        <button id="modal-second" class="submit">Отправить</button>
                        <p>Выберите только один файл, размер которого не превышает 5 МБ</p>
                    </div>
                </div>
                <div class="modal__box-item third" id="third">
                    <div class="modal__box-gift">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gift.svg" alt="">
                        <h2>Спасибо за отзыв!</h2>
                        <?php if($bg): ?>
                        <p><?php echo get_option('modal_gift'); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="modal__box-links">
                        <?php if($bg): ?>
                        <a href="<?php echo $bg['url']; ?>" download>Получить приз</a>
                        <?php else: ?>
                        <a href="" class="close">Закрыть окно</a>
                        <?php endif; ?>
                        <!-- <a href="#">Смотреть цензурную версию</a>
                        <a href="#">Смотреть версию без цензуры (18+)</a> -->
                    </div>
                </div>
                <input type="hidden" name="comment_post_ID" value="<?php echo get_queried_object_id(); ?>">
                <input type="hidden" name="email" value="<?php echo get_option('admin_email'); ?>">
                <input type="hidden" name="date" value="<?php echo current_time('d.m.Y');?>">
                <input type="hidden" name="link" value="<?php echo get_permalink(get_queried_object_id()); ?>">
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-comment">
    <div class="modal__content">
        <div class="modal__body">
            <div class="modal__title">
                <h1>Оставьте комментарий</h1>
            </div>
            <form class="modal__addition">
                <textarea name="addition" placeholder="Комментарий"></textarea>
                <button type="submit" class="addition-submit">Отправить</button>
            </form>
            <div class="modal__body-add">
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

<script>
var $ = jQuery.noConflict();
$('[data-fancybox]').fancybox({
    touch: false,
    autoFocus: false
});
</script>

</body>

</html>