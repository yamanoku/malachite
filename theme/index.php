<?php get_header(); ?>

<div class="main front">

<div class="accessibility clearfix">

<script>
jQuery(function( $ ) {
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
<?php wp_dropdown_categories( 'show_option_none=カテゴリー&hierarchical=1&depth=1' ); ?>
</div>

<div class="search">
<?php get_search_form(); ?>
</div>

</div>

<div class="contents clearfix">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
	<div class="news-time"><?php echo get_the_date() ?></div>
	</div>
	<h2 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="news-img">
    <a href="<?php the_permalink(); ?>">
	<?php 
            if(has_post_thumbnail()) {
                the_post_thumbnail(array(280, 180));
            } else {
                echo '<img src="'.get_template_directory_uri().'/images/noimage.jpg" alt="noimage" />';
    } ?>
    </a>
    </div>
</div>
<?php endwhile; ?>
  
<?php endif; ?>

</div>

<?php if (function_exists("pagination")) {
    pagination($additional_loop->max_num_pages);
} ?>

</div>

<?php get_footer(); ?>