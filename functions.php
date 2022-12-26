<?php 

add_action('wp_enqueue_scripts', 'style_theme');
add_action('wp_footer', 'scripts_theme');
add_action('after_setup_theme', 'theme_register_nav_menu');


add_action( 'edited_category', 'wp_kama_edited_taxonomy_action', 10, 2 );

/**
 * Function for `edited_(taxonomy)` action-hook.
 * 
 * @param int $term_id Term ID.
 * @param int $tt_id   Term taxonomy ID.
 *
 * @return void
 */
function wp_kama_edited_taxonomy_action( $term_id, $tt_id ){
    $key = array_keys($_POST['acf'])[1];
    // echo '<pre>';
    // $result = changeRate($term_id, $_POST['acf'][$key]);
    // print_r(array_key_last($result));
    changeRate($term_id, $_POST['acf'][$key]);
}

function changeRate($category, $acf){
    $posts = get_posts(array('numberposts' => 1, 'category' => $category));

    $arr = array();

    foreach($posts as $post){

        for($i = 0; $i < 5; $i++){
            $value = get_post_meta($post->ID, 'count_rate_' . $post->ID . '_' . $i, true);
            if(!empty($value)){
                $arr += [$i => $value]; 
            }
            else{
                continue;
            }
        }

        $last_index = array_key_last($arr);

        // if(count($acf) > ($last_index + 1)){
        //     for($i = $last_index + 1; $i < count($acf); $i++){
        //         add_post_meta($post->ID, 'count_rate_' . $post->ID . '_' . $i, '0');
        //         add_post_meta($post->ID, 'rate_' . $post->ID . '_' . $i, '0');
        //     }
        // }
        
        if(count($acf) < count($arr)){
            for($i = count($acf); $i < count($arr); $i++){
                delete_post_meta($post->ID, 'count_rate_' . $post->ID . '_' . $i);
                delete_post_meta($post->ID, 'rate_' . $post->ID . '_' . $i);
            }

            $sum = 0;

            for($i = 0; $i < count($acf); $i++){
                $value = get_post_meta($post->ID, 'count_rate_' . $post->ID . '_' . $i, true);
                $sum += $value;
            }

            update_post_meta($post->ID, 'sum_' . $post->ID, $sum);
        }
    }

    return $arr;
}


// Функции подключения стилей

function style_theme(){
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/style.min.css');
}

function scripts_theme(){
    wp_enqueue_script('libs', get_template_directory_uri() . '/assets/js/library.min.js');
    wp_enqueue_script('jquery-ui-autocomplete');
    wp_enqueue_script('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js');
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js');
    wp_enqueue_script('slider', get_template_directory_uri() . '/assets/js/slider.js');
    wp_enqueue_script('form', get_template_directory_uri() . '/assets/js/form.js');
    wp_enqueue_script('number', get_template_directory_uri() . '/assets/js/number.js');

    wp_register_script( 'trueajax', get_stylesheet_directory_uri() . '/assets/js/ajax.js', array(), time(), true );
	wp_localize_script(
		'trueajax',
		'ajax',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' )
		)
	);
	wp_enqueue_script( 'trueajax' );
    // wp_enqueue_script('hide', get_template_directory_uri() . '/assets/js/hide.js');
}

add_action('admin_enqueue_scripts', function(){
    wp_enqueue_script( 'admin', get_stylesheet_directory_uri() . '/assets/js/admin.js', array('jquery'), time(), true );
});

function theme_register_nav_menu(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails', array('post'));
}


// Функция для добавления кастомного поля в настройки

