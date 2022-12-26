<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/fav.svg" type="image/x-icon">
    <?php wp_head(); ?>
</head>

<body>

    <header class="header">
        <div class="container-header">
            <div class="header__inner">
                <div class="header__logo">
                    <a href="<?php bloginfo('url'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="">
                    </a>
                </div>
                <div class="header__burger">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/burger.svg" alt="">
                </div>
                <div class="header__menu">
                    <div class="header__item">
                        <a href="<?php bloginfo('url'); ?>">Каталог</a>
                    </div>
                    <div class="header__item">
                        <a href="<?php bloginfo('url'); ?>/#about">О сервисе</a>
                    </div>
                    <div class="header__contact-mobile">
                        <div class="header__contact-img">
                            <a href="tel:<?php echo trim(get_option('phone'));?>">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.18123 1.62615L5.89896 1.39682C6.5715 1.18192 7.29007 1.52922 7.57808 2.20838L8.15124 3.55994C8.40101 4.14891 8.26241 4.84151 7.80859 5.27226L6.54571 6.47094C6.62363 7.18792 6.86464 7.89392 7.26873 8.58893C7.67282 9.28394 8.1775 9.86048 8.78277 10.3185L10.2996 9.81274C10.8745 9.62102 11.5006 9.84135 11.8533 10.3595L12.6749 11.5665C13.0848 12.1688 13.0111 12.9997 12.5024 13.5104L11.9573 14.0576C11.4146 14.6024 10.6396 14.8 9.92268 14.5763C8.23011 14.0484 6.6739 12.4809 5.25405 9.87393C3.83214 7.26315 3.3303 5.04809 3.74855 3.22875C3.92455 2.46321 4.46956 1.85356 5.18123 1.62615Z"
                                        fill="#0066FF" />
                                </svg>
                            </a>
                        </div>
                        <div class="header__contact-text">
                            <a href="tel:<?php echo trim(get_option('phone'));?>"><?php echo get_option('phone'); ?></a>
                            <p>Телефон горячей линии по РФ</p>
                        </div>
                    </div>
                </div>
                <div class="header__search" id="search">
                    <form class="header__search-form" role="search" method="get" id="searchform"
                        action="<?php echo home_url( '/' ) ?>">
                        <input type="text" name="s" id="s" placeholder="Найти товар">
                        <button type="submit" id="searchsubmit">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/search-header.svg" alt="">
                        </button>
                        <div class="search__result"></div>
                    </form>
                </div>
                <div class="header__contact search">
                    <div class="header__contact-img">
                        <a href="tel:<?php echo trim(get_option('phone'));?>">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.18123 1.62615L5.89896 1.39682C6.5715 1.18192 7.29007 1.52922 7.57808 2.20838L8.15124 3.55994C8.40101 4.14891 8.26241 4.84151 7.80859 5.27226L6.54571 6.47094C6.62363 7.18792 6.86464 7.89392 7.26873 8.58893C7.67282 9.28394 8.1775 9.86048 8.78277 10.3185L10.2996 9.81274C10.8745 9.62102 11.5006 9.84135 11.8533 10.3595L12.6749 11.5665C13.0848 12.1688 13.0111 12.9997 12.5024 13.5104L11.9573 14.0576C11.4146 14.6024 10.6396 14.8 9.92268 14.5763C8.23011 14.0484 6.6739 12.4809 5.25405 9.87393C3.83214 7.26315 3.3303 5.04809 3.74855 3.22875C3.92455 2.46321 4.46956 1.85356 5.18123 1.62615Z"
                                    fill="#0066FF" />
                            </svg>
                        </a>
                    </div>
                    <div class="header__contact-text">
                        <a href="tel:<?php echo trim(get_option('phone'));?>"><?php echo get_option('phone'); ?></a>
                        <p>Телефон горячей линии по РФ</p>
                    </div>
                </div>
            </div>
        </div>
    </header>