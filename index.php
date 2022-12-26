<?php get_header(); ?>
<!-- 
<div class="search">
    <div class="container">
        <div class="search__inner">
            <div class="search__block">
                <input type="text" name="search1" placeholder="Найти товар">
                <div class="search__result one"></div>
            </div>
        </div>
    </div>
</div> -->

<div class="category">
    <div class="container">
        <div class="category__inner">
            <h1>Категории товаров</h1>
            <div class="category__items">
                <?php 

                $category= get_categories( [
                    'taxonomy'     => 'category',
                    'type'         => 'post',
                    'orderby'      => 'date',
                    'order'        => 'DESC',
                    'hide_empty'   => 0,
                    'exclude' => '1'
                ] );

                if( $category ):
                foreach( $category as $cat ): 
                
                if(!get_field('show', 'category_' . $cat->term_id)): ?>
                <div class="category__item">
                    <a href="<?php echo get_category_link($cat->term_id); ?>">
                        <div class="category__item-block">
                            <div class="category__item-count">
                                <p><?php echo $cat->category_count; ?></p>
                            </div>
                            <div class="category__item-img">
                                <?php
                                $image = get_field('category_img', get_category($cat));
                                if($image):
                            ?>
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                                <?php endif; ?>
                            </div>
                            <div class="category__item-text">
                                <h4><?php echo $cat->name; ?></h4>
                                <!-- <p data-count="<?php echo $cat->category_count; ?>"></p> -->
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif; endforeach; endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="about" id="about">
    <div class="container">
        <div class="about__inner">
            <div class="about__block">
                <div class="about__info">
                    <div class="about__info-text">
                        <h2>О сервисе</h2>
                        <p><?php echo get_option('main_text'); ?>
                        </p>
                    </div>
                    <div class="about__info-items">
                        <div class="about__info-item">
                            <h3><?php echo wp_count_comments()->total_comments; ?></h3>
                            <p>Всего отзывов</p>
                        </div>
                        <div class="about__info-item">
                            <h3><?php echo wp_count_posts()->publish; ?></h3>
                            <p>Всего товаров</p>
                        </div>
                    </div>
                </div>
                <div class="about__img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>