add_action('admin_menu', 'add_option_field_to_general_admin_page');
function add_option_field_to_general_admin_page(){
	// регистрируем опции
	register_setting( 'general', 'phone');
    register_setting( 'general', 'main_text' );
    register_setting( 'general', 'modal_name');
    register_setting( 'general', 'modal_text' );
    register_setting( 'general', 'modal_gift' );
    register_setting( 'general', 'channel_id' );

	// добавляем поле
	add_settings_field( 
		'setting-id-phone', 
		'Телефон', 
		'setting_callback_function', 
		'general', 
		'default', 
		array( 
			'id' => 'setting-id-phone', 
			'option_name' => 'phone' 
		)
	);

    add_settings_field( 
		'setting-id-text', 
		'Текст на главной странцие', 
		'setting_callback_function', 
		'general', 
		'default', 
		array( 
			'id' => 'setting-id-text', 
			'option_name' => 'main_text' 
		)
	);

    add_settings_field( 
		'setting-id-modal-name', 
		'Текст заголовка для поля Имя в модальном окне', 
		'setting_callback_function', 
		'general', 
		'default', 
		array( 
			'id' => 'setting-id-modal-name', 
			'option_name' => 'modal_name' 
		)
	);

    add_settings_field( 
		'setting-id-modal-text', 
		'Текст заголовка для поля Комментарий в модальном окне', 
		'setting_callback_function', 
		'general', 
		'default', 
		array( 
			'id' => 'setting-id-modal-text', 
			'option_name' => 'modal_text' 
		)
	);

    add_settings_field( 
		'setting-id-csv-button', 
		'Получить CSV файл всех комментариев', 
		'setting_callback_function', 
		'general', 
		'default', 
		array( 
			'id' => 'setting-id-csv-button', 
			'option_name' => 'csv_button' 
		)
	);

    add_settings_field( 
		'setting-id-modal-gift', 
		'Текст для обоев', 
		'setting_callback_function', 
		'general', 
		'default', 
		array( 
			'id' => 'setting-id-modal-gift', 
			'option_name' => 'modal_gift' 
		)
	);

    add_settings_field( 
		'setting-id-channel-id', 
		'ID канала в Telegram', 
		'setting_callback_function', 
		'general', 
		'default', 
		array( 
			'id' => 'setting-id-channel-id', 
			'option_name' => 'channel_id' 
		)
	);

    
}

function setting_callback_function( $val ){
	$id = $val['id'];
	$option_name = $val['option_name'];

    if($option_name == 'phone'):
	?>
<input type="text" name="<? echo $option_name ?>" id="<? echo $id ?>"
    value="<? echo esc_attr( get_option($option_name) ) ?>" style="width: 300px;" />
<?
    elseif($option_name == 'main_text'): ?>
<textarea type="text" name="<? echo $option_name ?>" id="<? echo $id ?>"
    style="width: 400px; height: 200px;"><? echo esc_attr( get_option($option_name) ) ?></textarea>
<?
    elseif($option_name == 'modal_text'): ?>
<img src="<?php echo get_template_directory_uri() ?>/assets/img/modal-text.PNG"
    style="display: block; width: 500px; height: 300px; object-fit: contain; margin-bottom: 20px;">
<input type="text" name="<? echo $option_name ?>" id="<? echo $id ?>"
    value="<? echo esc_attr( get_option($option_name) ) ?>" style="width: 300px;" />
<?
    elseif($option_name == 'modal_name'): ?>
<img src="<?php echo get_template_directory_uri() ?>/assets/img/modal-name.PNG"
    style="display: block; width: 500px; height: 300px; object-fit: contain; margin-bottom: 20px;">
<input type="text" name="<? echo $option_name ?>" id="<? echo $id ?>"
    value="<? echo esc_attr( get_option($option_name) ) ?>" style="width: 300px;" />
<?
    elseif($option_name == 'modal_gift' || $option_name == 'channel_id'): ?>
<input type="text" name="<? echo $option_name ?>" id="<? echo $id ?>"
    value="<? echo esc_attr( get_option($option_name) ) ?>" style="width: 300px;" />
<?
    else: ?>
<button class="csv-button"
    style="border: none;padding: 11px 42px 13px;background: #10a20e;color: #fff;border-radius: 4px; margin-right: 18px; cursor: pointer;">
    Сформировать CSV файл</button>
<?php endif;
}


// AJAX-функция для формы поиска по сайту

// add_action( 'wp_ajax_websearch', 'search' );
// add_action( 'wp_ajax_nopriv_websearch', 'search' );

// function search() {
//     $search_term = isset($_GET['term']) ? $_GET['term'] : '';

