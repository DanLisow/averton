<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<?php if(is_user_logged_in()) {?>
<div class="admin">
    <button data-id="<?php echo $post->ID; ?>">Удалить оценки у поста</button>
</div>
<?php } ?>


<div class="single">
    <div class="container">
        <div class="single__inner">
            <div class="single__info">
                <div class="single__title">
                    <div class="single__title-bread">
                        <span><a href="<?php bloginfo('url'); ?>">Каталог</a> /
                            <a href="<?php echo get_category_link(get_the_category()[0]->term_id); ?>">
                                <?php echo get_the_category()[0]->name; ?></a>
                            / <?php the_title(); ?></span>
                    </div>
                    <h1><?php the_title(); ?></h1>
                </div>

                <div class="single__rate">
                    <div class="single__rate-title">
                        <h3>Общий рейтинг</h3>
                        <?php
                            $comments_count = count(get_comments(array(
                                'post_id' => $post->ID
                            ))); 
                        ?>
                        <p data-count="<?php echo $comments_count; ?>" data-review></p>
                        <!-- <a href="#">
                            <?php
                            $comments = get_comments(array('post_id' => $post->ID));
                            ?>
                            отзывов</a> -->
                    </div>
                    <div class="single__rate-count">
                        <?php
                            [$rate, $rate_count, $average] = rate($post->ID);
                            $values = get_field('rate', get_category(get_the_category()[0]));
                            $percent = $average != 0 ? 280 - 280 * ($average * 20 / 100) : 280;
                        ?>
                        <div class="single__rate-circle">
                            <div class="single__rate-circle__decimal">
                                <h2>
                                    <?php echo round($average, 1); ?>
                                </h2>
                            </div>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 97 97">
                                <circle r="44.5" cx="50%" cy="50%" fill="none" stroke="#F1F4F7" stroke-width="7" />
                                <circle r="44.5" cx="50%" cy="50%" fill="none" stroke="#0066FF" stroke-width="7"
                                    stroke-dashoffset="<?php echo $percent; ?>" stroke-dasharray="280" />
                            </svg>
                        </div>
                        <div class="single__rate-values">
                            <?php 
                            if($values)
                            {
                                foreach($values as $key => $value)
                                { ?>
                            <div class="single__rate-value">
                                <h4><?php echo $value['rate_item']; ?></h4>
                                <div class="single__rate-value__stars"
                                    data-total-value="<?php if(!empty($rate[$key])) echo round($rate[$key][0] / $rate_count[$key][0]); ?>">
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
                <div class="single__buttons">
                    <a data-fancybox data-src="#modal" href="#">Оставить отзыв</a>
                    <a data-fancybox data-src="#modal-mobile" href="#">Оставить отзыв</a>
                    <a href="#review">Посмотреть отзывы</a>
                </div>
                <div class="single__text">
                    <div class="single__text-description">
                        <p>Описание:</p>
                        <p><?php the_field('description'); ?></p>
                    </div>
                    <?php
                    $made = get_field('made');
                    if($made):
                    ?>
                    <div class="single__text-composition">
                        <p>Состав:</p>
                        <p><?php the_field('made'); ?></p>
                    </div>
                    <div class="single__text-warning">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/warn.svg" alt="">
                        <p>Информация на этикетке может незначительно отличаться</p>
                    </div>
                    <div class="single__text-ratios">
                        <div class="single__text-ratio">
                            <h4>Годен:</h4>
                            <p><?php the_field('time'); ?></p>
                        </div>
                        <div class="single__text-ratio">
                            <h4>Вес:</h4>
                            <p><?php the_field('weight'); ?></p>
                        </div>
                        <div class="single__text-ratio">
                            <h4>Б/Ж/У/ккал на 100 гр:</h4>
                            <p><?php the_field('parts'); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if(!empty($comments)): ?>
                <div class="single__photo">
                    <h1>Фото покупателей</h1>
                    <div class="single__photo-box">
                        <div class="single__photo-block">
                            <?php
                            $count = 1; 
                            foreach($comments as $key => $comment): 

                                $comment_meta = get_comment_meta($comment->comment_ID, 'attach_' . $comment->comment_post_ID . '_' . $comment->comment_ID);
                                
                                if(!empty($comment_meta) && !is_null($comment_meta)):
                                    if($count < 5):
                            ?>
                            <div class="single__photo-item">
                                <a href="<?php echo $comment_meta[0]; ?>" data-fancybox="images">
                                    <img src="<?php echo $comment_meta[0]; ?>" alt="">
                                </a>
                            </div>
                            <?php elseif($count > 4): ?>
                            <div class="single__photo-item" style="opacity: 0; position: absolute; z-index: -100;">
                                <a href="<?php echo $comment_meta[0]; ?>" data-fancybox="images">
                                    <img src="<?php echo $comment_meta[0]; ?>" alt="">
                                </a>
                            </div>
                            <?php
                            endif;
                            $count++;
                            endif;
                            endforeach;
                        ?>
                            <?php if($count > 4): ?>
                            <div class="single__photo-all">
                                <div class="single__photo-all__block">
                                    <p>Всего <?php echo $count - 1; ?> фото</p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="single__review" id="review">
                    <div class="single__review-title">
                        <h1>Отзывы о товаре</h1>
                        <a data-fancybox data-src="#modal" href="#">+ Оставить отзыв</a>
                    </div>

                    <div class="single__review-block">

                        <?php
                        
                        wp_list_comments(
                            array(
                                'style' => 'div',
                                'type' => 'comment',
                                'per_page' => -1,
                                'reverse_top_level' => false,
                                'callback' => 'changeComment',
                                'end-callback' => 'changeEndComment'
                            ),
                            $comments
                        );

                        ?>

                        <div class="single__review-button">
                            <button>Загрузить
                                больше</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php $images = get_field('gallery'); ?>
            <?php if($images): ?>
            <div class="single__img">
                <div class="single__img-main">
                    <button class="single__img-main__prev"><img
                            src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-slider.svg"
                            alt=""></button>
                    <div class="swiper gallery-top">
                        <div class="swiper-wrapper">
                            <?php foreach( $images as $image ): ?>
                            <div class="single__img-main__item swiper-slide">
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <button class="single__img-main__next"><img
                            src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-slider.svg"
                            alt=""></button>
                </div>
                <div class="single__img-sub">
                    <div class="swiper gallery-thumbs">
                        <div class="swiper-wrapper">
                            <?php foreach( $images as $image ): ?>
                            <div class="single__img-sub__item swiper-slide">
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>