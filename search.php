<?php get_header(); ?>

<div class="main front">

<div class="accessibility clearfix">
<script>
  $(function(){ 
    /*======================
     TOPカテゴリー動的要素
    ======================*/
    var dropdown = document.getElementById("cat");
    function onCatChange() {
        if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
            location.href = "<?php echo get_option('home');?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
        }
    }
    dropdown.onchange = onCatChange;
});
</script>
<div class="category">
<?php wp_dropdown_categories( $args ); ?>
</div>

<div class="search">
<?php get_search_form(); ?>
</div>

</div>

<div class="contents clearfix">

<h2 class="search-result"><?php the_search_query(); ?>の検索結果 : <?php echo $wp_query->found_posts; ?>件</h2>
<!-- 投稿情報 loop -->
<?php if(have_posts()) : ?>
    <?php while(have_posts()):the_post() ?> 
        <div class="item">
            <div class="news-item clearfix">
            <div class="news-cat"><?php 
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
                echo '<a href="' .get_category_link( $c[0]->term_id ). '" class="category-' .$cid. '">' . $c[0]->name . '</a>';}
            ?>
            </div>
            <div class="news-time"><?php the_time('Y年m月d日') ?></div>
            </div>
            <h2 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="news-img">
            <a href="<?php the_permalink(); ?>">
            <?php 
                    if(has_post_thumbnail()) {
                        the_post_thumbnail(array(280, 180));
                    } else {
                        echo '<img src="'.get_template_directory_uri().'/images/noimage.jpg" width="280" height="180"/>';
            } ?>
            </a>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
        <p class="search-result">申し訳ございません。<br>該当する記事がございません。</p>
<?php endif; ?>

</div>

<div class="pagenation">
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
</div>

</div>

<?php get_footer(); ?>