//     $posts = get_posts(array(
//         'posts_per_page' => -1,
//         'post_type' => 'post',
//         's' => $search_term
//     ));

//     $result = array();

//     if($posts){
//         foreach($posts as $post){
//             $result[] = array(
//                 'id' => $post->ID,
//                 'value' => $post->post_title,
//                 'url' => get_permalink($post->ID)
//             );
//         }
//     }

//     wp_send_json($result);
// }


// Функция для удаления обязятельного поля Сайт из формы комментария

add_filter( 'comment_form_default_fields', 'truemisha_remove_url_field', 25 );
function truemisha_remove_url_field( $fields ) {
	unset( $fields[ 'url' ] );
	return $fields;
}

// AJAX-функция для отправки комментария из формы

remove_filter( 'comment_flood_filter', 'wp_throttle_comment_flood', 10, 3);

add_action( 'wp_ajax_sendcomment', 'comment' );
add_action( 'wp_ajax_nopriv_sendcomment', 'comment' );

function comment() {
    $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
    $post_id = $_POST['comment_post_ID'];
    $comment_id = $comment->comment_ID;

    if( is_wp_error( $comment ) )
		wp_send_json_error( $comment->get_error_message() );

    if(!empty($_POST['total'])){
        $rate = explode(",", $_POST['total']);
        $rate_decimal = array_filter($rate, function($item){ return is_numeric($item) ? $item : false; });
        $rate_general = array_chunk($rate, 2);

        foreach($rate_general as $value){
            add_comment_meta( $comment_id, 'values_' . $post_id . '_' . $comment_id, $value[0] . ':' . $value[1] );
        }

        add_comment_meta( $comment_id, 'total_' . $post_id . '_' . $comment_id, round(array_sum($rate_decimal) / count($rate_decimal), 1) );
    }

    add_comment_meta( $comment_id, 'gender_' . $post_id . '_' . $comment_id, $_POST['gender']);
    add_comment_meta( $comment_id, 'age_' . $post_id . '_' . $comment_id, $_POST['age']);
    add_comment_meta( $comment_id, 'city_' . $post_id . '_' . $comment_id, $_POST['city']);

    if(!empty($_FILES['file']) && !is_null($_FILES['file'])){
        if ( ! function_exists( 'wp_handle_upload' ) ) 
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
                
        $file = & $_FILES['file'];
        $overrides = [ 'test_form' => false ];

        $movefile = wp_handle_upload( $file, $overrides );

        if ( $movefile && empty($movefile['error']) ) {
            echo "Файл был успешно загружен\n";
        } else {
            echo "Произошла ошибка при загрузке файла\n";
        }

        add_comment_meta( $comment_id, 'attach_' . $post_id . '_' . $comment_id, $movefile['url'] );
    }

    echo '<pre>';
    print_r(sendTelegram($_POST));

	die;
}


// Функции для вывода шаблона комментария

