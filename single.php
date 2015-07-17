<?php get_header(); ?>

<div class="blog-single clearfix">
<div class="main single clearfix">

<div class="contents clearfix">

<div class="inner-contents clearfix">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="news-item clearfix">
    <div class="news-cat"><?php
    $c = get_the_category();
    $pid = $c[0]->category_parent;
    $cid = $c[0]->cat_ID;
    $separator = ' ';
    $output = '';
    if ( $pid > 0 ) {
        foreach( $c as $category ) {
            $output .= '<a class="category-' .$pid. '" href="' . get_category_link( $category->term_id ) . '" title="' .$category->name. '">' . $category->cat_name . '</a>' . $separator;
        }
    }
    else{
         $output .= '<a class="category-' .$cid. '" href="' . get_category_link( $c[0]->term_id ) . '" title="' .$c[0]->name. '">' . $c[0]->cat_name . '</a>' . $separator;       
    }
    echo trim( $output, $separator );
    ?>
    </div>
    <div class="news-time"><?php echo get_the_date() ?> <?php the_time(); ?></div>
    </div>
    <div class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
    <?php the_content(); ?>

<?php endwhile; ?>

<?php comments_template(); ?>

<div class="content-tag"><?php the_tags(); ?></div>

<?php else : ?>
                     
<h2 class="title">記事が見つかりませんでした。</h2>
                     
<?php endif; ?>
</div>

<div class="nav-below clearfix">
<span class="nav-next"><?php next_post_link('%link', '＜前へ'); ?></span>
<span class="nav-home"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">HOME</a></span>
<span class="nav-previous"><?php previous_post_link('%link', '次へ＞'); ?></span>
</div>

</div>

<?php get_sidebar(); ?>

</div>
</div>

<?php get_footer(); ?>