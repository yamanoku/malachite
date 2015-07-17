<?php
/** RSS2 の feed リンクを出力 */
add_theme_support( 'automatic-feed-links' );

/** ウィジェットエリア */
register_sidebar( array(
     'name' => __( 'Side Widget' ),
     'id' => 'side-widget',
     'before_widget' => '<li class="widget-container">',
     'after_widget' => '</li>',
     'before_title' => '<h3>',
     'after_title' => '</h3>',
) );

/** 最近の投稿カスタマイズ */
class My_WP_Widget_Recent_Posts extends WP_Widget_Recent_Posts{
    function widget($args, $instance) {
        $cache = wp_cache_get('widget_recent_posts', 'widget');
        if ( !is_array($cache) )
            $cache = array();
        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;
        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }
        ob_start();
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 10;
        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($r->have_posts()) :
?>
<?php echo $before_widget; ?>
<?php if ( $title ) echo $before_title . $title . $after_title; ?>
<ul>
<?php  while ($r->have_posts()) : $r->the_post(); ?>
<li class="category-box clearfix">
		<a href="<?php the_permalink(); ?>" class="thumb">
		<?php
		     if(has_post_thumbnail()) {
		        the_post_thumbnail(array(60, 60));
		    } else {
		        echo '<img src="'.get_template_directory_uri().'/images/noimage-side.jpg" width="60" height="60" alt="no_image"/>';
		} ?>
		</a>
		<div class="category-inner">
		<div class="category-detail clearfix">
			<p class="news-cat">
			<?php 
		    $c = get_the_category();
		    $pid = $c[0]->parent;
		    $cid = $c[0]->cat_ID;
		    if( $pid > 0 ) {
		    do {
		        $t = get_term_by( '', $pid, 'category' );
		        $pid = $t->parent;
		    } while( $pid > 0 );
		        echo '<a href="' .get_category_link( $t->term_id ). '" class="category-' .$c[0]->category_parent. '">' . $t->name . '</a>';
		    }else{
		        echo '<a href="' .get_category_link( $c[0]->term_id ). '" class="category-' .$cid. '">' . $c[0]->name . '</a>';
		    }
		    ?>
		    </p>
		    <p class="news-time"><?php echo get_the_date(); ?></p>
		    <a href="<?php the_permalink(); ?>" class="news-title"><?php the_title(); ?></a>
		</div>
		</div>
	</li>
<?php endwhile; ?>
</ul>
<?php echo $after_widget; ?>
<?php
        wp_reset_postdata(); 
        endif;
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_recent_posts', $cache, 'widget');
    }
}
function wp_my_widget_register() {
    register_widget('My_WP_Widget_Recent_Posts');
}
add_action('widgets_init', 'wp_my_widget_register');

/** アイキャッチ画像 */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(280, 180, true); /** 切り抜きモード */

function my_scripts() {
wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'my_scripts' );

/** カスタムヘッダー */
$custom_header_defaults = array(
'default-image' => get_bloginfo('template_url').'/images/header-image.jpg',
'width'  => 80,
'height'  => 80,
'header-text' => false,
);
add_theme_support( 'custom-header', $custom_header_defaults );

/** カスタム背景 */
$custom_background_defaults = array(
        'default-color' => 'E0F2F1',
        'default-image' => ' ',
);
add_theme_support( 'custom-background', $custom_background_defaults );

/** カスタムカラー */
function Malachite_customize_register($wp_customize){
  $colors = array();
  $colors[] = array( 'slug'=>'content_text_color', 'default' => '#727272', 'label' => __( '本文テキスト', 'Malachite' ) );
  $colors[] = array( 'slug'=>'content_main_color', 'default' => '#029956', 'label' => __( 'メインカラー', 'Malachite' ) );
  $colors[] = array( 'slug'=>'content_sub_color', 'default' => '#00695C', 'label' => __( 'サブカラー', 'Malachite' ) );
  $colors[] = array( 'slug'=>'content_hover_color', 'default' => '#215750', 'label' => __( 'ホバーカラー', 'Malachite' ) );
  foreach($colors as $color){
    $wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'] )));
  }
}
add_action( 'customize_register', 'Malachite_customize_register' );

/** ページネーション */
function pagination($pages = ''){
     $showitems = 1;
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == ''){
         global $wp_query;
         $pages = $wp_query->max_num_pages;//全ページ数を取得
         if(!$pages)//全ページ数が空の場合は、１とする
         {
     		$pages = 1;
         }
     }
     if(1 != $pages){
	echo "<div class=\"pagination\">\n";
	echo "<ul>\n";
        if($paged > 1) echo "<li class=\"prev\"><a href='".get_pagenum_link($paged - 1)."'>←</a></li>\n";
        for ($i=1; $i <= $pages; $i++){
        	if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
        	echo ($paged == $i)? "<li class=\"active\">".$i."</li>\n":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>\n";
        	}
        }
	if ($paged < $pages) echo "<li class=\"next\"><a href=\"".get_pagenum_link($paged + 1)."\">→</a></li>\n";
		echo "</ul>\n";
		echo "</div>\n";
     }
}

/** カスタムナビゲーションメニュー */
register_nav_menu('gb-nav','グローバルメニュー');
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}

/** editor-style適用　*/
add_editor_style('editor-style.css');
function custom_editor_settings( $initArray ) {
    $initArray['body_class'] = 'editor-area';
    return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );

/** 個別ページを検索で出さない */
function custom_search($search, $wp_query) {
    if (!$wp_query->is_search) return;
    $search .= " AND post_type = 'post'";
    return $search;
}
add_filter('posts_search','custom_search', 12, 2);

/** 寄稿者・投稿者権限でもファイルのアップロードを可能にする */
    if (current_user_can('contributor') && !current_user_can('upload_files')) {
        add_action('admin_init', 'allow_contributor_uploads');
    }
    function allow_contributor_uploads() {
        $contributor = get_role('contributor');
        $contributor->add_cap('upload_files');
    }

?>