function changeComment($comment, $args, $depth){
    $GLOBALS['comment'] = $comment; ?>

<div <?php comment_class('single__review-item'); ?> id="comment-<?php comment_ID(); ?>">

    <div class="single__review-item__box">
        <div class="single__review-head">
            <div class="single__review-head__info">
                <p><?php comment_author(); ?></p>
                <span><?php comment_date('j F Y'); ?></span>
            </div>
            <?php 
            $comment_meta_rate = get_comment_meta(get_comment_ID(), 'total_' . $comment->comment_post_ID . '_' . get_comment_ID());
            $comment_meta_value =  (empty($comment_meta_rate) || !is_numeric($comment_meta_rate[0])) ? 0 : $comment_meta_rate[0];
            $comment_values = get_comment_meta(get_comment_ID(), 'values_' . $comment->comment_post_ID . '_' . get_comment_ID());
            ?>
            <div class="single__review-head__stars" data-total-value="<?php echo $comment_meta_value;?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/star-white.svg" alt="">
                <p><?php echo $comment_meta_value;?></p>
            </div>
        </div>
        <div class="single__review-values">
            <?php foreach($comment_values as $value): ?>
            <?php
                $part = explode(':', $value);
                if($part[1] != 0):
            ?>
            <div class="single__review-value">
                <p><?php echo $part[0] ?>:</p>
                <div class="single__review-value__stars" data-total-value="<?php echo $part[1];?>">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                            fill="#DFE2E4" />
                    </svg>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                            fill="#DFE2E4" />
                    </svg>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                            fill="#DFE2E4" />
                    </svg>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                            fill="#DFE2E4" />
                    </svg>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.76224 5.47206L7.55128 1.83986C7.73455 1.46777 8.26509 1.46777 8.44836 1.83986L10.2374 5.47206L14.2447 6.05113C14.6551 6.11043 14.8191 6.61473 14.5221 6.9041L11.6237 9.72819L12.308 13.7187C12.378 14.1273 11.9489 14.4388 11.5821 14.2456L7.99982 12.3586L4.4175 14.2456C4.05052 14.4389 3.62131 14.127 3.69175 13.7183L4.37934 9.72819L1.47775 6.90431C1.1805 6.61502 1.34445 6.11045 1.75497 6.05113L5.76224 5.47206Z"
                            fill="#DFE2E4" />
                    </svg>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="single__review-body">
            <div class="single__review-body__block">
                <?php if (get_comment_text() != 'empty'): ?>
                <p><?php comment_text(); ?></p>
                <?php endif; ?>
            </div>
            <?php
            $comment_meta = get_comment_meta(get_comment_ID(), 'attach_' . $comment->comment_post_ID . '_' . get_comment_ID());
            if(!empty($comment_meta) && !is_null($comment_meta)): 
            ?>
            <div class="single__review-body__images">
                <h4>Прикрепленные фотографии:</h4>
                <div class="single__review-body__image">
                    <a href="<?php echo $comment_meta[0]; ?>" data-fancybox>
                        <img src="<?php echo $comment_meta[0]; ?>" alt="">
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php
}

function changeEndComment( $comment, $args, $depth ){
	echo '</div>';
}


// AJAX-функция для установки рейтинга

add_action( 'wp_ajax_rate', 'setRate' );
add_action( 'wp_ajax_nopriv_rate', 'setRate' );

function setRate() {
    
    $post_id = $_POST['id'];
    $ratings = $_POST['array'];
    $ratings_count = array_filter($ratings, function($item){ return $item[1] != 0; });

    foreach($ratings_count as $key => $rate){
            $count_key = 'rate_' . $post_id . '_' . $key;
            $value = get_post_meta($post_id, $count_key, true);
            $count_value = get_post_meta($post_id, 'count_' . $count_key, true);
            if($value != '' && $count_value != ''){
                $count_value++;
                $value += $rate[1];
                update_post_meta($post_id, 'count_' . $count_key, $count_value);
                update_post_meta($post_id, $count_key, $value);
            }else{
                $count_value = 1;
                add_post_meta($post_id, $count_key, $rate[1]);
                add_post_meta($post_id, 'count_' . $count_key, '1');
            }
    }

    $sum = get_post_meta($post_id, 'sum_' . $post_id, true);
    if($sum == ''){
        $sum = count($ratings_count);
        delete_post_meta($post_id, 'sum_' . $post_id);
        add_post_meta($post_id, 'sum_' . $post_id, $sum);
    }else{
        $sum += count($ratings_count);
        update_post_meta($post_id, 'sum_' . $post_id, $sum);
    }

    die;
}


// Функция для отправки в телеграм

