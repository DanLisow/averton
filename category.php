<?php get_header(); ?>

<?php 
$id = get_queried_object_id();
?>

<div class="goods">
    <div class="container">
        <div class="goods__inner">
            <div class="goods__bread">
                <span><a href="<?php bloginfo('url'); ?>">Каталог</a> / <?php echo get_category($id)->name; ?></span>
            </div>
            <h1><?php echo get_category($id)->name; ?> (<?php echo get_category($id)->category_count; ?>)</h1>
            <div class="goods__items">
                <?php
                if(have_posts()): while(have_posts()): the_post();
                ?>
                <div class="goods__item">
                    <a href="<?php the_permalink(); ?>">
                        <div class="goods__item-img">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    </a>
                    <div class="goods__item-text">
                        <p><?php the_title(); ?></p>
                    </div>
                    <?php [$rate, $rate_count, $average] = rate($post->ID); ?>
                    <?php if($average != 0): ?>
                    <div class="goods__item-rate">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/star-white.svg" alt="">
                        <p><?php echo round($average, 1); ?></p>
                    </div>
                    <?php endif; ?>
                    <div class="goods__item-caption">
                        <p><?php the_field('caption'); ?></p>
                    </div>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>