function sendTelegram($post_arr){
    $token = "5441895128:AAEzmerm62HCaUSln43zXkj-fq9LV5OM6xw";
    $chat_id = get_option('channel_id');
    $arr = array_chunk(explode(',', $post_arr['total']), 2);
    $ratings_arr = array_filter($arr, function($item){ return (int)$item[1] != 0; });
    $sum = array_reduce($ratings_arr, function($accure, $item){ 
        if((int)$item[1] != 0){
            return $accure += $item[1]; 
        }
        return;
    }, 0);
    $add_str = '';

    if((count($ratings_arr) == count($arr) && ($post_arr['comment'] == 'empty'))){
        return;
    }

    if(!empty($post_arr['gender'])) $add_str .= "<b>Пол:</b> {$post_arr['gender']}\r\n";
    if(!empty($post_arr['age'])) $add_str .= "<b>Возраст:</b> {$post_arr['age']}\r\n";
    if(!empty($post_arr['city'])) $add_str .= "<b>Город:</b> {$post_arr['city']}\r\n";
    
    $new_arr = array_map(function($item){ return "<b>{$item[0]}:</b> {$item[1]}\r\n"; }, $arr);
    $res = array_reduce($new_arr, function($total, $item){ return $total .= $item; }, '');

    $text = '<b>URL:</b> <a href="'.$post_arr['link'].'">'.$post_arr['link'].'</a>' . "\r\n";
    $text .= "<b>Название:</b> {$post_arr['title']}\r\n";
    $text .= "<b>Имя:</b> {$post_arr['author']}\r\n";
    $text .= $res;
    $text .= $add_str;
    $text .= "<b>Дата:</b> {$post_arr['date']}\r\n";
    $text .= "<b>Оценка:</b>" . round($sum / count($ratings_arr), 1) ."\r\n";

    if($post_arr['comment'] != 'empty'){
        $text .= "<b>Комментарий:</b> {$post_arr['comment']}\r\n";
    }


    fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text=" . urlencode($text), "r");
    return $ratings_arr;
}


// Функция для расчёта средней оценки

function rate($post_id){
    $rate = array();
    $rate_count = array();
    $total = 0;
    $average = 0;
    $sum = get_post_meta($post_id, 'sum_' . $post_id);
    $rows = get_field('rate', get_category(get_the_category($post_id)[0]));
                                                    
    if(!empty($rows)){
        for ($i = 0; $i < count($rows); $i++) { 
            $post_meta = get_post_meta($post_id, 'rate_' . $post_id . '_' . $i);
            $post_meta_count = get_post_meta($post_id, 'count_rate_' . $post_id . '_' . $i);
                            
            if(!empty($post_meta) && !empty($sum)){
                array_push($rate, $post_meta);
                array_push($rate_count, $post_meta_count);
                $total += $rate[$i][0];
            }
            else{
                array_push($rate, 0);
                array_push($rate_count, 0);
            }
        }
                            
        if(!empty($sum) && $sum[0] != 0){
            $average = $total / $sum[0];
        }
    }

    return $rate != 0 ? [$rate, $rate_count, $average] : 0;
}

// AJAX-функция для удаления рейтинга

add_action( 'wp_ajax_delete', 'deleteRate' );

function deleteRate() {
    
    $post_id = $_POST['id'];

    for ($i=0; $i < 5; $i++) { 
        $count_rate = get_post_meta($post_id, 'count_rate_' . $post_id . '_' . $i);
        $rate = get_post_meta($post_id, 'rate_' . $post_id . '_' . $i);

        if($count_rate != '' && $rate != ''){
            delete_post_meta($post_id, 'rate_' . $post_id . '_' . $i);
            delete_post_meta($post_id, 'count_rate_' . $post_id . '_' . $i);
        }
        else{
            continue;
        }
    }

    $sum = get_post_meta($post_id, 'sum_' . $post_id);
    if($sum != '' && $sum != 0){
        delete_post_meta($post_id, 'sum_' . $post_id);
    }

    if(is_wp_error($rate || $rate_count || $sum)){
        echo "Произошла ошибка";
    }
    else{
        echo "Успешно удалено";
    }

    die;
}


// Функция для переименования 

add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){
	$new = array(
		'name'                  => 'Товары',
		'singular_name'         => 'Товар',
		'add_new'               => 'Добавить товар',
		'add_new_item'          => 'Добавить товар',
		'edit_item'             => 'Редактировать товар',
		'new_item'              => 'Новый товар',
		'view_item'             => 'Просмотреть товар',
		'search_items'          => 'Поиск товаров',
		'not_found'             => 'Товаров не найдено.',
		'not_found_in_trash'    => 'Товаров в корзине не найдено.',
		'parent_item_colon'     => '',
		'all_items'             => 'Все товары',
		'archives'              => 'Архивы товаров',
		'insert_into_item'      => 'Вставить в товар',
		'uploaded_to_this_item' => 'Загруженные для этого товара',
		'featured_image'        => 'Миниатюра товара',
		'filter_items_list'     => 'Фильтровать список товаров',
		'items_list_navigation' => 'Навигация по списку товаров',
		'items_list'            => 'Список товаров',
		'menu_name'             => 'Товары',
		'name_admin_bar'        => 'Товар', // пункте "добавить"
	);

	return (object) array_merge( (array) $labels, $new );
}


// Функция для удаления пункта Метки

add_action( 'admin_menu', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
	// для версий WP 3.1 и выше
	if ( function_exists('remove_menu_page') ) {
		remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
	} 
}


// Функция для переименования Рубрик
add_filter( 'taxonomy_labels_'.'category', 'change_labels_category' );
function change_labels_category( $labels ) {

	// Запишем лейблы для изменения в виде массива для удобства
	$my_labels = array(
		'name'                  => 'Категории',
		'singular_name'         => 'Категория',
		'search_items'          => 'Поиск категориий',
		'all_items'             => 'Все категории',
		'parent_item'           => 'Родительская категория',
		'parent_item_colon'     => 'Родительская категория:',
		'edit_item'             => 'Изменить категории',
		'view_item'             => 'Просмотреть категории',
		'update_item'           => 'Обновить категорию',
		'add_new_item'          => 'Добавить новую категорию',
		'new_item_name'         => 'Название новой категории',
		'not_found'             => 'Категории не найдены.',
		'no_terms'              => 'Категорий нет',
		'items_list_navigation' => 'Навигация по списку категорий',
		'items_list'            => 'Список категорий',
		'back_to_items'         => '← Назад к категориям',
		'menu_name'             => 'Категории',
	);

	return $my_labels;
}


// Функция для создания CSV файла

add_action('wp_ajax_file', 'csv_file');

function csv_file(){
    global $wpdb;
    $newtable = $wpdb->get_results( "SELECT * FROM wp_comments WHERE comment_approved != 'trash'" );

    if(file_exists(__DIR__ . '/file.csv')){
        unlink('file.csv');
    }

    $fp = fopen(__DIR__ . '/file.csv', 'w');

    fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));

    fputcsv($fp, array(
        'IP',
        'Имя', 
        'Категория',
        'Товар', 
        'Пол',
        'Возраст',
        'Город', 
        'Дата', 
        'Ссылка на товар',
        'Критерий 1',
        'Оценка', 
        'Критерий 2',
        'Оценка',
        'Критерий 3',
        'Оценка',
        'Критерий 4',
        'Оценка',
        'Критерий 5',
        'Оценка',
        'Критерий 6',
        'Оценка', 
    ));

    foreach($newtable as $comment){
        $ip = $comment->comment_author_IP;
        $author = $comment->comment_author;
        $category = get_the_category($comment->comment_post_ID)[0]->name;
        $title = get_the_title( $comment->comment_post_ID );
        $date = get_comment_date('d.m.y G:i', $comment->comment_ID);
        $meta = get_comment_meta($comment->comment_ID, 'values_' . $comment->comment_post_ID . '_' . $comment->comment_ID);
        $link = get_the_permalink($comment->comment_post_ID );
        $gender = get_comment_meta($comment->comment_ID, 'gender_' . $comment->comment_post_ID . '_' . $comment->comment_ID)[0];
        $age = get_comment_meta($comment->comment_ID, 'age_' . $comment->comment_post_ID . '_' . $comment->comment_ID)[0];
        $city = get_comment_meta($comment->comment_ID, 'city_' . $comment->comment_post_ID . '_' . $comment->comment_ID)[0];

        $meta_array = array();

        foreach($meta as $item){
            $parts = explode(':', $item);
            array_push($meta_array, $parts[0], $parts[1]);
        }

        fputcsv($fp, array(
            $ip, 
            $author, 
            $category, 
            $title, 
            $gender,
            $age,
            $city,
            $date, 
            $link, 
            !empty($meta_array[0]) ? $meta_array[0] : '',
            !empty($meta_array[1]) ? $meta_array[1] : '',
            !empty($meta_array[2]) ? $meta_array[2] : '',
            !empty($meta_array[3]) ? $meta_array[3] : '',
            !empty($meta_array[4]) ? $meta_array[4] : '',
            !empty($meta_array[5]) ? $meta_array[5] : '',
            !empty($meta_array[6]) ? $meta_array[6] : '',
            !empty($meta_array[7]) ? $meta_array[7] : '',
            !empty($meta_array[8]) ? $meta_array[8] : '',
            !empty($meta_array[9]) ? $meta_array[9] : '',
        ));
        
    }

    echo get_template_directory_uri() . '/file.csv';

    fclose($fp);

    exit;
}



add_action( 'trashed_comment', 'action_function_name_7468', 10, 2 );

function action_function_name_7468( $comment_id, $comment ){
	$post_id = $comment->comment_post_ID;
    $meta = get_comment_meta($comment_id, 'values_' . $post_id . '_' . $comment_id);
    $meta_array = array();

    foreach($meta as $item){
        $part = explode(':', $item);
        array_push($meta_array, $part[1]);
    }

    $sum = get_post_meta($post_id, 'sum_' . $post_id);

    for($i = 0; $i < count($meta_array); $i++){
        if($meta_array[$i] != 0){
            $rate = get_post_meta($post_id, 'rate_' . $post_id . '_' . $i);
            $rate_count = get_post_meta($post_id, 'count_rate_' . $post_id . '_' . $i);

            if(!empty($rate)){
                update_post_meta($post_id, 'sum_' . $post_id, (int)$sum[0] -= 1);
                update_post_meta($post_id, 'rate_' . $post_id . '_' . $i, (int)$rate[0] - (int)$meta_array[$i]);
                update_post_meta($post_id, 'count_rate_' . $post_id . '_' . $i, (int)$rate_count[0] -= 1);
            }
        }
    }

}

add_action( 'untrashed_comment', 'action_function_name_1765', 10, 2 );
function action_function_name_1765( $comment_id, $comment ){
	$post_id = $comment->comment_post_ID;
    $meta = get_comment_meta($comment_id, 'values_' . $post_id . '_' . $comment_id);
    $meta_array = array();

    foreach($meta as $item){
        $part = explode(':', $item);
        array_push($meta_array, $part[1]);
    }

    $sum = get_post_meta($post_id, 'sum_' . $post_id);

    for($i = 0; $i < count($meta_array); $i++){
        if($meta_array[$i] != 0){
            $rate = get_post_meta($post_id, 'rate_' . $post_id . '_' . $i);
            $rate_count = get_post_meta($post_id, 'count_rate_' . $post_id . '_' . $i);

            update_post_meta($post_id, 'sum_' . $post_id, (int)$sum[0] += 1);
            update_post_meta($post_id, 'rate_' . $post_id . '_' . $i, (int)$rate[0] + (int)$meta_array[$i]);
            update_post_meta($post_id, 'count_rate_' . $post_id . '_' . $i, (int)$rate_count[0] += 1);
        }
    }
}



add_filter( 'manage_edit-category_columns', 'true_add_columns', 25 );
 
function true_add_columns( $my_columns ) {
 
	$my_columns[ 'hide' ] = 'Скрыта ли категория'; 
	return $my_columns;
 
}

add_action( 'admin_head', function() {
 
	echo '<style>
	#hide{
		width: 100px; /* уменьшаем ширину колонки до 58px */
	}
	</style>';
 
} );


add_filter( 'manage_category_custom_column', 'true_fill_columns', 25, 3 );
 
function true_fill_columns( $out, $column_name, $term_id ) {
 
	switch ( $column_name ) {
 
		case 'hide': {
			// получаем ID изображения из метаполя
			$hidden = get_term_meta( $term_id, 'show', true );
			if( $hidden ) {
				$out = '<img src="' . get_template_directory_uri() . '/assets/img/hide.png" width="16px">';
            }
 			break;
		}
 
	}
 
	return $out;
 
}